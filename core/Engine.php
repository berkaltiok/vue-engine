<?php

class Engine
{
  // Engine Settings
  private $setThemesConstruct;

  // Engine Public Config
  public $themes = "themes";
  public $config_file = "config.json";
  public $config = [];

  function __construct($themes_path = "") {
    // Set Themes Path
    if ($themes_path) $this->themes .= "/$themes_path"; $this->setThemesConstruct = true;
    // Import Config File
    if (file_exists($this->themes.SLASH.$this->config_file)) {
      $config_file_open = file_get_contents($this->themes.SLASH.$this->config_file);
      if ($config_file_open) {
        $config_file_array = json_decode($config_file_open, true);
        if (is_array($config_file_array)) $this->config = $config_file_array;
      }
    }
  }

  /**
   * Set Theme Path
   * @param string $themes_path
   */
  public function setTheme($themes_path = "") {
    if (!$this->setThemesConstruct && $themes_path) $this->themes .= "/$themes_path";
  }

  /**
   * Minify Assets File
   * @param array $array
   * @param string $type
   */
  public function minify($array, $type = 'js') {
    if (is_array($array)) {
      $fileData = "";
      foreach ($array as $file) {
        if (file_exists($file)) $fileData .= str_replace(["\n", "  "], "", fopen($file, "r"));
      }
      // TODO: File control, write file, return file url/tags
    }
  }
}