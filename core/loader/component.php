<?php
  require_once "../vendor.php";
  require_once "../EngineLoader.php";

  if (isset($_GET["e"]) && isset($_GET["n"])) {
    $getDir = strip_tags(trim(addslashes($_GET["e"])));
    $getName = strip_tags(trim(addslashes($_GET["n"])));
    // TODO: Return error messages
    if (!$getDir) return false;
    $loader = new EngineLoader(ACTIVE_THEME);
    if ($loader->checkComponent($getDir)) {
      // Get JS Code
      $getJSCode = $loader->getComponent(".js", $getName);
      // Get HTML File
      $getHTMLCode = $loader->getComponent(".html", $getName);
      // Minift HTML Codes
      $getHTMLCode = $loader->minifyHTML($getHTMLCode);
      if ($getJSCode && $getHTMLCode) {
        echo str_replace("VUE.ENGINE", "`$getHTMLCode`", $getJSCode);
      } else {
        return false;
      }
    } else {
      return false;
    }
  }