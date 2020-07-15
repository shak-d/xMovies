<?php
session_start();

if (isset($_SESSION["name"])) {
    header("Location: explore.php");
    die;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>xMovies - Sign up</title>
	<link href="css/style.css" rel="stylesheet">
	<link href="css/sign.css" rel="stylesheet">
    <link href="css/bootstrap-4.0.0.css" rel="stylesheet">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/common.js"></script>
	<script src="js/signup.js"></script>
  </head>
<body>
	
    <form class="form-sign text-center">
		<h1 class="mb-4">xMovies</h1>
  		<h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
		<div id="wrong"></div>
		<label for="signupName" class="sr-only">Name</label>
  		<input type="text" id="signupName" class="form-control top-control" placeholder="Name" required autofocus>
  		<label for="signupEmail" class="sr-only">Email address</label>
  		<input type="email" id="signupEmail" class="form-control middle-control" placeholder="Email address" required>
  		<label for="signupPassword" class="sr-only">Password</label>
  		<input type="password" id="signupPassword" class="form-control bottom-control" placeholder="Password" required>
  		<button id="signup" class="btn btn-lg btn-primary btn-block" type="button">Sign up</button>
		<button id="signin" class="btn btn-link btn-block btn-sm" type="button">Already a member?</button>
	</form>
  </body>
</html>