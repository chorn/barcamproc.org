<?php
	function trimIfNeeded($var, $len) {
		if (strlen($var)>$len) {
			$var = substr($var, 0, $len);
		}
		return trim(strip_tags($var));
	}
	
	if (isset($_REQUEST['email']) && $_REQUEST['email'] != '') {

		$emailin = trimIfNeeded($_REQUEST['email'], 255);
		$passin = sha1($_REQUEST['pass']);
		
		$location = '/home/bcr/bcr.sqlite3.db';
		$handle = new SQLite3($location); 

						
		$stmt = $handle->prepare("SELECT id, pass_hash, email, first_name, last_name, topic, shirt_size, twitter, reg_method, event, visible FROM barcamp_users WHERE email=:email AND pass_hash=:pass AND event='Spring 2013'");
		
		$stmt->bindParam(':email', $emailin, SQLITE3_TEXT);
		$stmt->bindParam(':pass', $passin, SQLITE3_TEXT);

		$result = $stmt->execute();

		if($res = $result->fetchArray()){
			$attendee['id'] = $res['id'];
			$attendee['email'] = $res['email'];
			$attendee['passhash'] = $res['pass_hash'];
			$attendee['fname'] = $res['first_name'];
			$attendee['lname'] = $res['last_name'];
			$attendee['topic'] = $res['topic'];
			$attendee['shirtSize'] = $res['shirt_size'];
			$attendee['twitter'] = $res['twitter'];
		}
		//echo($handle->lastErrorCode());
		//var_dump($attendee);
		//var_dump($res);
		
		$stmt->close();
		$handle->close();
		
	}

	if (isset($attendee) && $attendee != null) {
?>
		<form id="updateForm" action="update_reg.php" method="POST">
			<input type="hidden" name="email" value="<?php echo($attendee['email']); ?>"/>
			<input type="hidden" name="passhash" value="<?php echo($attendee['passhash']); ?>"/>
			<input type="hidden" name="id" value="<?php echo($attendee['id']); ?>"/>
			
			<label for="topic">Topic:</label><input id="topic" name="topic" type="text" value="<?php echo($attendee['topic']); ?>" />
			<p>If you know what you want to talk about, put the topic here, if not, leave it blank. You can change this later. This 
			will show up in the registered attendees list.</p>
			<label for="shirt">Shirt Size:</label><select id="shirt" name="shirt">
				<option <?php if($attendee['shirtSize'] == 'S') { echo(' selected="selected" '); } ?>>S</option>
				<option <?php if($attendee['shirtSize'] == 'M') { echo(' selected="selected" '); } ?>>M</option>
				<option <?php if($attendee['shirtSize'] == 'L') { echo(' selected="selected" '); } ?>>L</option>
				<option <?php if($attendee['shirtSize'] == 'XL') { echo(' selected="selected" '); } ?>>XL</option>
				<option <?php if($attendee['shirtSize'] == 'XXL') { echo(' selected="selected" '); } ?>>XXL</option>
			</select> [<a id="sizingChart" href="#">sizing chart</a>]
			<p>So you can fit in to your free shirt, rather than walk around naked.</p>
			<label for="twitter">Twitter:</label><input id="twitter" name="twitter" type="text" value="<?php echo($attendee['twitter']); ?>" />
			<p>If you tweet, put your username here - it will show up in the registered attendees list.</p>
			<input type="submit" value="Update My Info" />
		</form>
<?php

	} else {
		
		if(isset($_REQUEST['email']) && $_REQUEST['email'] != '') {
			echo('<div class="errtext">Your username and/or password are invalid. </div>');
		}
?>
		<form id="loginForm" action="#" method="POST">
			<label for="email">E-Mail:</label><input id="email" name="email" type="text" /><p></p>
			<label for="password">Password:</label><input id="password" name="password" type="password" /><p></p>
			<input type="submit" value="Log In" />
		</form>
<?php
	}
?>