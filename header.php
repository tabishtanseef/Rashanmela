<!-- header -->
	<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
				<p>SALE UP TO 50% OFF. <a href="products.php">SHOP NOW</a></p>
			</div>
			<div class="agile-login">
				<ul>
					
					<?php
					if(!isset($_SESSION['user_id'])){ 
					?>
					<li><a href="registered.php"> Create Account </a></li>
					<li><a href="login.php">Login</a></li>
					<?php 
					}
					else { 
					?>
					<li><a href="#">Hi! <?php echo $_SESSION['user_name'];?></a></li>
					<li><a href="myorders.php">Orders</a></li>
					<li><a href="logout.php">Logout</a></li>
					<?php
					} 
					?>
					<li><a href="contact.php">Help</a></li>
				</ul>
			</div>
			<div class="product_list_header">  
				<form action="checkout.php" method="post" class="last"> 
					<button class="w3view-cart" ><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
					<?php
					if(isset($_SESSION['user_id'])){
					$user_id= $_SESSION['user_id'];
					$get_cart_item ="select * from cart where user_id='$user_id'";
					$run_cart_item = mysqli_query($conn, $get_cart_item);
					$count=mysqli_num_rows($run_cart_item);
						echo "<span style='background:#F89126; border-radius:10px; padding: 10px;'>$count</span>";
					}
					else{
						echo "<span style='background:#F89126; border-radius:10px; padding: 10px;'>0</span>";
					}
					?>
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

	<div class="logo_products">
		<div class="container">
		<div class="w3ls_logo_products_left1">
			<ul class="phone_email">
				<li><i class="fa fa-phone" aria-hidden="true"></i>Order online or call us : +91-8191977000</li>	
			</ul>
		</div>
		<div class="w3ls_logo_products_left">
			<h1><a href="index.php"><img src="images/logo.png" style="width:100px;"></a></h1>
		</div>
		<div class="w3l_search">
			<form action="results.php" method="get">
				<input type="search" name="user_query" placeholder="Search for a Product..." required="">
				<button type="submit" name="search" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i>
				</button>
				<div class="clearfix"></div>
			</form>
		</div>
			
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- navigation -->
	<div class="navigation-agileits">
		<div class="container">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div> 
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php" class="act">Home</a></li>	
						<?php
						$get_cats ="select * from categories";
						$run_cats = mysqli_query($conn, $get_cats);
						 
						while($row_cats=mysqli_fetch_array($run_cats))
						{
							$cat_id = $row_cats['cat_id'];
							$cat_title = $row_cats['cat_title'];
							?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $cat_title?><b class="caret"></b></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="row">
									<div class="multi-gd-img">
										<ul class="multi-column-dropdown">
											<h6><?php echo $cat_title?></h6>
											<?php
											$get_cat ="select name from products where cat_title='$cat_title' order by rand() LIMIT 5";
											$run_cat = mysqli_query($conn, $get_cat);
											
											while($row_cat=mysqli_fetch_array($run_cat))
											{
												$name = $row_cat['name'];
											?>	
											<li><a href="<?php echo $cat_title?>.php"><?php echo $name?></a></li>
											<?php
											}
											?>
										</ul>
									</div>
								</div>
							</ul>
						</li>
						<?php
						}
						?>
						<li><a href="contact.php">Contact</a></li>
					</ul>
				</div>
				</nav>
			</div>
		</div>		
<!-- //navigation -->