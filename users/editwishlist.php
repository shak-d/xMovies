<?php
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: index.php");
    die;
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
	
	$checking = true;
	$id = $_GET['id'];
	$type = $_GET['type'];
	$userid = $_SESSION['userid'];
	
	if(empty($id) || empty($type)){
		print 'nodata';
	}
	else{
	
		$db = new PDO("mysql:dbname=tweb; host=localhost", "root", "");

		if($type == 1){
			
			$id = $db->quote($id);
			$userid = $db->quote($userid);
			
			$rows = $db->query("
				SELECT *
				FROM wishlist
    			WHERE userID = $userid AND movieID = $id 
				");
			if ($rows->rowCount()>0) {
				print 'already';
			}
			else{
				$db->query("INSERT INTO wishlist
				VALUES ($userid, $id)");
				print "done";
			}
		}
		else{
			
			$id = $db->quote($id);
			$userid = $db->quote($userid);
			
			$rows = $db->query("
				DELETE FROM wishlist
    			WHERE userID = $userid AND movieID = $id ");
				print 'done';
		}
	}
}

?>
