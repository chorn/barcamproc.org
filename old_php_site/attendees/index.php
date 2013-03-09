<?php	

	$location = '/home/bcr/bcr.sqlite3.db';
	$handle = new SQLite3($location); 
	
	
	$stmt = $handle->prepare("SELECT id, email, first_name, last_name, topic, shirt_size, twitter, reg_method, event, visible FROM barcamp_users WHERE visible = 1 AND event = 'Spring 2013' ORDER BY id ASC");
	
	$result = $stmt->execute();


    while($res = $result->fetchArray()){
		
		$attendee['id'] = $res['id'];
		$attendee['fname'] = $res['first_name'];
		$attendee['lname'] = $res['last_name'];
		$attendee['topic'] = $res['topic'];
		$attendee['twitter'] = $res['twitter'];
		
		$attendees[] = $attendee;
    }
	
	$stmt->close();
	$handle->close();

	
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>BarCamp Rochester | Attendees</title>
	<link rel="shortcut icon" href="../favicon.png" />
	<link rel="stylesheet" href="../style.css" type="text/css">
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31935733-1']);
  _gaq.push(['_setDomainName', 'barcamproc.org']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
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
		If you needed to make sure the cool people were coming to BarCamp Rochester before signing up, here you can see the current attendee list. If you are on this list, but need to update your information, check out the <a href="../edit">edit your information page</a>.To know what all the attendees will go through, you can visit our <a href="../howto">How-To: BarCamp Rochester</a> page!</p> 
		
		<h2>BarCamp Rochester Spring 2013</h2>
		<?php
		if (isset($attendees) && $attendees != null && is_array($attendees)) {
			foreach($attendees as $attend) {
				echo('<div class="attendee">');
				
				if ($attend['topic'] != "") {
					echo('<div class="attendee_topic">'. $attend['topic'] . '</div>');
				} else {
					echo('<div class="attendee_topic notyet">No Topic Yet</div>');
				}
				
				if (strlen($attend['lname']) > 0) {
					echo('<div class="attendee_name">'. $attend['fname'] . ' ' . substr($attend['lname'], 0, 1) . '.</div>');
				} else {
					echo('<div class="attendee_name">'. $attend['fname'] . '</div>');
				}
				
				if( $attend['twitter'] != '' ) {
					echo('<div class="attendee_twitter"><a href="http://twitter.com/'.str_replace ('@', '', $attend['twitter']).'">@'. str_replace ('@', '', $attend['twitter']) . '</a></div>');
				}
				
				
							

							
				echo('<div style="clear: both;"></div>');
				echo('</div>');
			}
		} else {
			echo('<p>Registration has not yet opened.</p>');
		}
		?>
	</div>
</body>
</html>