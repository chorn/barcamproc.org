<?php	
	//$mysqli = new mysqli('localhost', 'barcamp', 'summertimerave', 'barcamp_v2');
	//$mysqli = new mysqli('sql.devmorgan.com', 'devmorgan_sb', 'sandbox', 'devmorgan_sandbox');
	$mysqli = new mysqli('localhost', 'bcr', 'TymEnoak', 'bcr');
	
	$stmt = $mysqli->stmt_init();
	
	$stmt->prepare("SELECT count(1) count FROM barcamp_users WHERE visible = 1 AND event = 'Spring 2012'");
	
	$stmt->execute();
    $stmt->bind_result($cnt);

    while ($stmt->fetch()) {
		$count = $cnt;
    }
	
	$stmt->close();
	$mysqli->close();
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
//foreach($shirts as $s) {
//	echo($s['shirt_size'] . ' -> ' . $s['count'] . "<br />\r\n");
//}
echo($count);