<?php


	$id = $_POST['id'];
	$email = strtolower (trimIfNeeded($_POST['email'], 255));
	$passhash = $_POST['passhash'];
	//$fname = trimIfNeeded($_POST['fname'], 255);
	//$lname = trimIfNeeded($_POST['lname'], 255);
	$topic = trimIfNeeded($_POST['topic'], 400);
	$shirt = trimIfNeeded($_POST['shirt'], 20);
	$twitter = trimIfNeeded($_POST['twitter'], 50);
	//$reg = 'normal';
	//$event = 'Fall 2011';
	//$visible = '1';
	
	
	if ($email != '') {
		/*$stmt = $mysqli->stmt_init();
		$stmt->prepare("UPDATE barcamp_users SET topic = ?, shirt_size = ?, twitter = ? WHERE email = ? AND pass_hash = ? AND id = ?;");
		$stmt->bind_param("ssssss", $topic, $shirt, $twitter, $email, $passhash, $id);
		$stmt->execute();

		$stmt->close();
		$mysqli->close();*/
		
		$location = '/home/bcr/bcr.sqlite3.db';
		$handle = new SQLite3($location); 

						
		$stmt = $handle->prepare("UPDATE barcamp_users SET topic = ?, shirt_size = ?, twitter = ? WHERE email = ? AND pass_hash = ? AND id = ?");
		
		$stmt->bindParam(1, $topic, SQLITE3_TEXT);
		$stmt->bindParam(2, $shirt, SQLITE3_TEXT);
		$stmt->bindParam(3, $twitter, SQLITE3_TEXT);
		$stmt->bindParam(4, $email, SQLITE3_TEXT);
		$stmt->bindParam(5, $passhash, SQLITE3_TEXT);
		$stmt->bindParam(6, $id, SQLITE3_TEXT);

		$result = $stmt->execute();
		$stmt->close();
		$handle->close();
		
	}
	
	header('Location: complete');
	//var_dump($_POST);
	
	function trimIfNeeded($var, $len) {
		if (strlen($var)>$len) {
			$var = substr($var, 0, $len);
		}
		return strip_tags($var);
	}
?>