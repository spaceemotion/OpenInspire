<?php

  class Database_Plugin extends Plugin{
    private $info = array(
      "type" => "mysql",
      "location" => "localhost",
      "username" => "test",
      "password" => "pass",
      "database" => "test"
    );
    
    /* Plugin Loading */
    public function load(){
      self::connect();
      self::select_db($this->info["database"]);
    }
    
    /* Connect to Database */
    public function connect(){
      switch($this->info["type"]){
        case "mysql": 
          mysql_connect($this->info["location"], $this->info["username"], $this->info["password"]);
          break;
      }
    }
    
    /* Change Host */
    public function change_host($host){
      $this->info["location"] = $host;
    }
    
    /* Select Database */
    public function select_db($database){
      switch($this->info["type"]){
        case "mysql": 
          mysql_select_db($database);
          break;
      }
    }
    
    /* Run Query on Database */
    public function run_query($query){
      switch($this->info["type"]){
        case "mysql":
          return mysql_query($query)
      }
    }
    
    /* Fetch Array of Result */
    public function fetch_array($result){
      switch($this->info["type"]){
        case "mysql": 
          return mysql_fetch_array($result);
      }
    }
  }

?>