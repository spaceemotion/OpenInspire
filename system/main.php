<?php
  /*
  *  OpenInspire Framework - Main System  
  *  Copyright (c) 2012 - Verexa
  */
  
  /* Requiring Libraries */
  require_once SYSTEM_LIB."Controller.php";
  require_once SYSTEM_LIB."Plugin.php";
  require_once SYSTEM_LIB."Model.php";
  
  /* Requiring Functions */
  require_once SYSTEM_LIB."Dispatch.php";
  
  /* Load Languages */
  foreach($config["lang"] as $lang){
    if($lang["active"]){
      require_once $lang["file"];
      array_push($config["site"]["enabled_lang"], $lang["name"]);
    }
  }
  
  /* Load Plugins */
  foreach($config["plugin"] as $plugin){
    
  }
  
  /* Run The Site */
  function run(){
    global $dispatch;
    $url = $_GET['url'];
    $split_url = explode("/", trim($url, "/"));
    $count_url = count($split_url);
    
    foreach($dispatch as $page){
      $regex_count = count($page["regex"]);
      
      if($regex_count == $count_url){
        $match_count = 0;
        $params = array();
        $param_count = 0;
      
        for($i = 0; $i < $regex_count; $i++){
          if($page["regex"][$i] != $split_url[$i] && $page["regex"][$i] != '*') break;
          elseif($page["regex"][$i] == '*'){
            $params[$page["params"][$param_count]] = $split_url[$i];
            $match_count++;
            $param_count++;
          }
          else $match_count++;
        }
        
        if($match_count == $count_url){
          break;
        }
      }
    }
  }
?>