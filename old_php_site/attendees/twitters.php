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
		$attendee['fname'] = $first_name;
		$attendee['lname'] = $last_name;
		$attendee['topic'] = $topic;
		$attendee['twitter'] = $twitter;
		
		$attendees[] = $attendee;
    }
	
	$stmt->close();
	$mysqli->close();
	
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>BarCamp Rochester | Attendees</title>
	<link rel="shortcut icon" href="../favicon.png" />
	<link rel="stylesheet" href="../style.css" type="text/css">

	<script type="text/javascript" src="../jquery-1.5.1.min.js"></script>
	<script type="text/javascript">

	</script>	
</head>
<body>
	<div id="logoHeading">
		<div id="logo">
			<a href="../"><img src="../images/barcamp_logo_2.png" /></a>
		</div>
	</div>
	<div id="navigationBanner">
		<?php require('../nav.php'); ?>
	</div>
	<div id="content">
		<h1>Attendee List</h1>
		<p>
		If you needed to make sure the cool people were coming to BarCamp Rochester before signing up, here you can see the current attendee list. If you are on this list, but need to update your information, check out the <a href="../edit">edit your information page</a>.</p>
		
		<h2>BarCamp Rochester Fall 2011</h2>
		<!--
Last stop was @RalphBean, and 37 names

@devmorgan
@hiteak
@chorn
@DanielMcOrmond
@daniellenelson
@nathos
@terranb
@clockfort
@davidbrenner
@ssavo
@braindouche
@adamlindsay
@astebbin
@KosherFatty
@warthurton
@jwhitmire
@RedWolves
@flytepark
@jkkramer
@derekjadams
@jewinemiller
@omichaelhart
@ericdavidlee
@kkondo
@rubiety
@mjkruk
@davidnoob
@rufo
@seanmcgary
@amg6763
@toddjclausen
@billyudi
@antitree
@dwaiter
@b1tb1n
@remy_d
@ralphbean
		-->
		<?php
		if ($attendees != null && is_array($attendees)) {
			foreach($attendees as $attend) {
				if($attend['twitter'] != '') {
					echo('<div class="attendee_twitter"><a href="http://twitter.com/'.str_replace ('@', '', $attend['twitter']).'">@'. str_replace ('@', '', $attend['twitter']) . '</a></div>');
				}
			}
		}
		?>
	</div>
</body>
</html>