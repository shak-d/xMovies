<?php


session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$checking = true;
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	if(empty($email) || empty($password)){
		print 'nodata';
	}
	else{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			print 'email';
			die;
		}
	
		$db = new PDO("mysql:dbname=tweb; host=localhost", "root", "");
		$email = $db->quote($email);
		$password = $db->quote($password);


		$rows = $db->query("
    		SELECT *
    		FROM users
    		WHERE email = $email AND password = $password 
			");

		if ($rows->rowCount()>0) {
			foreach($rows as $row){
    			$_SESSION["name"] = $row["name"];
				$_SESSION["userid"] = $row["Userid"];
				$logged = true;
				print "valid";
			}
		}
		else{
			print "invalid";
			$logged = false;
		}
	}
}

?>
