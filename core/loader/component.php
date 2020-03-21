<?php
  require_once "../vendor.php";
  require_once "../EngineLoader.php";

  if (isset($_GET["e"]) && isset($_GET["n"])) {
    $getDir = strip_tags(trim(addslashes($_GET["e"])));
    $getName = strip_tags(trim(addslashes($_GET["n"])));
    // TODO: Return error messages
    if (!$getDir) return false;
    $loader = new EngineLoader();
    if ($loader->checkComponent($getDir)) {
      $getHTMLCode = $loader->getComponent(".html", $getName);
      $getHTMLCode = $loader->minifyHTML($getHTMLCode);
      $getJSCode = $loader->getComponent(".js", $getName);
      echo str_replace("VUE.ENGINE", "`$getHTMLCode`", $getJSCode);
    } else {
      return false;
    }
  }