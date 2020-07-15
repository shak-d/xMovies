<?php
session_start();
if (isset($_SESSION["name"])) {
    header("Location: explore.php");
    die;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>xMovies - Login</title>
	<link href="css/style.css" rel="stylesheet">
	<link href="css/sign.css" rel="stylesheet">
    <link href="css/bootstrap-4.0.0.css" rel="stylesheet">
	<script src="js/jquery-3.2.1.min.js"></script> 
	<script src="js/common.js"></script>
	<script src="js/index.js"></script>

  </head>
   
<body>
	
    <form class="form-sign text-center" onSubmit="">
		<h1 class="mb-4">xMovies</h1>
  		<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
		<div id="wrong"></div>
  		<label for="signinemail" class="sr-only">Email address</label>
  		<input type="email" name="email" id="signinemail" class="form-control top-control" placeholder="Email address" required autofocus>
  		<label for="signinpassword" class="sr-only">Password</label>
  		<input type="password" id="signinpassword" name="password" class="form-control bottom-control" placeholder="Password" required>
  		<button id="signin" class="btn btn-lg btn-primary btn-block" type="button">Sign in</button>
		<button id="signguest" class="btn btn-lg btn-secondary btn-block" type="button">Sign in as Guest</button>
		<button id="register" class="btn btn-link btn-block btn-sm" type="button">Not a member?</button>
	</form>
  </body>
</html>
