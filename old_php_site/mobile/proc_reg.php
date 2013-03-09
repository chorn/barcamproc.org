<?php
	$mysqli = new mysqli('localhost', 'bcr', 'TymEnoak', 'bcr');
	
	$email = strtolower (trimIfNeeded($_POST['email'], 255));
	$pass = sha1($_POST['pass']);
	$fname = trimIfNeeded($_POST['fname'], 255);
	$lname = trimIfNeeded($_POST['lname'], 255);
	$topic = trimIfNeeded($_POST['topic'], 400);
	$shirt = trimIfNeeded($_POST['shirt'], 20);
	$twitter = trimIfNeeded($_POST['twitter'], 50);
	$reg = 'mobile';
	$event = 'Fall 2011';
	$visible = '1';
	
	
	if ($email != '') {
		$stmt = $mysqli->stmt_init();
		$stmt->prepare("INSERT INTO barcamp_users(email, pass_hash, first_name, last_name, topic, shirt_size, twitter, reg_method, event, visible) 
						VALUES (?,?,?,?,?,?,?,?,?,?)");
		
		$stmt->bind_param("ssssssssss", $email, $pass, $fname, $lname, $topic, $shirt, $twitter, $reg, $event, $visible);
		$stmt->execute();

		$stmt->close();
		$mysqli->close();
	}
	
	header('Location: thanks');
	//var_dump($_POST);
	
	function trimIfNeeded($var, $len) {
		if (strlen($var)>$len) {
			$var = substr($var, 0, $len);
		}
		return strip_tags($var);
	}
?>