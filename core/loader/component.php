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
      preg_match_all('@<component:(.*?)>@si', $getHTMLCode, $findComponent);
      $getHTMLCode = str_replace(["<template>", "</template>", "<component:", "</component:"], ["<div>", "</div>", "<", "</"], $getHTMLCode);
      $componentVue = "";
      if ($findComponent[1]) foreach ($findComponent[1] as $value) {
        $getComponentName = explode(" ", $value);
        if ($getComponentName[0]) {
          $finnalyComponentName = str_replace("/", "", $getComponentName[0]);
          $componentVue .= "{$finnalyComponentName}: load('{$finnalyComponentName}', '/components/{$finnalyComponentName}'),";
        }
      }
      // Minift HTML Codes
      $getHTMLCode = $loader->minifyHTML($getHTMLCode);
      $getHTMLCode = str_replace("VUE.THEME", $loader->getTheme(), $getHTMLCode);
      if ($getJSCode && $getHTMLCode) {
        echo str_replace(["VUE.THEME", "VUE.COMPONENT", "VUE.ENGINE"], [$loader->getTheme(), "{{$componentVue}}", "`$getHTMLCode`"], $getJSCode);
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
