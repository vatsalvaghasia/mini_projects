<!DOCTYPE html>
<html>
<head>
	<title>Admin Portal</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		alert("Enter this Credentials:\nUsername: admin\nPassword:admin");
			$(document).ready(function(){
				$("#contact-form").hide();
				$("#contact").click(function(){
					$("#login-form").hide();
					$("#contact-form").show();
				});
			});
	</script>
</head>
<body>

<div id = "navbar">
		<div id="navbar-parts">
		<a href = 'blog.php' id='home' name='home' >Home</a>
		<a href= '#' id='contact' name='contact'>Contact Me</a>	
		</div>	
</div>


<div id="container">
<div  id="log-box">
	<form id = "login-form" method="POST" action="val_cred.php">
		<h2>Admin Login</h2>
		<input type="text" name="username" autofocus="1" placeholder="Enter Admin Username" autocomplete = 'off' required><br>
		<input type="password" name="password" placeholder="Enter Admin Password" required><br>
		<input type="submit" id="btn" value="LOGIN">
	</form>
	<form id="contact-form" method="POST" action="message.php">
		<h2>Contact Details</h2>
		<input type="text" name="name" autofocus="1" placeholder="Enter Your Name" required>
		<input type="email" name="email" placeholder="Enter Your Email" required>
		<textarea name="message" placeholder= "Enter Your Message" row="4" required></textarea>
		<input type="submit" id = "btn1"name="send" value="Send Message">
	</form>
</div>
</div>	
</body>
<footer>
	<div id="social-box">
		<a target='_blank' href="https://linkedin.com" class="fa fa-linkedin"></a>
		<a target='_blank' href="https://wa.me/8291455084" class="fa fa-whatsapp"></a>
		<a target='_blank' href="https://twitter.com/VatsalVaghasia" class="fa fa-twitter"></a>
	</div>
	<p id="foot-p">&copy 2021 Vimlu</p>
</footer>
</html>