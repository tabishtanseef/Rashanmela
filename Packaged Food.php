<?php
include("admin/includes/db.php");
session_start();

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
<title>Super Market an Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Products :: w3layouts</title>
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
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.css">
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
<!-- start-smoth-scrolling -->
</head>
	
<body>
<!-- header -->
	<?php include('header.php'); ?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Packaged Food</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!--- products --->
	<div class="products">
		<div class="container">
			<?php include('products_sidebar.php');?>
			<div class="col-md-8 products-right">
				<div class="agile_top_brands_grids">
					<?php 
					$get_products ="select * from products where cat_title='Packaged Food' order by rand()";
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
									<img src="images/offer.png" alt=" " class="img-responsive">
								</div>
								<div class="agile_top_brand_left_grid1">
									<figure>
										<div class="snipcart-item block">
											<div class="snipcart-thumb">
												<a href="single.html"><img title=" " alt=" " src="<?php echo "admin/product_images/$image"; ?>" /></a>	
												<p><?php echo $name." (".$other_name.")"; ?></p>
												<h4><span>&#8377;<?php echo "$mrp"; ?></span> &#8377;<?php echo "$sp"; ?> for <?php echo "$quantity"; ?> <?php echo "$measuring_unit"; ?></h4>
											</div>
											<div class="snipcart-details top_brand_home_details">
												<form action="#" method="post">
													<input type="hidden" name="hidden_id" value="<?php echo "$id"; ?>">
													<input type="hidden" name="hidden_cat" value="<?php echo "$cat_title"; ?>">
													<input type="hidden" name="hidden_quantity" value="<?php echo "$quantity"; ?>">
													<input type="hidden" name="measuring_unit" value="<?php echo "$measuring_unit"; ?>">
													<input type="hidden" name="hidden_mrp" value="<?php echo "$mrp"; ?>">
													<input type="hidden" name="hidden_sp" value="<?php echo "$sp"; ?>">
													<input type="hidden" name="hidden_name" value="<?php echo "$name"; ?>">
													<input type="hidden" name="hidden_image" value="<?php echo "$image"; ?>">
													<fieldset>
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
													</fieldset>
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
				<!--
				<nav class="numbering">
					<ul class="pagination paging">
						<li>
							<a href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
						<li class="active"><a href="#">1<span class="sr-only">(current)</span></a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li>
							<a href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>-->
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!--- products --->
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