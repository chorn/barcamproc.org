<?php	
	//$mysqli = new mysqli('localhost', 'barcamp', 'summertimerave', 'barcamp_v2');
	//$mysqli = new mysqli('sql.devmorgan.com', 'devmorgan_sb', 'sandbox', 'devmorgan_sandbox');
	$mysqli = new mysqli('localhost', 'bcr', 'TymEnoak', 'bcr');
	
	
	$stmt = $mysqli->stmt_init();
	
	$stmt->prepare("SELECT id, email, first_name, last_name, topic, shirt_size, twitter, reg_method, event, visible FROM barcamp_users WHERE visible = 1 AND event = 'Spring 2012' ORDER BY id ASC");
	
	$stmt->execute();
    $stmt->bind_result($id, $email, $first_name, $last_name, $topic, $shirt_size, $twitter, $reg_method, $event, $visible);

    while ($stmt->fetch()) {
		//echo($email . ' - ' . $first_name . "<br />");
		
		$attendee['id'] = $id;
		$attendee['email'] = $email;
		$attendee['fname'] = $first_name;
		$attendee['lname'] = $last_name;
		$attendee['topic'] = $topic;
		$attendee['shirt_size'] = $shirt_size;
		$attendee['registration_method'] = $reg_method;
		$attendee['twitter'] = $twitter;
		
		$attendees[] = $attendee;
    }
	
	$stmt->close();
	$mysqli->close();
	
	if ($attendees != null && is_array($attendees)) {
		foreach($attendees as $attend) {
			echo($attend['email'].' - '.$attend['fname'].' '.$attend['lname']. ' [' .$attend['registration_method'].']'."<br />\r\n"); 
		}
	}
