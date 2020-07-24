<?php
include("admin/includes/db.php");
session_start();

if(!isset($_SESSION['user_id'])) {
header("Location: index.php");
}


if(isset($_POST['confirm'])){
	$user_id =  $_SESSION['user_id'];
	$user_name = $_POST['name'];
	$user_num = $_POST['num'];
	$user_address = $_POST['address'];
	$price = $_POST['price'];
	$date=date("Y-m-d");
	date_default_timezone_set("Asia/Calcutta");
	$time = date("h:i:s");  
	$timestamp = strtotime($date);
	$day = date('l', $timestamp);
	
	$order_id = rand(100000,999999);
	
	$get_products ="select * from cart where user_id='$user_id'";
	$run_products = mysqli_query($conn, $get_products);
	while($row_products=mysqli_fetch_array($run_products))
	{
		$id = $row_products['id'];
		$user_id = $row_products['user_id'];
		$cat_title = $row_products['cat_title'];
		$p_id = $row_products['p_id'];
		$p_name = $row_products['p_name'];
		$sp = $row_products['u_sp'];
		$p_image = $row_products['p_image'];
		$quantity = $row_products['u_quantity'];
		$measuring_unit = $row_products['measuring_unit'];
		$quantity = $quantity." ".$measuring_unit;		
		
		echo "<script>console.log($id)</script>";
		echo "<script>console.log($user_id)</script>";
		echo "<script>console.log('$cat_title');</script>";
		echo "<script>console.log($p_id)</script>";
		echo "<script>console.log('$p_name');</script>";
		echo "<script>console.log($sp)</script>";
		echo "<script>console.log('$quantity');</script>";
		echo "<script>console.log($order_id)</script>";
		echo "<script>console.log('$date');</script>";
		echo "<script>console.log('$day');</script>";
		echo "<script>console.log('$time');</script>";
		echo "<script>console.log('$p_image');</script>";
		
		$get_order = "insert into orders (order_id,date,time,day,user_id,p_id,p_name,cat_title,image,quantity,price,user_name,user_num,user_address,is_completed,d_date) 
		values ('$order_id','$date','$time','$day','$user_id','$p_id','$p_name','$cat_title','$p_image','$quantity','$sp','$user_name','$user_num','$user_address',0,0000-00-00)";
		
		$run_order = mysqli_query($conn, $get_order);
		if($run_order)
		{
			if(mysqli_query($conn, "Delete from cart where id='$id'")) {
				//echo "<script> alert('Order Placed Successfully'); </script>";
			}
			else{
				echo "<script> alert('Order Failed'); </script>";
			}
		}
		else{
			echo "<script> alert('Try Again'); </script>";
		}
	}
	$get_products ="select * from cart where user_id='$user_id'";
	$run_products = mysqli_query($conn, $get_products);
	$count = mysqli_num_rows($run_products);
	if($count==0){
		header("Refresh:3; url=myorders.php");
	}
	else{
		header("Location: checkout.php");
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Super Market an Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Checkout :: w3layouts</title>
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
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
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
img{
	width:50% ;
}
@media only screen and (orientation: portrait) {
	img{
		width:100%;
		margin-top:200px;
	}
}
</style>
</head>
	
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<center><img src="images/order.png" ></center>
</div>
</div>
</div>
</body>
</html>
