<?php
include("admin/includes/db.php");
session_start();

if(!isset($_SESSION['user_id'])) {
	echo '<script>window.location="login.php?page=checkout"</script>';
}
if(isset($_POST['update'])) {
	$q = $_POST['quantity'];
	$pro_id = $_GET['id'];
}
if(isset($_POST['placeorder'])) {
	$product_id = array_column($_SESSION['shopping_cart'],'item_id');
	foreach ($product_id as $pid){
	$quantity = $_POST['finalquantity'.$pid];
	echo $quantity;
	}
}
$count = count($_SESSION["shopping_cart"]);
if($count==0){
	header("Location: index.php");
}
if(isset($_POST['delete'])) {
	if(!empty($_SESSION['shopping_cart'])) {
			foreach($_SESSION['shopping_cart'] as $k => $v) {
					if($_GET['id'] == $v['item_id'])
						unset($_SESSION["shopping_cart"][$k]);
			}
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
			<?php
			$count = 0;
			if(isset($_SESSION["shopping_cart"]))
			{
				$count = count($_SESSION["shopping_cart"]);
			}
			?>
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
							<th>Update</th>
						</tr>
					</thead>
					<?php 
						$n = 1;
						if(isset($_SESSION['shopping_cart'])){
						$product_id = array_column($_SESSION['shopping_cart'],'item_id');
						foreach ($product_id as $pid){
						$get_products ="select * from products where id='$pid'";
						$run_products = mysqli_query($conn, $get_products);
						
						while($row_products=mysqli_fetch_array($run_products))
						{
							$id = $row_products['id'];
							$name = $row_products['name'];
							$other_name = $row_products['other_name'];
							$quantity = $row_products['quantity'];
							$sp = $row_products['SP'];
							if(isset($pro_id)){
							if($id==$pro_id){
								$sp = $sp*$q;
								$quan = $q;
							}
							}
							$image = $row_products['image'];
							
					?>
					<form action="checkout.php?id=<?php echo $id; ?>" method="post">
					<tr>
						<td class="invert"><?php echo $n;?></td>
						<td class="invert-image"><a href="single.php?pid=<?php echo $id;?>"><img src="admin/product_images/<?php echo $image;?>" alt="<?php echo $n;?>" class="img-responsive" /></a></td>
						<td class="invert">
							<div class="quantity">
								<?php   echo $quantity;?> x <input type="text" style="width:30px;" id="new_val<?php echo $id;?>" value="1" name="quantity">
								<input type="hidden" id="p<?php echo $id;?>" value="<?php echo $sp;?>">
								<input type="hidden" id="price<?php echo $id;?>" value="<?php echo $sp;?>">
								<input type="hidden" id="pp<?php echo $n;?>" value="<?php echo $sp;?>">
							</div>
						</td>
						<td class="invert"><?php echo $name;?></td>
						<td class="invert">&#8377; <span id="prce<?php echo $id;?>"><?php echo $sp;?></span><span id="pirce<?php echo $id;?>"></span></td>
						<td class="invert">
							<input type="submit" class="btn btn-warning" value="Delete" name="delete">
							<button type="button" onclick="update(<?php echo $id;?>,<?php echo $n;?>)" class="btn btn-info"  name="">Update</button><br><br>
						</td>
					</tr>
					
					<?php
						}
						unset($quan);
						$n++;
					}
					
					}
					?>
					<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><b>Total Amout -</b></td>
					<td >&#8377; <span id="total_price"></span></td>
					<td>
					<input type="submit" name="placeorder" class="btn btn-primary" value="Place Order"></td>
					</tr>
					</form>
				</table>
				<br>
				<br>
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>Name</th>	
							<th>Total Amount</th>
							<th>Contact No.</th>
							<th>Address</th>
							<th>Payment Mode</th>
						</tr>
					</thead>
					<tbody>
						<tr>
						<td><?php echo $_SESSION['user_name'];?></td>
						<td>&#8377; <input type="button" id="finalAmount" value=""></td>
						<td><?php echo $_SESSION['user_num'];?></td>
						<td><?php echo $_SESSION['user_address'];?></td>
						<td>Cash on Delivery</td>
						</tr>
						<tr>
						<td colspan="4" style="text-align:left; font-weight:bold; font-size:12px;">
						If Order is placed between 6 AM to 6 PM - Same Day Delivery<br>
						If Order is placed between 6 PM to 6 AM - Next Day Delivery
						</td>
						<td>
						<a href="" onclick="">Place Order</a>
						</td>
						</tr>
					</tbody>
				</table>
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
		var total_items = <?php echo $count; ?>;
		console.log(total_items);
		var total_price=0;
		for(i=1; i<=total_items; i++){
		total_price = total_price + parseFloat($('#pp'+i).val());
		}
		console.log(total_price);
		$('#total_price').html(total_price);
		$('#finalAmount').val(total_price);
		
		$().UItoTop({ easingType: 'easeOutQuart' });
			
		

		});
		function update(a,b){
			var quantity = $('#new_val'+a).val();
			var price = $('#p'+a).val();
			var sp = quantity * price;
			console.log(sp);
			$('#new_val'+a).val(quantity);
			$('#quantity'+a).val(quantity);
			$('#pirce'+a).html(sp);
			$('#price'+a).val(sp);
			$('#pp'+b).val(sp);
			$('#prce'+a).css('display','none');
			var total_items = <?php echo $count; ?>;
			console.log(total_items);
			var total_price=0;
			for(i=1; i<=total_items; i++){
			total_price = total_price + parseFloat($('#pp'+i).val());
			}
			console.log(total_price);
			$('#total_price').html(total_price);
			$('#finalAmount').val(total_price);
		}
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