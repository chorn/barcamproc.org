<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	
	<title>BarCamp Rochester | Edit My Information</title>
	<link rel="shortcut icon" href="../favicon.png" />
	<link rel="stylesheet" href="../style.css" type="text/css">
	
	<script type="text/javascript" src="../jquery-1.5.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			rebindSubmit();
		});
		function rebindSubmit() {
			$('#loginForm').submit(function() {
				$('#registerForm').load( 'authandget.php', { 
					email: $('#email').val(),
					pass: $('#password').val()
				}, function() {
					if ($('#loginForm')) {
						rebindSubmit();
					}
					
					if($('#updateForm')) {
						bindUpdateSubmit();
					}
				});
				return false;
			});
		}
		
		function bindUpdateSubmit() {
			$('#sizingChart').click(function() {
				window.open('http://americanapparel.net/sizing/default.asp?chart=mu.shirts', 'sizingShirts', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=565,height=575');
			});			
		}
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
		<h1>Edit Your Information</h1>
		<p>
			You can update some of your information by filling out this form
		</p>
		<div id="registerForm">
			<?php include('authandget.php'); ?>
		</div>
	</div>
</body>
</html>