<?php
  /*
  *  Site Global Configuration File
  *  Copyright (c) 2012 - Verexa
  */

  global $config;
  global $lang;
  
  /* Site Configuration */
  $config["site"]["production"] = false;
  $config["site"]["time_zone"] = "UTC";
  $config["site"]["title"] = "";
  $config["site"]["url"] = "";
  $config["site"]["default_lang"] = "en_US";
  $config["site"]["enabled_lang"] = array();
  
  /* Plugins Configuration */
  $config["plugin"]["url_helper"] = array(
    "active" => false,
    "dir" => SYSTEM_PLUGIN."url_helper",
    "file" => "plugin.php"
  );
  
  /* Language Configuaration */
  $config["lang"]["en_US"] = array(
    "name" => "en_US",
    "active" => true,
    "file" => SYSTEM_LANG."en_US.php"
  );
  
?>