<?php


session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$checking = true;
	$email = $_POST['email'];
	$name = $_POST['name'];
	$password = $_POST['password'];
	
	if(empty($name) || empty($email) || empty($password)){
		print 'nodata';
	}
	else{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			print 'email';
			die;
		}
		$name = htmlspecialchars($name);
		$db = new PDO("mysql:dbname=tweb; host=localhost", "root", "");
		$email = $db->quote($email);
		$name = $db->quote($name);
		$password = $db->quote($password);

		$rows = $db->query("
			SELECT *
			FROM users
    		WHERE email = $email
			");
		if ($rows->rowCount()>0) {
			print 'invalid';
		}
		else{
			$db->query("INSERT INTO users
			VALUES (NULL ,$name, $email, $password)");
			print "valid";
		}
	}
}

?>
