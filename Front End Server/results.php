<?php
require_once 'path.inc';
require_once 'rabbitMQLib.inc';
require_once 'get_host_info.inc';

$client = new rabbitMQClient("api.ini","testServer");

$request = array(); // From POST, input username/password into the $request array.
$request['search'] = $_GET['search'];
$search = $request['search'];
	
$response = $client->send_request($request); // Store the response of send request.

$assoc = json_decode($response, true);
$assoc = string($assoc);

$wantedArtistKeys = array('id', 'name');
$wantedAlbumKeys = array('id', 'title');
$wantedTrackKeys = array('id', 'title', 'duration');

for($i=0;$i<$assoc['total'];$i++){

  echo "<br>";

  foreach ($wantedArtistKeys as $value) { 
    echo $assoc['data'][$i]['artist'][$value] . PHP_EOL;
    echo "<br>";
  }

  foreach ($wantedAlbumKeys as $value) {
    echo $assoc['data'][$i]['album'][$value] . PHP_EOL;
    echo "<br>";
  }

  foreach ($wantedTrackKeys as $value) {
    echo $assoc['data'][$i][$value] . PHP_EOL;
    echo "<br>";
  }
}

?>
