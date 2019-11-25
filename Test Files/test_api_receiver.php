<?php
ini_set("display_errors", 0);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);

require_once 'path.inc';
require_once 'rabbitMQLib.inc';
require_once 'get_host_info.inc';

function requestProcessor($db_request){
  echo "Received Request: " . PHP_EOL;
  var_dump($request);
  $results = doSearch($request['search']);
  return $results;
}

function doSearch($search_string){
  ini_set("allow_url_fopen", 1);

$curl = curl_init();

curl_setopt_array($curl, array(
        CURLOPT_URL => "https://deezerdevs-deezer.p.rapidapi.com/search?q=$search_string",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: deezerdevs-deezer.p.rapidapi.com",
                "x-rapidapi-key: 335c244f74msh59e1c3fea4460a2p1b1008jsna8fab81eacf0"
        ),
));
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
        echo "cURL Error #:" . $err;
        return 0;
} else {
        return $response;
  }
}
$server = new rabbitMQServer("api.ini","testServer");
$server->process_requests('requestProcessor');
exit();
?>
