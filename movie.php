<?php
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: index.php");
    die;
}

if(!isset($_GET["id"])){
	header("Location: explore.php");
	die;
}


$db = new PDO("mysql:dbname=tweb; host=localhost", "root", "");
$movieid = $db->quote($_GET["id"]);
$userid = $db->quote($_SESSION["userid"]);

$basicQuery = "SELECT m.name, m.year, m.rank, GROUP_CONCAT( DISTINCT d.first_name , \" \", d.last_name) AS 'directors', GROUP_CONCAT(\" \", mg.genre) AS 'genres', w.userID 
			  FROM movies m 
			  JOIN movies_directors md ON md.movie_id = m.id 
			 JOIN directors d ON d.id = md.director_id
			 JOIN movies_genres mg ON mg.movie_id = m.id
			 LEFT JOIN wishlist w ON (w.userID = $userid AND w.movieID = m.id)
			 WHERE m.id = $movieid
			 GROUP BY m.name";
$title = "";
$rank = "";
$directors = "";
$genres = "";
$year = "";
$wishlist = "";
$notfound = 2;

$rows = $db->query($basicQuery);
if($rows->rowCount() > 0){
		
		foreach($rows as $row){
			
			$title = $row['name'];
			$rank = $row['rank'];
			$directors = $row['directors'];
			$genres = $row['genres'];
			$year = $row['year'];
			$wishlist = $row['userID'];
		}
		$queryActors = "SELECT a.first_name, a.last_name, r.role FROM actors a JOIN roles r ON r.actor_id = a.id JOIN movies m ON m.id = r.movie_id WHERE m.id = $movieid";
	
		$rows = $db->query($queryActors);
}
else
	$notfound = 1;
?>

<!doctype html>
<html>
<head>
<!--Alessandro Chakhov
Visualizza le informazione relative a un film-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script src="js/common.js"></script>
	<script src="js/jquery-3.2.1.min.js"></script> 
	<script src="js/bootstrap-4.0.0.js"></script>
	<script src="js/movie.js"></script>
	<title>xMovies</title>
</head>

<body>
	<?php
		include('top.php');
	?>
	
	<div class="container">
		
		<?php if($notfound == 1){ ?>
		
			<div class="alert alert-danger" role="alert">
  				This movie doesn't exist.
			</div>
		<?php } else{ ?>
		
			<h2 class="text-center p-3"><?= $title?></h2>
			<ul class="list-group p-3">
  				<li class="list-group-item">Director(s): <?= $directors?></li>
  				<li class="list-group-item">Year: <?= $year?></li>
				<li class="list-group-item">Rank: <?php if($rank)print $rank; else print 'N/A'?></li>
  				<li class="list-group-item">Genre(s): <?= $genres?></li>
				<li class="list-group-item">Actor(s): 
					<ul class="list-group p-3">
						<?php if($rows->rowCount() > 0){
								foreach($rows as $row){?>
						
									<li class="list-group-item"><?php print $row['first_name'].' '.$row['last_name'].': ';  if($row['role']) print $row['role']; else print 'N/A'; ?></li>
						<?php }} ?>
					</ul>
				</li>
			</ul>
			<div id="wrong"></div>
			<div class="float-right">
			<?php if(!isset($wishlist)){?>
			<a href="<?= htmlspecialchars($_GET["id"])?>" id="wish1" class="btn btn-primary btn-lg m-3" role="button" >Add to watchlist</a>
			<?php } else{?>
				<a href="<?= htmlspecialchars($_GET["id"])?>" id="wish2" class="btn btn-primary btn-lg m-3" role="button" >Remove from watchlist</a>
			<?php }} ?>
			</div>	
	</div>
	
</body>
</html>