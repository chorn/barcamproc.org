<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name = "viewport" content = "width = device-width">

	<title>BarCamp Rochester | Register</title>
	<link rel="shortcut icon" href="../favicon.png" />

	<link rel="stylesheet" href="../mobile.css" type="text/css">
	
	<script type="text/javascript" src="../jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="../jquery.validate.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {


			
			$('#regForm').validate({
				rules: {
					fname: "required",
					lname: "required",
					email: {
						required: true,
						minlength: 2,
						email: true
					},
					pass: {
						required: true,
						minlength: 2
					}
				},
				highlight: function(element, errorClass) {
						$(element).before().addClass('err');
				  },
				  unhighlight: function(element, errorClass, validClass) {
					 $(element).before().removeClass('err');
				  },
				  errorPlacement: function(error, element) {

				  }
			});
			
		});
	</script>	
</head>
<body>
	<div id="logoHeading">
		<div id="logo">
			<a href="../"><img src="../images/barcamp_rochester_icon_150x150_trans.png" /></a>
		</div>
	</div>
	<div id="navigationBanner">
		&nbsp;
	</div>
	<div id="content">
		<p>
			Ready to register for BarCamp Rochester, Fall 2011? Fill out this form, and you'll be signed 
			up! 
		</p>
		<div id="registerForm">
		<form id="regForm" action="proc_reg.php" method="POST">
			<label id="l" for="email">E-Mail:</label><input id="email" name="email"  type="text" />			
			<label for="pass">Password:</label><input id="pass" name="pass" type="password"  />			
			<label for="fname">First Name:</label><input id="fname" name="fname" type="text" />
			<label for="lname">Last Name:</label><input id="lname" name="lname" type="text" />
			<label for="topic">Topic:</label><input id="topic" name="topic" type="text" />
			
			<label for="shirt">Shirt Size:</label>
			<div id="specialShirtNote">Our t-shirt order has been placed. We may have a few extras, but we can't be sure! Check with us at the event, and we'll give you one if we have enough.</div>
			<select id="shirt" name="shirt">
				<option>S</option>
				<option>M</option>
				<option selected="selected">L</option>
				<option>XL</option>
				<option>XXL</option>
			</select>
			<label for="twitter">Twitter:</label><input id="twitter" name="twitter" type="text" />
			<input type="submit" value="Register me!" />
		</form>
		</div>
	</div>
</body>
</html>