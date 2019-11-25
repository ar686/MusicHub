<?php

$connect = mysqli_connect("localhost", "root", "password", "website");

$filename = ".json";

$data = file_get_contents ($filename);

$array = json_decode($data, true);

foreach($array as $row)
{
	$sql = "INSERT INTO tbl_music(id, title, artist, genre, duration, preview, picture) 
	VALUES('".$row["id"]."','".$row["title"]."','".$row["name"]."','".$row["genre"]."','".$row["duration"]."','".$row["preview"]."','".$row["picture"]."',)";
	
	mysqli_query($connect, $sql);
}

?>
