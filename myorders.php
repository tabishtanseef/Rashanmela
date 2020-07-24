<?php
include("admin/includes/db.php");
session_start();

if(!isset($_SESSION['user_id'])) {
	header("Location: login.php");
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
				<li class="active">My Orders Page</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- checkout -->
	<div class="checkout">
		<div class="container">
			<h4>Your Orders In Progress:</h4>
			<br>
			<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>Product Id</th>	
							<th>Product</th>
							<th>Quantity</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Order Date</th>
							<th>Order Status</th>
						</tr>
					</thead>
					<?php 
						$user_id = $_SESSION['user_id'];
						
						$get_products ="select order_id from orders where user_id='$user_id' and is_completed='0' order by id DESC";
						$run_products = mysqli_query($conn, $get_products);
						
						$order_list = array();
						while($row_products=mysqli_fetch_array($run_products))
						{
							$order_id = $row_products['order_id'];
							array_push($order_list,$order_id);
						}	
							$order_list = array_unique($order_list);
							$order_ids = array_values($order_list);
							$new = count($order_ids);
							$shah = 0;
						
						while($shah<$new)
						{
							$order_id = $row_products['order_id'];
							$total_price = 0;
							$get_pro ="select * from orders where user_id='$user_id' and order_id='$order_ids[$shah]'";
							$run_pro = mysqli_query($conn, $get_pro);
							while($row_pro=mysqli_fetch_array($run_pro))
							{
								$id = $row_pro['id'];
								$p_id = $row_pro['p_id'];
								$p_name = $row_pro['p_name'];
								$p_sp = $row_pro['price'];
								$p_image = $row_pro['image'];
								$p_quantity = $row_pro['quantity'];
								$date = $row_pro['date'];
								$is_comp = $row_pro['is_completed'];
								if($is_comp==0){
								?>
								<tr id="item<?php echo $id;?>">
									<td class="invert">#<?php echo $p_id;?></td>
									<td class="invert-image"><a href="#"><img src="admin/product_images/<?php echo $p_image;?>" alt="<?php echo $p_name;?>" class="img-responsive" /></a></td>
									<td class="invert"><?php echo $p_quantity;?></td>
									<td class="invert"><?php echo $p_name;?></td>
									<td class="invert">&#8377;<?php echo $p_sp;?></td>
									<td class="invert"><?php echo $date;?></td>
									<td class="invert"><img src="admin/img/d.png" style="width:75px;"></td>
								</tr>
								
								
								<?php
								$total_price = $total_price + $p_sp;
								}
								else{
									
								}
								
								
							}
							
								
								?>	
								<tr>
									<td colspan="7" class="invert"><h4>Your Order Id is - <span style="color:green;">#<?php echo $order_ids[$shah];?></span>  and total payable amount is <span style="color:green;">&#8377;<?php echo $total_price;?></span></h4></td>
								</tr>
								<tr>
									<td colspan="7"  style="background:#F89126;"></td>
								</tr>
								<tr>
									<td colspan="7" style="background:#F89126;"></td>
								</tr>
								<?php
							$shah++;
						}
					?>
				</table>
				<br>
			</div>
			<br>
			<h4>Your Completed Orders: </h4>
			<br>
			<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>Product Id</th>	
							<th>Product</th>
							<th>Quantity</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Order Date</th>
							<th>Order Status</th>
						</tr>
					</thead>
					<?php 
						$user_id = $_SESSION['user_id'];
						
						$get_products ="select order_id from orders where user_id='$user_id' and is_completed='1' order by id DESC";
						$run_products = mysqli_query($conn, $get_products);
						
						$orderr = array();
						while($row_products=mysqli_fetch_array($run_products))
						{
							$order_id = $row_products['order_id'];
							array_push($orderr,$order_id);
						}	
							$orderr = array_unique($orderr);
							$orderr_ids = array_values($orderr);
							$new1 = count($orderr_ids);
							$shah1 = 0;
						
						while($shah1<$new1)
						{
							$order_id = $row_products['order_id'];
							$total_price = 0;
							$get_pro ="select * from orders where user_id='$user_id' and order_id='$orderr_ids[$shah1]'";
							$run_pro = mysqli_query($conn, $get_pro);
							while($row_pro=mysqli_fetch_array($run_pro))
							{
								$id = $row_pro['id'];
								$p_id = $row_pro['p_id'];
								$p_name = $row_pro['p_name'];
								$p_sp = $row_pro['price'];
								$p_image = $row_pro['image'];
								$p_quantity = $row_pro['quantity'];
								$date = $row_pro['d_date'];
								$is_comp = $row_pro['is_completed'];
								if($is_comp==1){
								?>
								<tr id="item<?php echo $id;?>">
									<td class="invert">#<?php echo $p_id;?></td>
									<td class="invert-image"><a href="#"><img src="admin/product_images/<?php echo $p_image;?>" alt="<?php echo $p_name;?>" class="img-responsive" /></a></td>
									<td class="invert"><?php echo $p_quantity;?></td>
									<td class="invert"><?php echo $p_name;?></td>
									<td class="invert">&#8377;<?php echo $p_sp;?></td>
									<td class="invert"><?php echo $date;?></td>
									<td class="invert"><img src="admin/img/deli.png" style="width:75px;"></td>
								</tr>
								<?php 
								$total_price = $total_price + $p_sp;
								}
								else{
									
								}
								
							}
							
								
								?>	
								<tr>
									<td colspan="7" class="invert"><h4>Your Order Id is - <span style="color:green;">#<?php echo $orderr_ids[$shah1];?></span>  and total paid amount was <span style="color:green;">&#8377;<?php echo $total_price;?></span></h4></td>
								</tr>
								<tr>
									<td colspan="7"  style="background:#F89126;"></td>
								</tr>
								<tr>
									<td colspan="7" style="background:#F89126;"></td>
								</tr>
								<?php
							$shah1++;
						}
					?>
				</table>
				<br>
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