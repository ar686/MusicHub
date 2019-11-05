<?php
// Database credentials.
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'website');
 
// Attempt to connect to MySQL database.
$database = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check the connection.
if($database === false){
    die("Error: Could not connect! " . mysqli_connect_error());
}
?>