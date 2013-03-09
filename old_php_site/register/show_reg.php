<?php
	$location = '/home/bcr/bcr.sqlite3.db';
	$handle = new SQLite3($location); 
	
	
	$stmt = $handle->prepare("SELECT id, email, first_name, last_name, topic, shirt_size, twitter, reg_method, event, visible FROM barcamp_users ORDER BY id ASC");
	
	$result = $stmt->execute();


    while($res = $result->fetchArray()){

		$attendee = $res;
		$attendees[] = $attendee;
    }
	
	var_dump($attendees);
	
	
	$stmt->close();
	$handle->close();
?>