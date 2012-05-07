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
      if(file_exists($lang["file"])){
        require_once $lang["file"];
        array_push($config["site"]["enabled_lang"], $lang["name"]);
      }
    }
  }
  
  /* Load Plugins */
  foreach($config["plugin"] as $plugin){
    if($plugin["active"]){
      if(file_exists($plugin["dir"] . $plugin["file"])){
        require_once $plugin["dir"] . $plugin["file"];
        
        $plugin_class = $plugin["class"]."_Plugin";
        
        if(method_exists($plugin_class, $plugin["method"])){
          $plugin_enabled = array(
            "class" => $plugin["class"],
            "instance" => new $plugin_class
          );
          
          call_user_func(array($plugin_enabled["instance"], $plugin["method"]), $plugin["dir"]);
          array_push($config["site"]["enabled_plugin"], $plugin_enabled);
        }
      }
    }
  }
  
  /* Run The Site */
  function run(){
    global $dispatch;
    
    $url = $_GET['url'];
    $split_url = explode("/", trim($url, "/"));
    $count_url = count($split_url);
    
    $page_set = false;
    
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
          if(file_exists(BASE_DIR . "controllers/" . $page["controller"] . ".php")){
            require_once BASE_DIR . "controllers/" . $page["controller"] . ".php";
            
            $controller_class = $page["controller"] . "_Controller";
            
            if(method_exists($controller_class, $page["function"])){
              $controller = new $controller_class;
            
              call_user_func(array($controller, $page["function"]), $params);
              $page_set = true;
            }
            else{
              error(500, "Method " . $page["controller"] . "_Controller::" . $page["function"] . "() Does Not Exist!");
              $page_set = true;
            }
          }
          else{
            error(500, "Controller " . $page["controller"] . ".php Does Not Exist!");
            $page_set = true;
          }
          
          break;
        }
      }
    }
    
    if(!$page_set) error(404, "Page Does Not Exist!");
  }
  
  /* Plugin Getting Stuff*/
  function plugin($class){
    global $config;
    
    foreach($config["site"]["enabled_plugin"] as $plugin){
      if($class == $plugin["class"]){
        return $plugin["instance"];
      }
    }
    
    return false;
  }
  
  /* Rendering Views */
  function render($view, $params = array()){
    if(file_exists(BASE_DIR . "views/" . $view . ".php")) require_once BASE_DIR . "views/" . $view . ".php";
  }
  
  /* Error Function */
  function error($num = 0, $info = ""){
    echo "<b>Error " . $num . "</b><br>Additional Info: <code>" . $info . "</code>";
  }
?>