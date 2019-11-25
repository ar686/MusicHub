<?php

ini_set("display_errors", 0);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);

require_once 'dbconfig.php';
require_once 'path.inc';
require_once 'rabbitMQLib.inc';
require_once 'get_host_info.inc';
require_once 'api_receiver.php';
require_once 'api_db_receiver.php';

function CheckDb($id){
{
    $database = new mysqli("localhost", "root", "password", "website");
    
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL database: " . mysqli_connect_error();
        exit();
  }
  for($i=0; $i < count($track_id); $i++){
  
  $id = $database->query("SELECT artist_id FROM music WHERE track_id = '$track_id'");

    doSearch($id);
   doCheck($id);
   echo "Database updated". PHP_EOL;
  
}
}
}
?>
