<?php
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: index.php");
    die;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script src="js/common.js"></script>
	<script src="js/jquery-3.2.1.min.js"></script> 
  	<script src="js/bootstrap-4.0.0.js"></script>
	<script src="js/movies.js"></script>
	<script src="js/explore.js"></script>
	<title>xMovies</title>
</head>

	<?php
		include('top.php');
	?>
	
	<div class="container">
		
		<h2 class="text-center mb-5">Explore new movies</h2>
		<?php
			include('searchbar.html');
		?>
		<div id="wrong"></div>
		<div id="movies"></div>
		<div id="pag"></div>

<?php
	include ("bottom.html");
?>

