<?php
include("admin/includes/db.php");
session_start();
if(isset($_COOKIE["user_id"]))
	{
		$uid = $_COOKIE["user_id"];
		$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$uid'");
		if ($row = mysqli_fetch_array($result)) {
			
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_name'] = $row['name'];		
			$_SESSION['user_num'] = $row['num'];		
			$_SESSION['user_email'] = $row['email'];	
			$_SESSION['user_address'] = $row['address'];				
		} 
		else {
			
		}
	}
if(isset($_POST["add_to_cart"]))
{
	if(!isset($_SESSION['user_id'])) {
		header("Location: login.php");
	}
	else{
		$p_id = $_POST['hidden_id'];
		$p_name = $_POST['hidden_name'];
		$p_mrp = $_POST['hidden_mrp'];
		$p_sp = $_POST['hidden_sp'];
		$p_cat = $_POST['hidden_cat'];
		$p_image = $_POST['hidden_image'];
		$p_quantity = $_POST['hidden_quantity'];
		$measuring_unit = $_POST['measuring_unit'];
		if(mysqli_query($conn, "INSERT INTO cart(user_id, user_name, cat_title, p_id, p_name, p_mrp, p_sp, p_quantity, u_sp, quantity_unit, u_quantity, measuring_unit, p_image) VALUES
			('". $_SESSION['user_id'] ."','" . $_SESSION['user_name'] . "','" . $p_cat . "', '". $p_id ."', '". $p_name ."', '" . $p_mrp . "', '" . $p_sp . "', '" . $p_quantity . "', '" . $p_sp . "', '1', '" . $p_quantity . "', '" . $measuring_unit . "', '" . $p_image . "')")) {
				
			}
		else{
			
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Rashan Mela an Ecommerce Online Shopping Category Website</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Rashan Mela Responsive web , Bootstrap Web, Flat Web , Android Compatible web , Smartphone Compatible web , free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script> 
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<script src="js/jquery-1.11.1.min.js"></script>
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


	<!-- main-slider -->
		<ul id="demo1">
			<li>
				<img src="images/11.jpg" alt="" />
				<!--Slider Description example-->
				<div class="slide-desc">
					<h3>RASHAN MELA brings everything under one roof</h3>
				</div>
			</li>
			<li>
				<img src="images/22.jpg" alt="" />
				  <div class="slide-desc">
					<h3>Buy Groceries Now On Line With Us</h3>
				</div>
			</li>
			<li>
				<img src="images/44.jpg" alt="" />
				<div class="slide-desc">
					<h3>Personal Care Products Are Now On Line With Us</h3>
				</div>
			</li>
		</ul>
	<!-- //main-slider -->
	<!-- //top-header and slider -->
	<!-- top-brands -->
	<div class="top-brands">
		<div class="container">
		<h2>Top selling offers</h2>
			<div class="grid_3 grid_5">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#expeditions" id="expeditions-tab" role="tab" data-toggle="tab" aria-controls="expeditions" aria-expanded="true">Advertised offers</a></li>
						<li role="presentation"><a href="#tours" role="tab" id="tours-tab" data-toggle="tab" aria-controls="tours">Today Offers</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="expeditions" aria-labelledby="expeditions-tab">
							<div class="agile-tp">
								<h5>Advertised this week</h5>
								<p class="w3l-ad">We've pulled together all our advertised offers into one place, so you won't miss out on a great deal.</p>
							</div>
							<div class="agile_top_brands_grids">
							<?php 
								$get_products ="select * from products order by rand()";
								$run_products = mysqli_query($conn, $get_products);
								 
								while($row_products=mysqli_fetch_array($run_products))
								{
									$id = $row_products['id'];
									$name = $row_products['name'];
									$other_name = $row_products['other_name'];
									$cat_id = $row_products['cat_id'];
									$cat_title = $row_products['cat_title'];
									$unit = $row_products['unit'];
									$quantity = $row_products['quantity'];
									$measuring_unit = $row_products['measuring_unit'];
									$mrp = $row_products['MRP'];
									$sp = $row_products['SP'];
									$image = $row_products['image'];
									
									?>
								<div class="col-md-4 top_brand_left" style="margin-top:20px;">
									<div class="hover14 column">
										<div class="agile_top_brand_left_grid">
											<div class="agile_top_brand_left_grid_pos">
												<img src="images/offer.png" alt=" " class="img-responsive" />
											</div>
											<div class="agile_top_brand_left_grid1">
												<figure>
													<div class="snipcart-item block" >
														<div class="snipcart-thumb">
															<a href="products.php"><img title=" " alt=" " src="<?php echo "admin/product_images/$image"; ?>" /></a>		
															<p style="font-weight:bold;"><?php echo $name." (".$other_name.")"; ?></p>
															<div class="stars">
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star gray-star" aria-hidden="true"></i>
															</div>
															<h4><span>&#8377;<?php echo "$mrp"; ?></span> &#8377;<?php echo "$sp"; ?> for <?php echo "$quantity"; ?> <?php echo "$measuring_unit"; ?></h4>
														</div>
														<div class="snipcart-details top_brand_home_details"> 
															<form action="index.php" method="post">
																<input type="hidden" name="hidden_id" value="<?php echo "$id"; ?>">
																<input type="hidden" name="hidden_cat" value="<?php echo "$cat_title"; ?>">
																<input type="hidden" name="hidden_quantity" value="<?php echo "$quantity"; ?>">
																<input type="hidden" name="measuring_unit" value="<?php echo "$measuring_unit"; ?>">
																<input type="hidden" name="hidden_mrp" value="<?php echo "$mrp"; ?>">
																<input type="hidden" name="hidden_sp" value="<?php echo "$sp"; ?>">
																<input type="hidden" name="hidden_name" value="<?php echo "$name"; ?>">
																<input type="hidden" name="hidden_image" value="<?php echo "$image"; ?>">
																
																<?php
																if(isset($_SESSION['user_id'])){
																$user_id= $_SESSION['user_id'];
																$get_cart_item ="select * from cart where p_id='$id' and user_id='$user_id'";
																$run_cart_item = mysqli_query($conn, $get_cart_item);
																$ch = mysqli_fetch_array($run_cart_item);
																if (strlen($ch['id']) != 0)
																{
																	echo "<input type='submit' disabled style='background:#F89126;' value='Added to cart' class='button' />";
																}else{
																	echo "<input type='submit' name='add_to_cart'  value='Add to cart' class='button' />";
																}
																}else{
																	echo "<input type='submit' name='add_to_cart'  value='Add to cart' class='button' />";
																}
																?>
															</form>
														</div>
													</div>
												</figure>
											</div>
										</div>
									</div>
								</div>
								<?php
								}
								?>
								
								<div class="clearfix"> </div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="tours" aria-labelledby="tours-tab">
							<div class="agile-tp">
								<h5>This week</h5>
								<p class="w3l-ad">We've pulled together all our advertised offers into one place, so you won't miss out on a great deal.</p>
							</div>
							<div class="agile_top_brands_grids">
								<?php 
								$get_products ="select * from products order by rand()";
								$run_products = mysqli_query($conn, $get_products);
								 
								while($row_products=mysqli_fetch_array($run_products))
								{
									$id = $row_products['id'];
									$name = $row_products['name'];
									$other_name = $row_products['other_name'];
									$cat_id = $row_products['cat_id'];
									$cat_title = $row_products['cat_title'];
									$unit = $row_products['unit'];
									$quantity = $row_products['quantity'];
									$mrp = $row_products['MRP'];
									$sp = $row_products['SP'];
									$image = $row_products['image'];
									
									?>
								<div class="col-md-4 top_brand_left" style="margin-top:20px;">
									<div class="hover14 column">
										<div class="agile_top_brand_left_grid">
											<div class="agile_top_brand_left_grid_pos">
												<img src="images/offer.png" alt=" " class="img-responsive" />
											</div>
											<div class="agile_top_brand_left_grid1">
												<figure>
													<div class="snipcart-item block" >
														<div class="snipcart-thumb">
															<a href="products.php"><img title=" " alt=" " src="<?php echo "admin/product_images/$image"; ?>" /></a>		
															<p style="font-weight:bold;"><?php echo $name." (".$other_name.")"; ?></p>
															<div class="stars">
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star gray-star" aria-hidden="true"></i>
															</div>
															<h4><span>&#8377;<?php echo "$mrp"; ?></span> &#8377;<?php echo "$sp"; ?> for <?php echo "$quantity"; ?> <?php echo "$measuring_unit"; ?></h4>
														</div>
														<div class="snipcart-details top_brand_home_details"> 
															<form action="index.php" method="post">
																<input type="hidden" name="hidden_id" value="<?php echo "$id"; ?>">
																<input type="hidden" name="hidden_cat" value="<?php echo "$cat_title"; ?>">
																<input type="hidden" name="hidden_quantity" value="<?php echo "$quantity"; ?>">
																<input type="hidden" name="hidden_mrp" value="<?php echo "$mrp"; ?>">
																<input type="hidden" name="hidden_sp" value="<?php echo "$sp"; ?>">
																<input type="hidden" name="hidden_name" value="<?php echo "$name"; ?>">
																<input type="hidden" name="hidden_image" value="<?php echo "$image"; ?>">
																
																<?php
																if(isset($_SESSION['user_id'])){
																$user_id= $_SESSION['user_id'];
																$get_cart_item ="select * from cart where p_id='$id' and user_id='$user_id'";
																$run_cart_item = mysqli_query($conn, $get_cart_item);
																$ch = mysqli_fetch_array($run_cart_item);
																if (strlen($ch['id']) != 0)
																{
																	echo "<input type='submit' disabled style='background:#F89126;' value='Added to cart' class='button' />";
																}else{
																	echo "<input type='submit' name='add_to_cart'  value='Add to cart' class='button' />";
																}
																}else{
																	echo "<input type='submit' name='add_to_cart'  value='Add to cart' class='button' />";
																}
																?>
															</form>
														</div>
													</div>
												</figure>
											</div>
										</div>
									</div>
								</div>
								<?php
								}
								?>
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- //footer -->
<?php include('footer.php'); ?>
<!-- //footer -->	
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
	$('.value-plus').on('click', function(){
		var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
		divUpd.text(newVal);
		$('#quantity').val(newVal);
		var a = $('#quantity').val();
		console.log(a);
	});

	$('.value-minus').on('click', function(){
		var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
		if(newVal>=1) {
			divUpd.text(newVal);
		$('#quantity').val(newVal);
		var a = $('#quantity').val();
		console.log(a);
		}
	});
</script>
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