<?php
require_once 'path.inc';
require_once 'rabbitMQLib.inc';
require_once 'get_host_info.inc';
     
$client = new rabbitMQClient("registration.ini", "testServer");
$request_user['username'] = $_POST['username'];
$request_pass['password'] = $_POST['password'];
$username = $request_user['username'];
$password = $request_pass['password'];
$request = array($username, $password);
	
$response = $client->send_request($request); // Store the response of send request.

if($response == 0){ // Start session & redirect on login.
   session_start();
   $_SESSION['username'] = $username;
   header ("Location: login.html"); // Redirect.
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="css/images/logo.png">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
         integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
         integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
         integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
         integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
         integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Rancho|Roboto|Pacifico|Lato&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="css/style.css">
      <title>Signup- MusicHub</title>
   </head>
   <body>
      <header class="header">
      <nav class="navbar navbar-expand-lg bg-dark fixed-top">
         <a class="navbar-brand" style="color:#fff" href="index.html">
         <img src="css/images/logo.png" width="45" alt="" class="d-inline-block align-middle mr-2">
         <span class="" style="font-family:'Pacifico', cursive;">MusicHub</span></a>
         <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
         <div id="navbarSupportedContent" class="collapse navbar-collapse" style="font-family:'Lato'">
            <ul class="navbar-nav ml-auto">
               <li class="nav-item active"><a href="index.html" style="color:#fff" class="nav-link text-uppercase font-weight-bold">Home <span class="sr-only">(current)</span></a></li>
               <li class="nav-item"><a href="register.html" style="color:#fff" class="nav-link text-uppercase font-weight-bold">Sign Up</a></li>
               <li class="nav-item"><a href="login.html" style="color:#fff" class="nav-link text-uppercase font-weight-bold">Sign In</a></li>
            </ul>
         </div>
         </div>
      </nav>
      <?php if($response == 1) : ?>
      <section class="py-5">
         <div class="container py-5">
            <!-- <div class="wrapper"> (Optional wrapper to make text more compact, add a </div> after </form>) -->
            <br>
            <?php 
            echo "This user is already registered.\n";
            echo "<br><br><a href=register.html>Return</a>";
            ?>
         </div>
      </section>
      <?php endif; ?>
      <!-- Add a footer here.-->
    </body>
</html>
