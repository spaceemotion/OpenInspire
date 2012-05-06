<?php
  /*
  *  Site Global Configuration File
  *  Copyright (c) 2012 - Verexa
  */
  
  global $config;
  
  /* Site Configuration */
  $config["site"]["production"] = false;
  $config["site"]["time_zone"] = "UTC";
  $config["site"]["title"] = "";
  $config["site"]["url"] = "";
  $config["site"]["default_lang"] = "en_US";
  
  /* Plugins Configuration */
  $config["plugin"]["url_helper"] = array(
    "active" => false,
    "dir" => SYSTEM_PLUGIN."url_helper"
  );
  
?>