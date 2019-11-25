<?php
require_once 'path.inc';
require_once 'rabbitMQLib.inc';
require_once 'get_host_info.inc';

$client = new rabbitMQClient("api.ini","testServer");
$database = new rabbitMQClient("api_db.ini", "testServer");

$request = $_GET['search'];

// Send request to the database to check if results exist for the particular search query.

$exists = $database->send_request($request); // EXISTS NEEDS TO BE AN ARRAY NOT A TRUEFALSE. NVM

if ($exists) {  // If the database already has the results for that search, and no new records need to be added.
  echo '<pre>'; print_r($exists); echo '</pre>'; // Display them on the webpage.
}
else { 
  $response = $client->send_request($request); // Fetch the data for the search query and decode the JSON.
  $assoc = json_decode($response, true);

  // Indicate the keys we are interested in:

  $artist_keys = array('id', 'name');
    
  $album_keys = array('id', 'title');
  $track_keys = array('id', 'title', 'duration');

  $pass = array(); // An array of key-value pairs to send to the database.

  for($i = 0; $i < $assoc['total']; $i++){ // Loop through the results.
  $artist_id_data = $assoc['data'][$i]['artist'][$artist_keys[0]];
  $artist_name_data = $assoc['data'][$i]['artist'][$artist_keys[1]];

  $album_id_data = $assoc['data'][$i]['album'][$album_keys[0]];
  $album_title_data = $assoc['data'][$i]['album'][$album_keys[1]];

  $track_id_data = $assoc['data'][$i][$track_keys[0]];
  $track_title_data = $assoc['data'][$i][$track_keys[1]];
  $track_duration_data = $assoc['data'][$i][$track_keys[2]];

  if ($artist_id_data != "" || $artist_name_data != "") { // Populate the $pass array to get it ready for sending.
    $pass[$i] = array('artist_id'=> $artist_id_data, 'name'=> $artist_name_data, 
    'album_id' => $album_id_data, 'album_title' => $album_title_data, 'track_id' => $track_id_data, 
    'track_title' => $track_title_data, 'track_duration' => $track_duration_data);
      }
  }
  // Send a request to the database to insert the previously obtained new results into the database.
  $database->send_request($pass);
}
?>
