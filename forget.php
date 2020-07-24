<?php
include("admin/includes/db.php");
session_start();
if(isset($_SESSION['user_id'])) {
	header("Location: index.php");
}

if (isset($_POST['login'])) {
	$num = mysqli_real_escape_string($conn, $_POST['num']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$result = mysqli_query($conn, "SELECT * FROM users WHERE num = '" . $num. "' and password = '" . md5($password). "'");
	if ($row = mysqli_fetch_array($result)) {
		
		setcookie('user_id', $row['user_id'], time() + (86400 * 30), "/");
		setcookie('user_name', $row['name'], time() + (86400 * 30), "/");
		setcookie('user_num', $row['num'], time() + (86400 * 30), "/");
		setcookie('user_email', $row['email'], time() + (86400 * 30), "/");
		setcookie('user_address', $row['address'], time() + (86400 * 30), "/");
		
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['user_name'] = $row['name'];		
		$_SESSION['user_num'] = $row['num'];		
		$_SESSION['user_email'] = $row['email'];	
		$_SESSION['user_address'] = $row['address'];	
		
		header("Location: index.php");
	} 
	else {
		$error_message = "Incorrect Email or Password!!!";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>FORGET PASSWORD - RASHANMELA</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Super Market Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
	
<body>
<?php include('header.php')?>	
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Login Page</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- login -->
	<div class="login">
		<div class="container">
			<h2>Forget Password ?</h2><br>
			
			<div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
			<h6><center>Enter Your E-Mail and we will send you a mail.</center></h6>
			<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
				<form action="forget.php" method="post">
					<input type="email" name="email" placeholder="Email" required=" " >
					<input type="submit" name="forget" value="Submit">
				</form>
			</div>
			<h4>For New People</h4>
			<p><a href="registered.php">Register Here</a> or go back to <a href="index.php">Home<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
		</div>
	</div>
<!-- //login -->
<!-- //footer -->
<?php include('footer.php')?>
<!-- //footer -->	
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- top-header and slider -->
<!-- here stars scrolling icon -->
<script type="text/javascript">
	$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/
							
		$().UItoTop({ easingType: 'easeOutQuart' });
							
		});
</script>
<!-- //here ends scrolling icon -->

<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
						
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});
			
		});
</script>	
<!-- //main slider-banner --> 

</body>
</html>
<?php
if(isset($_POST['forget'])){
	$email = $_POST['email'];
    $result = mysqli_query($conn,"SELECT * FROM users where email='" . $_POST['email'] . "'");
    $row = mysqli_fetch_assoc($result);
	$fetch_user_id=$row['user_id'];
	$email=$row['email'];
	$password=$row['password'];
	$to = $email;
	$from = 'contact@rashanmela.com';
	$subject = "Rashanmela Password";
	$txt = "Your password is : $password.";
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= "From: " . $from . "\r\n"; // Sender's E-mail
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 
	$message ='<table style="width:100%">
		<tbody>
		<tr><td>Email: '.$email.'</td></tr> 
		
		<tr><td>Password: '.$password.'</td></tr>
	</tbody></table>';
	 
	if (@mail($to, $from, $message, $headers))
	{
		echo "<script>alert('The message has been sent.');</script>";
		header("Location: index.php");
	}else{
		echo 'failed';
	}
}
?>