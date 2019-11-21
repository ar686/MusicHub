<?php
require_once 'path.inc';
require_once 'rabbitMQLib.inc';
require_once 'get_host_info.inc';

$client = new rabbitMQClient("api.ini","testServer");

$request = array(); // From POST, input username/password into the $request array.
$request['search'] = $_GET['search'];
$search = $request['search'];
	
$response = $client->send_request($request); // Store the response of send request.

$array = json_decode($response, true);
echo $array;

foreach($array as $key=>$value) {
     echo $key . "=>" . $value . "<br>";

}

?>
