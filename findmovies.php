<?php
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: index.php");
    die;
}

$elementsPerPage = 15;

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$db = new PDO("mysql:dbname=tweb; host=localhost", "root", "");
	
	if(isset($_POST['title']))
		$title = $_POST['title'];
	$titleE = empty($title);
	if(isset($_POST['year']))
		$year = $_POST['year'];
	$yearE = empty($year);
	if(isset($_POST['director']))
		$director = $_POST['director'];
	$directorE = empty($director);
	if(isset($_POST['wishlist']) && $_POST['wishlist'] == 1)
		$wishlist = "";
	else
		$wishlist = "LEFT";
	
	if(isset($_POST['page']))
		$page = $_POST['page'];
	else
		$page = 1;
	

	
	if(!$yearE)
		$year = $db->quote($year); 
	
	$userid = $_SESSION["userid"];

	$extraQuery = "";
	if(!$titleE || !$yearE || !$directorE)
		$extraQuery = " WHERE ";
	$amount = 0;
	if(!$titleE){
		$extraQuery = $extraQuery . "m.name LIKE '%$title%' ";
		$amount++;
	}
	if(!$yearE){
		if($amount == 0)
			$extraQuery = $extraQuery . "m.year = $year ";
		else
			$extraQuery = $extraQuery . "AND m.year = $year ";
		$amount++;
	}
	if(!$directorE){
		if($amount == 0)
			$extraQuery = $extraQuery . "CONCAT(d.first_name, ' ', d.last_name) LIKE '%$director%'";
		else
			$extraQuery = $extraQuery . "AND CONCAT(d.first_name, ' ', d.last_name) LIKE '%$director%'";
			
	}
	
	$queryRowsCount = "SELECT COUNT(*) AS 'count' FROM (SELECT m.id FROM movies m JOIN movies_directors md ON md.movie_id = m.id 
	JOIN directors d ON d.id = md.director_id $wishlist JOIN wishlist w ON (w.movieID = m.id AND w.userID = $userid)
                 $extraQuery GROUP BY m.id) t";
	
	
	$rowsCount = $db->query($queryRowsCount);
	$rowsAmount = 0;
	foreach($rowsCount as $r){
		$rowsAmount = $r["count"];
	}
	
	
	$pagesAmount = ceil($rowsAmount/$elementsPerPage);
	if($page < 1)
		$page = 1;
	else if($page > $pagesAmount)
		$page = $pagesAmount;
	$offset = ($page-1)*$elementsPerPage;
	if($offset < 0)
		$offset = 1;
	
	$queryBase = "SELECT m.id, m.name, m.year, w.userID, GROUP_CONCAT(\" \",d.first_name, \" \", d.last_name) AS 'directors'
                FROM movies m JOIN movies_directors md ON md.movie_id = m.id 
                JOIN directors d ON d.id = md.director_id 
                $wishlist JOIN wishlist w ON (w.movieID = m.id AND w.userID = $userid) $extraQuery GROUP BY m.id LIMIT $offset,  $elementsPerPage";
	
	$rows = $db->query($queryBase);
	header("Content-type: application/json");
    print "{\n";
	print "\"movies\": [\n";
	if($rows->rowCount() == 0){
		print "{\"info\": \"no movies\"}\n";
	}
	else{
		
		$i = 1;
		
		print "{\"amount\": \"$pagesAmount\"},\n";
		print "{\"current\": \"$page\"},\n";
		
		foreach($rows as $row){
			$t = str_replace("\"", "", $row['name']);
			$y = str_replace("\"", "", $row['year']);
			$d = str_replace("\"", "", $row['directors']);
			$w = str_replace("\"", "", $row['userID']);
			$mid = str_replace("\"", "", $row['id']);
			print "{\"title\": \"$t\", \"year\": \"$y\", \"directors\": \"$d\", \"wishlist\": \"$w\", \"id\": \"$mid\"}";
			
			if($i < $rows->rowCount())
				print ",";
			$i++;
			print "\n";
		}
		
	}
	print "]\n";
	
	print "}\n";
	
}

?>