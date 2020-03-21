<?php

class Engine
{
  // Engine Settings
  private $setThemesConstruct;
  private $setDirectionConstruct;

  // Engine Protected Config
  public $themes = "themes";
  public $direction = "";

  // Engine Public Config
  public $direction_name = "";
  public $themes_name = "";
  public $themes_file = "theme.json";
  public $themes_config = [];

  function __construct($themes_path = "", $direction_path = "") {
    // Set Themes Path
    if ($themes_path)
      $this->themes .= DIRECTORY_SEPARATOR.$themes_path;
      $this->themes_name = $themes_path;
      $this->setThemesConstruct = true;

    if ($direction_path)
      $this->direction .= "/".$direction_path;
      $this->direction_name = $direction_path;
      $this->setDirectionConstruct = true;

    // Import Config File
    if (file_exists($this->getTheme().DIRECTORY_SEPARATOR.$this->themes_file)) {
      $config_file_open = file_get_contents($this->getTheme().DIRECTORY_SEPARATOR.$this->themes_file);
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
  public function minify($array, $type = "js") {
    if (is_array($array)) {
      $fileData = "";
      foreach ($array as $file) {
        if (file_exists($file)) $fileData .= str_replace(["   ", "  "], "", @file_get_contents($file))."\n";
      }
      $cacheTime = strtotime("-1 day 00:00");
      if ($type === "js") list($file, $html) = array("app.js", "<script src='{$this->getDirection()}/{$this->getTheme()}/assets/js/app.js?v=$cacheTime'></script>");
      if ($type === "css") list($file, $html) = array("build.css", "<link rel='stylesheet' href='{$this->getDirection()}/{$this->getTheme()}/assets/css/build.css?v=$cacheTime'>");
      if (!file_exists($this->getTheme().'/assets/'.$type.DIRECTORY_SEPARATOR.$file)) fopen($this->getTheme().'/assets/'.$type.DIRECTORY_SEPARATOR.$file, "w");
      $minifyFile = fopen($this->getTheme().'/assets/'.$type.DIRECTORY_SEPARATOR.$file, 'w');
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
          if (!in_array($this->getTheme().DIRECTORY_SEPARATOR.$localFileDir, $minifyFileList))
            array_push($minifyFileList, $this->getTheme().DIRECTORY_SEPARATOR.$localFileDir);
        }
      }
      $pre_script = $this->themes_config["pre-script"];
      if (is_array($pre_script)) {
        foreach ($pre_script as $key => $preScriptDir) {
          $pre_script[$key] = $this->getTheme().DIRECTORY_SEPARATOR.$preScriptDir;
        }
      }
      return $this->minify(array_merge($pre_script, $minifyFileList), "js");
    }
  }
  public function loadCSS($minifyFileList = []) {
    if (is_array($minifyFileList)) {
      if ($this->themes_config["styles"]) {
        foreach ($this->themes_config["styles"] as $localFileDir) {
          if (!in_array($this->getTheme().DIRECTORY_SEPARATOR.$localFileDir, $minifyFileList))
            array_push($minifyFileList, $this->getTheme().DIRECTORY_SEPARATOR.$localFileDir);
        }
      }
      return $this->minify($minifyFileList, "css");
    }
  }

  public function getTheme() {
    return str_replace("\\", "/", $this->themes);
  }

  public function getDirection() {
    return $this->direction;
  }
}