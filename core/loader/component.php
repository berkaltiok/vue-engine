<?php
  $now_theme = "";
  if (!$_GET["f"]) return false;
  $getJSFile = file_get_contents("../../themes/$now_theme" . $_GET["f"] . ".js");
  $getHTMLFile = file_get_contents("../../themes/$now_theme" . $_GET["f"] . ".html");
  $clearHTMLFile = str_replace("\n", "  ", $getHTMLFile);
  echo str_replace("VUE.ENGINE", "`$clearHTMLFile`", $getJSFile);