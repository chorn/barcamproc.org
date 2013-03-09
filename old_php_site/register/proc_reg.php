<?php
	require_once('recaptchalib.php'); 
	$publickey = "6LcZEs4SAAAAAEu3wKWxuN2NdAnPRMinT74UAoLz";
	$privatekey = "6LcZEs4SAAAAANYd_17BGcn7yYw1k5wz181uuUGS";

	$resp = recaptcha_check_answer ($privatekey,
									$_SERVER["REMOTE_ADDR"],
									$_POST["recaptcha_challenge_field"],
									$_POST["recaptcha_response_field"]);


	if ($resp->is_valid) {
		
		$email = strtolower (trimIfNeeded($_POST['email'], 255));
		$pass = sha1($_POST['pass']);
		$fname = trimIfNeeded($_POST['fname'], 255);
		$lname = trimIfNeeded($_POST['lname'], 255);
		$topic = trimIfNeeded($_POST['topic'], 400);
		$shirt = trimIfNeeded($_POST['shirt'], 20);
		$twitter = trimIfNeeded($_POST['twitter'], 50);
		$reg = 'normal';
		//$event = 'Fall 2012';
		$event = 'Spam';
		$visible = '1';
		//$id = 1000;
		
		$location = '/home/bcr/bcr.sqlite3.db';
		$handle = new SQLite3($location); 

		if ($email != '') {
							
			$stmt = $handle->prepare("INSERT INTO barcamp_users(email, pass_hash, first_name, last_name, topic, shirt_size, twitter, reg_method, event, visible) 
							VALUES (:email,:pass,:fname,:lname,:topic,:shirt,:twitter,:reg,:event,:visible)");
			
		
			$stmt->bindParam(':email', $email, SQLITE3_TEXT);
			$stmt->bindParam(':pass', $pass, SQLITE3_TEXT);
			$stmt->bindParam(':fname', $fname, SQLITE3_TEXT);
			$stmt->bindParam(':lname', $lname, SQLITE3_TEXT);
			$stmt->bindParam(':topic', $topic, SQLITE3_TEXT);
			$stmt->bindParam(':shirt', $shirt, SQLITE3_TEXT);
			$stmt->bindParam(':twitter', $twitter, SQLITE3_TEXT);
			$stmt->bindParam(':reg', $reg, SQLITE3_TEXT);
			$stmt->bindParam(':event', $event, SQLITE3_TEXT);
			$stmt->bindParam(':visible', $visible, SQLITE3_TEXT);

			
			$result = $stmt->execute();
			
		} 
	
		//echo($handle->lastErrorMsg());
				
		$stmt->close();
		$handle->close();
		
		header('Location: thanks');
		
		//var_dump($_POST);
	} else {
		header('Location: ./?areyouahuman=unsure&email='.$_POST['email'].'&fname='.$_POST['fname'].'&lname='.$_POST['lname'].'&topic='.$_POST['topic'].'&twitter='.$_POST['twitter'].'&shirt='.$_POST['shirt'].'');
	}
	
	
	function trimIfNeeded($var, $len) {
		if (strlen($var)>$len) {
			$var = substr($var, 0, $len);
		}
		return strip_tags($var);
	}
?>