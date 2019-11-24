<?php
ini_set("display_errors", 0);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);

require_once 'dbconfig.php';
require_once 'path.inc';
require_once 'rabbitMQLib.inc';
require_once 'get_host_info.inc';

function requestProcessor($db_request){
    echo "Received request:" . PHP_EOL;
    var_dump($request);
    $insertion = doCheck($db_request);
}

function doCheck($db_request){
    $database = new mysqli("localhost", "root", "password", "website");
    
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL database: " . mysqli_connect_error();
        exit();
    }
    
    for ($i = 0; $i < count($db_request); $i++){
    
      $artist_id = $db_request[$i]['artist_id'];
      $name = $db_request[$i]['name'];
      $album_id = $db_request[$i]['album_id'];
      $album_title = $db_request[$i]['album_title'];
      $track_id = $db_request[$i]['track_id'];
      $track_title = $db_request[$i]['track_title'];
      $track_duration = $db_request[$i]['track_duration'];
    
      //$artist_id = $database->real_escape_string($artist_id);
      //$name = $database->real_escape_string($name);
      //$album_id = $database->real_escape_string($album_id);
      //$album_title = $database->real_escape_string($album_title);
      //$track_id = $database->real_escape_string($track_id);
      //$track_title = $database->real_escape_string($track_title);
      //$track_duration = $database->real_escape_string($name);
      
      $database->query("INSERT INTO music (artist_id, name, album_id, album_title, track_id, track_title,
      track_duration) VALUES ('$artist_id', '$name', '$album_id', '$album_title', '$track_id', '$track_title',
      '$track_duration')");
    }
}
echo "Rabbit MQ Server Start" . PHP_EOL;
$server = new rabbitMQServer("api_db.ini", "testServer");
$server->process_requests('requestProcessor');
exit();
?>
