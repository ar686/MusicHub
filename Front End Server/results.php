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

$artist_keys = array('id', 'name');
$album_keys = array('id', 'title');
$track_keys = array('id', 'title', 'duration');

$pass = array();

for($i = 0; $i < $assoc['total']; $i++){

    $artist_id_data = $assoc['data'][$i]['artist'][$artist_keys[0]];
    $artist_name_data = $assoc['data'][$i]['artist'][$artist_keys[1]];

    $album_id_data = $assoc['data'][$i]['album'][$album_keys[0]];
    $album_title_data = $assoc['data'][$i]['album'][$album_keys[1]];

    $track_id_data = $assoc['data'][$i][$track_keys[0]];
    $track_title_data = $assoc['data'][$i][$track_keys[1]];
    $track_duration_data = $assoc['data'][$i][$track_keys[2]];

    if ($artist_id_data != "" || $artist_name_data != ""){
      $pass[$i] = array('artist_id'=> $artist_id_data, 'name'=> $artist_name_data, 
      'album_id' => $album_id_data, 'album_title' => $album_title_data, 'track_id' => $track_id_data, 
      'track_title' => $track_title_data, 'track_duration' => $track_duration_data);
}
//echo '<pre>'; print_r($pass); echo '</pre>';
?>
