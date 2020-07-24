<div class="col-md-4 products-left">
	<div class="categories">
		<h2>Categories</h2>
		<ul class="cate">
		<?php
			$get_cats ="select * from categories order by rand()";
			$run_cats = mysqli_query($conn, $get_cats);
			 
			while($row_cats=mysqli_fetch_array($run_cats))
			{
				$cat_id = $row_cats['cat_id'];
				$cat_title = $row_cats['cat_title'];
				?>
			<li><a href="<?php echo $cat_title?>.php"><i class="fa fa-arrow-right" aria-hidden="true"></i><?php echo $cat_title?></a></li>
				<ul>
					<?php
					$get_cat ="select name from products where cat_title='$cat_title' order by rand() LIMIT 5";
					$run_cat = mysqli_query($conn, $get_cat);
					
					while($row_cat=mysqli_fetch_array($run_cat))
					{
						$name = $row_cat['name'];
					?>	
					<li><a href="<?php echo $cat_title?>.php"><i class="fa fa-arrow-right" aria-hidden="true"></i><?php echo $name?></a></li>
					<?php
					}
					?>
				</ul>
			<?php
			}
			?>
		</ul>
	</div>																																												
</div>