<?php
  /*
  *  OpenInspire Framework - Index Page
  *  Copyright (c) 2012 - Verexa
  */
  
  define("BASE_DIR", __DIR__."/");
  define("SYSTEM", BASE_DIR."system/");
  define("SYSTEM_LIB", SYSTEM."libraries/");
  define("SYSTEM_PLUGIN", SYSTEM."plugins/");
  
  require_once SYSTEM."config.php";
  require_once SYSTEM."main.php";
  require_once SYSTEM."dispatch.php";
  
  run();
?>