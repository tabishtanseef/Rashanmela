<?php
include("admin/includes/db.php");
session_start();
if(isset($_SESSION['user_id'])) {
	header("Location: index.php");
}

if(isset($_POST['register']))
{
	//text data variables
	$name=mysqli_real_escape_string($conn, $_POST['name']);
	$email=mysqli_real_escape_string($conn, $_POST['email']);
    $num=mysqli_real_escape_string($conn, $_POST['num']);
    $password=mysqli_real_escape_string($conn, $_POST['password']);
	$address=mysqli_real_escape_string($conn, $_POST['address']);
	
	$g = "SELECT num FROM users WHERE num ='$num'";
	$r = mysqli_query($conn,$g);
	$ch = mysqli_fetch_array($r);
	if (strlen($ch['num']) != 0)
	{
	  $error_message = "This Email is already registered!";
	  echo "<script> alert('$error_message'); </script>";
	}	
	else{
	
	$insert_user = "insert into users (name,email,num,password,address)	values ('$name','$email','$num','$password','$address')";

	$run_user= mysqli_query($conn, $insert_user);

	if($run_user)
	{
		echo "<script> alert('Registered successfully'); </script>";
		header( "refresh:1;url=login.php" );
	}
	else{
		echo "<script> alert('$name'); </script>";
		echo "<script> alert('$email'); </script>";
		echo "<script> alert('$num'); </script>";
		echo "<script> alert('$password'); </script>";
		echo "<script> alert('$address'); </script>";
	}
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
<title>REGISTER - RASHANMELA</title>
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
<style>
.textarea {
  display: block;
  width: 100%;
  overflow: hidden;
  resize: both;
  min-height: 50px;
  line-height: 20px;
  outline: none;
}
</style>
<!-- start-smoth-scrolling -->
</head>
	
<body>
<?php include('header.php')?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Register Page</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Register Here</h2>
			<div class="login-form-grids">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<input type="text" name="name" placeholder="Full Name" required=" " >
					<input type="text" name="num" maxlength="10" placeholder="Contact No." required=" " >
					<input type="email" name="email" placeholder="Email Address"  >
					<input type="password" name="password" placeholder="Password" required=" " >
					<br>
					<textarea class="textarea resize-ta" name="address" placeholder="Complete Address"></textarea>
					
					<input type="submit" name="register" value="Register">
				</form>
			</div>
			<div class="register-home">
				<a href="index.php">Home</a>
			</div>
		</div>
	</div>
<!-- //register -->
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
			let textarea = document.querySelector(".resize-ta");
textarea.addEventListener("keyup", () => {
  textarea.style.height = calcHeight(textarea.value) + "px";
});
	</script>
<!-- //here ends scrolling icon -->
<script src="js/minicart.min.js"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>
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