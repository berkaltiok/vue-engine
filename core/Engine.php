<?php

class Engine
{
  // Engine Settings
  private $setThemesConstruct;

  // Engine Protected Config
  public $system = "core";
  public $themes = "themes";

  // Engine Public Config
  public $themes_name = "";
  public $themes_file = "theme.json";
  public $themes_config = [];

  function __construct($themes_path = "") {
    // Set Themes Path
    if ($themes_path)
      $this->themes .= DIRECTORY_SEPARATOR.$themes_path;
      $this->themes_name = $themes_path;
      $this->setThemesConstruct = true;

    // Import Config File
    if (file_exists($this->themes.DIRECTORY_SEPARATOR.$this->themes_file)) {
      $config_file_open = file_get_contents($this->themes.DIRECTORY_SEPARATOR.$this->themes_file);
      if ($config_file_open) {
        $config_file_array = json_decode($config_file_open, true);
        if (is_array($config_file_array)) $this->themes_config = $config_file_array;
      }
    }
  }

  /**
   * Set Theme Path
   *
   * @param string $themes_path
   */
  public function setTheme($themes_path = "") {
    if (!$this->setThemesConstruct && $themes_path) $this->themes .= DIRECTORY_SEPARATOR.$themes_path;
  }

  /**
   * Minify Assets File
   *
   * @param array $array  assets urls list
   * @param string $type  assets type [script|style]
   * @return string
   */
  public function minify($array, $type = "script") {
    if (is_array($array)) {
      $fileData = "";
      foreach ($array as $file) {
        if (file_exists($file)) $fileData .= str_replace(["\n", "  "], "", @file_get_contents($file))."\n";
      }
      $cacheTime = strtotime("-1 day 00:00");
      if ($type === "script") list($file, $html) = array("app.js", "<script src='{$this->system}/assets/app.js?v=$cacheTime'></script>");
      if ($type === "style") list($file, $html) = array("style.css", "<link rel='stylesheet' href='{$this->system}/assets/style.css?v=$cacheTime'>");
      if (!file_exists($this->system.'/assets/'.$file)) fopen($this->system.'/assets/'.$file, "w");
      $minifyFile = fopen($this->system.'/assets/'.$file, 'w');
      fwrite($minifyFile, $fileData);
      fclose($minifyFile);
      return $html;
    }
  }

  /**
   * Load Minify JS
   *
   * @param array $minifyFileList
   * @return string
   */
  public function loadJS($minifyFileList = []) {
    if (is_array($minifyFileList)) {
      if ($this->themes_config["scripts"]) {
        foreach ($this->themes_config["scripts"] as $localFileDir) {
          if (!in_array($this->themes.DIRECTORY_SEPARATOR.$localFileDir, $minifyFileList))
            array_push($minifyFileList, $this->themes.DIRECTORY_SEPARATOR.$localFileDir);
        }
      }
      $pre_script = $this->themes_config["pre-script"];
      if (is_array($pre_script)) {
        foreach ($pre_script as $key => $preScriptDir) {
          $pre_script[$key] = $this->themes.DIRECTORY_SEPARATOR.$preScriptDir;
        }
      }
      return $this->minify(array_merge($pre_script, $minifyFileList), "script");
    }
  }

  public function loadLayout() {
    return str_replace(["<template>", "</template>"], ["<div>", "</div>"], @file_get_contents($this->themes."/layout/layout.html"));
  }
}