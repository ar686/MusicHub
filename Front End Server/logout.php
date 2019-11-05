<?php 
   if(isset($_GET['token']) || $_GET['token'] == $_SESSION['random']){
    header("Location: index.html");
}
else{
   session_start();
   $_SESSION = array();
   session_destroy(); // Destroy the session.
   exit;
}
?>