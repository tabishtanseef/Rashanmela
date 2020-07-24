<?php
include("admin/includes/db.php");
session_start();

if(!isset($_SESSION['user_id'])) {
	header("Location: login.php");
}
$get_products ="select * from cart where user_id='$user_id'";
$run_products = mysqli_query($conn, $get_products);
$count = mysqli_num_rows($run_products);
if($count==0){
	header("Location: index.php");
}
if(isset($_POST['update'])) {
$user_id = $_SESSION['user_id'];
$get_products ="select * from cart where user_id='$user_id'";
$run_products = mysqli_query($conn, $get_products);
$count = mysqli_num_rows($run_products);
for($i=1; $i<=$count; $i++){
	$p_id = $_POST['hidden_pid'.$i];
	$p_quantity = $_POST['quantity'.$i];
	$p_price = $_POST['hidden_price'.$i];
	$new_sp = $p_quantity * $p_price;
	if($p_quantity==0){
		if(mysqli_query($conn, "Delete from cart where p_id='$p_id' and user_id='$user_id'")) {
			
		}
		else{
		}
	}
	else{
		if(mysqli_query($conn, "Update cart SET u_quantity= p_quantity * '". $p_quantity ."', quantity_unit= '". $p_quantity ."', u_sp= '". $new_sp ."' where p_id='$p_id' and user_id='$user_id'")) {
			
		}
		else{
		}
	}
}
header("Location: checkout.php");
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
.delivery{
	border:2px solid #F89126;
	padding:30px;
	
}
input[type=text]{
	width:120px;
	height:30px;
}
@media only screen and (max-width: 600px) {
  .w3l_offers {
    display:none;
  }
}
</style>
<!-- start-smoth-scrolling -->
</head>
	
<body>
<?php include('header.php')?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Checkout Page</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- checkout -->
	<div class="checkout">
		<div class="container">
			<h2>Your shopping cart contains: <span><?php echo $count;?> Products</span></h2>
			<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>S.No.</th>	
							<th>Product</th>
							<th>Quantity</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Delete</th>
						</tr>
					</thead>
					<form action="checkout.php" method="post">
					<?php 
						$user_id = $_SESSION['user_id'];
						$get_products ="select * from cart where user_id='$user_id'";
						$run_products = mysqli_query($conn, $get_products);
						$n=1;
						$total_price=0;
						
						while($row_products=mysqli_fetch_array($run_products))
						{
							$id = $row_products['id'];
							$p_id = $row_products['p_id'];
							$p_name = $row_products['p_name'];
							$p_mrp = $row_products['p_mrp'];
							$p_sp = $row_products['p_sp'];
							$u_sp = $row_products['u_sp'];
							$p_image = $row_products['p_image'];
							$p_quantity = $row_products['p_quantity'];
							$quantity_unit = $row_products['quantity_unit'];
							$u_quantity = $row_products['u_quantity'];
							$measuring_unit = $row_products['measuring_unit'];
							
					?>
					<tr id="item<?php echo $id;?>">
						<td class="invert"><?php echo $n;?></td>
						<td class="invert-image"><a href="single.php?pid=<?php echo $id;?>"><img src="admin/product_images/<?php echo $p_image;?>" alt="<?php echo $p_name;?>" class="img-responsive" /></a></td>
						<td class="invert">
						<div class="quantity">
							<?php echo $p_quantity;?> <?php echo $measuring_unit;?> x <input type="text" style="width:30px;"  value="<?php echo $quantity_unit;?>" name="quantity<?php echo $n;?>"> = <?php echo $u_quantity." ".$measuring_unit;?>
							<input type="hidden" value="<?php echo $p_id;?>" name="hidden_pid<?php echo $n;?>">
							<input type="hidden" value="<?php echo $p_sp;?>" name="hidden_price<?php echo $n;?>">
						</div>
						</td>
						<td class="invert"><?php echo $p_name;?></td>
						<td class="invert">&#8377;<?php echo $p_sp;?> x <?php echo $quantity_unit;?> = &#8377;<?php echo $u_sp;?></td>
						
						<td class="invert">
							<img src='images/del.png' onclick='delete_item(<?php echo $id;?>)' style='width:28px; margin:auto;'>
						</td>
					</tr>
					<?php
						$n++;
						$total_price = $total_price + $u_sp;
						}
						
					?>
					<tr>
					<td colspan="6" class="invert">
						<input type="submit" class="btn btn-warning" value="Update Cart"  name="update">
					</td>
					</tr>
					</form>
				</table>
				<br>
				<div class="delivery">
				<h3 style="color:red;">Delivery Address</h3>
				<br>
				<form method="post"  action="placeorder.php" >
				
				<h2>Name - <input type="text" name="name" value="<?php echo $_SESSION['user_name'];?>"></h2>
				<h2>Contact No. - <input type="text" name="num" value="<?php echo $_SESSION['user_num'];?>"></h2>
				<h2>Total Items - <input type="text" readonly name="items" value="<?php echo $n-1;?>"></h2>
				<h2>Total Amount - <input type="text" readonly name="price" value=" <?php echo "&#8377;". $total_price;?>"></h2>
				<h2>Address - <textarea rows="5" col="50" name="address" ><?php echo $_SESSION['user_address'];?></textarea></h2>
				<h2>Payment Mode - CASH ON DELIVERY</h2>
				<input type="submit" class="btn btn-primary" name="confirm" value='Confirm Your Order'></button>
				<br>
				<span style="font-size:12px;">Same Day Delivery - If Order is placed between 6 AM to 6 PM<br>
				Next Day Delivery - If Order is placed between 6 PM to 6 AM<span>
				</div>
			</div>
			<div class="checkout-left">
				<div class="checkout-right-basket">
					<a href="index.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //checkout -->
<!-- //footer -->
<?php include('footer.php'); ?>
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
		
function delete_item(delete_id){
	$("#item"+delete_id).addClass('hidden');
	$.ajax({
	url: 'delete_item.php',
	type: 'GET',
	data: {'del_id':delete_id},
	dataType: 'json',
	success:function(response){
	
	}
	
});
	
}
$(document).ajaxStop(function(){
    window.location.reload();
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