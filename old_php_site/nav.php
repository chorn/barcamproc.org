<?php 
	$location = '/home/bcr/bcr.sqlite3.db';
	$handle = new SQLite3($location); 
	
	$stmt = $handle->prepare("SELECT count(1) FROM barcamp_users WHERE visible = 1 AND event = 'Spring 2013'");
	
	$result = $stmt->execute();
	
	$count = 0;
    if($res = $result->fetchArray()){
		
		$count = $res[0];
    }
	
	$stmt->close();
	$handle->close();
?>
<div id="navigation">
	<ul id="nav_links">
		<li><a href="/">Home</a></li>
		<li><a href="/register">Register</a></li>
		<li><a href="/attendees">Attendees<!--(<?php echo($count); ?>)--></a></li>
		<li><a href="/directions">Directions</a></li>
		<li><a href="/media">Media</a></li>
		<li><a href="/sponsor">Sponsor</a></li>
	</ul>
</div>