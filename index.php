<?php
  $system_path = 'core';
  $themes_folder = 'themes';

  if (!is_dir($system_path)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: ' . pathinfo(__FILE__, PATHINFO_BASENAME);
    die();
  }
  if (($_temp = realpath($system_path)) !== FALSE) {
    $system_path = $_temp . DIRECTORY_SEPARATOR;
  } else {
    $system_path = strtr(
        rtrim($system_path, '/\\'),
        '/\\',
        DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
      ) . DIRECTORY_SEPARATOR;
  }

  define('DIR', __DIR__);
  define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
  define('BASEPATH', $system_path);
  define('FCPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
  define('SYSDIR', basename(BASEPATH));

  if (is_dir($themes_folder)) {
    if (($_temp = realpath($themes_folder)) !== FALSE) {
      $themes_folder = $_temp;
    } else {
      $themes_folder = strtr(
        rtrim($themes_folder, '/\\'),
        '/\\',
        DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
      );
    }
  } else {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
    die();
  }

  define('APPPATH', $themes_folder . DIRECTORY_SEPARATOR);

  require_once BASEPATH . "vendor.php";