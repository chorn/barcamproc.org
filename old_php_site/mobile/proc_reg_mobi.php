<?php
	$mysqli = new mysqli('sql.devmorgan.com', 'devmorgan_sb', 'sandbox', 'devmorgan_sandbox');

	$email = trimIfNeeded($_POST['email'], 255);
	$pass = sha1($_POST['pass']);
	$fname = trimIfNeeded($_POST['fname'], 255);
	$lname = trimIfNeeded($_POST['lname'], 255);
	$topic = '';
	$shirt = trimIfNeeded($_POST['shirt'], 20);
	$twitter = trimIfNeeded($_POST['twitter'], 50);
	$reg = 'mobile';
	$event = 'Spam';
	
	
	
	$stmt = $mysqli->stmt_init();
	$stmt->prepare("INSERT INTO barcamp_users(email, pass_hash, first_name, last_name, topic, shirt_size, twitter, reg_method, event) 
					VALUES (?,?,?,?,?,?,?,?,?);");
	
	$stmt->bind_param("sssssssss", $email, $pass, $fname, $lname, $topic, $shirt, $twitter, $reg, $event);
	$stmt->execute();

	$stmt->close();
	$mysqli->close();
	
	//var_dump($_POST);
	function trimIfNeeded($var, $len) {
		if (strlen($var)>$len) {
			$var = substr($var, 0, $len);
		}
		return $var;
	}
?>