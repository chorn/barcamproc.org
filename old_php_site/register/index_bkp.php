<?php 
require_once('recaptchalib.php'); 
$publickey = "6LcZEs4SAAAAAEu3wKWxuN2NdAnPRMinT74UAoLz"; // you got this from the signup page
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	
	<title>BarCamp Rochester | Register</title>
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
	<script type="text/javascript" src="../jquery.validate.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		
			$('#sizingChart').click(function() {
			window.open('http://americanapparel.net/sizing/default.asp?chart=mu.shirts', 'sizingShirts', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=565,height=575');
			});

			
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
			<a href="../"><img src="../images/barcamp_logo_2.png" /></a>
		</div>
	</div>
	<div id="navigationBanner">
		<?php require('../nav.php'); ?>
	</div>
	<div id="content">
		<h1>Register for BarCamp Rochester</h1>
		<p>

			Ready to register for <b>BarCamp Rochester, Fall 2012</b>? Fill 
			out the form and you'll be signed 
			up! Mark your calendar now for October 6th! Too cool to sign up until you see whos coming? Check out the <a href="../attendees">attendee list</a>.
			If you want to get a better idea of what happens at BarCamp, check out our <a href="../howto">How-To: BarCamp Rochester</a> page. Follow us on 
			twitter <a href="http://twitter.com/barcamproc" target="_new">@BarCampRoc</a>, and you can get the latest updates on the event.	
		</p>
		
		<h2>Registration for Fall 2012!</h2>
		<div id="registerForm">
		<form id="regForm" action="proc_reg.php" method="POST">
			<?php
				if (isset($_GET['areyouahuman'])) {
					echo('<div class="humanitycheck">Your humanity has not been confirmed.... please try again.</div>');
				}
			?>
			<label id="l" for="email">E-Mail:</label><input id="email" name="email"  type="text" />			
			<p>You can use this e-mail address to log in and change details about your talk or shirt size. We will send you 
			e-mail only pertaining to upcoming BarCamp Rochester events.</p>
			<label for="pass">Password:</label><input id="pass" name="pass"  type="password"  />			
			<p>Password used to log in to change your information. Minimum of 2 characters, maximum is 50, sure, lets go with 50... nevermind, whatever is fine.</p>
			<label for="fname">First Name:</label><input id="fname" name="fname" type="text" />
			<p>Your first name will show up in the registered attendees list. </p>
			<label for="lname">Last Name:</label><input id="lname" name="lname" type="text" />
			<p>Your last name will not show up in the 
			registered attendees list, but the first letter will (John S.). We still need it for when you check in for the event 
			though!</p>
			<label for="topic">Topic:</label><input id="topic" name="topic" type="text" />
			<p>If you know what you want to talk about, put the topic here, if not, leave it blank. You can change this later. This 
			will show up in the registered attendees list.</p>
			<!--<div id="specialShirtNote">Our t-shirt order has been placed. We may have a few extras, but we can't be sure! Check with us at the event, and we'll give you one if we have enough.</div>-->
			<label for="shirt">Shirt Size:</label><select id="shirt" name="shirt">
				<option>S</option>
				<option>M</option>
				<option selected="selected">L</option>
				<option>XL</option>
				<option>XXL</option>
			</select> [<a id="sizingChart" href="#">sizing chart</a>]
			<p>So you can fit in to your free shirt, rather than walk around naked.</p>
			<label for="twitter">Twitter:</label><input id="twitter" name="twitter" type="text" />
			<p>If you tweet, put your username here - it will show up in the registered attendees list.</p>
			<label>Human:</label><div id="myCaptcha">
				<?php echo recaptcha_get_html($publickey); ?>
			</div>
			<p>So we know you aren't a human hating robot.</p>
			<input type="submit" value="Register me!" />
			<div id="narr"></div>
		</form>
		</div>
	
	</div>
</body>
</html>
