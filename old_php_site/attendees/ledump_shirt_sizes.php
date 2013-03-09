<?php	
	//$mysqli = new mysqli('localhost', 'barcamp', 'summertimerave', 'barcamp_v2');
	//$mysqli = new mysqli('sql.devmorgan.com', 'devmorgan_sb', 'sandbox', 'devmorgan_sandbox');

	
	
	$location = '/home/bcr/bcr.sqlite3.db';
	$handle = new SQLite3($location); 
	
	
	$stmt = $handle->prepare("SELECT count(shirt_size) c, shirt_size FROM barcamp_users WHERE visible = 1 AND event = 'Fall 2012' GROUP BY shirt_size");
	
	$result = $stmt->execute();


    while($res = $result->fetchArray()){

		
		$shirt['count'] = $res['c'];
		$shirt['shirt_size'] = $res['shirt_size'];
		$shirts[] = $shirt;
    }
	
	$stmt->close();
	$handle->close();
	/*
header('Expires: 0');
header('Cache-control: private');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.ms-excel');
header('Content-disposition: attachment; filename="bcr_dump.csv"');

echo('"internalid","email","first_name","last_name","topic","twitter","shirt_size","registration_method"'. "\r\n"); 
if ($attendees != null && is_array($attendees)) {
	foreach($attendees as $attend) {
		echo('"'.$attend['id'].'","'.$attend['email'].'","'.$attend['fname'].'","'.$attend['lname'].'","'.$attend['topic'].'","'.str_replace ('@', '', $attend['twitter']).'","'.$attend['shirt_size'].'","'.$attend['registration_method'].'"'."\r\n"); 
	}
}
*/
foreach($shirts as $s) {
	echo($s['shirt_size'] . ' -> ' . $s['count'] . "<br />\r\n");
}
//echo(json_encode($shirts));