<?php
include("includes/db.php");
session_start();
if(!isset($_SESSION['admin_id'])) {
	header("Location: login.php");
}

if(isset($_POST['update']))
{
	//text data variables
	$name=$_POST['product_title'];
	$other_name=$_POST['product_title2'];
    $cat_id=$_POST['cat_id'];
    $cat_title=$_POST['cat_title'];
	$unit=$_POST['product_unit'];
	$quantity=$_POST['product_quantity'];
	$measuring_unit=$_POST['measuring_unit'];
	$cp=$_POST['product_cost'];
	$mrp=$_POST['product_mrp'];
	$sp=$_POST['product_price'];
	$keywords=$_POST['product_keywords'];
	
	//image_names
	$product_img = $_FILES['product_img']['name'] ;

	//image temp names
	$temp_name = $_FILES['product_img']['tmp_name'] ;

	$file = rand(1000,100000)."-".$_FILES['product_img']['name'] ;
	$files = preg_replace('/\s+/', '_', $file);
	$temp_file = $_FILES['product_img']['tmp_name'] ;
	$file_size = $_FILES['product_img']['size'];
    $file_type = $_FILES['product_img']['type'];
	$folder="product_images/";
	$target_file = $folder.basename($_FILES["product_img"]["name"]);
    $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
    move_uploaded_file($temp_file,$folder.$files);  
	//uploading images to its folder

	$insert_product = "insert into products (cat_id,cat_title,name,other_name,unit,quantity,measuring_unit,CP,MRP,SP,image,keywords)
	values ('$cat_id','$cat_title','$name','$other_name','$unit','$quantity','$measuring_unit','$cp','$mrp','$sp','$files','$keywords')";

	$run_product= mysqli_query($conn, $insert_product);

	if($run_product)
	{
		echo "<script> alert('Product inserted successfully'); </script>";
	}
	else{
		echo "<script> alert('$cat_id'); </script>";
		echo "<script> alert('$cat_title'); </script>";
		echo "<script> alert('$name'); </script>";
		echo "<script> alert('$other_name'); </script>";
		echo "<script> alert('$unit'); </script>";
		echo "<script> alert('$product_img'); </script>";
		echo "<script> alert('$quantity'); </script>";
		echo "<script> alert('$cp'); </script>";
		echo "<script> alert('$mrp'); </script>";
		echo "<script> alert('$sp'); </script>";
		echo "<script> alert('$keywords'); </script>";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
<style>

	th, td{
	font-weight:bold;
	text-align:right;
	color:#32B394;
	}
	
	
	.table-responsive {
		display:block;
		min-width: rem-calc(1500);
	}
	.sub{
		width:auto;
		background:white;
		margin:10px;
		box-shadow:3px 3px 3px #aaa;
		border:2px solid #AAA;
		padding-top:15px;
	}
	.horizontal-scroll {
		overflow: hidden;
		overflow-x: auto;
		clear: both;
		width: 100%;
	}
</style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include('sidebar.php');?>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>RashanMela</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="https://rashanmela.com">Switch to User View</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
			<div class="container" style="min-height:500px;">
			<div class="container out">
				<div class="row">
					<div class="col-md-12 col-md-offset-12 well">
						<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform" enctype="multipart/form-data">
							<fieldset>
								<legend>Insert New Product</legend>
								<div class="row sub" style="margin-top:2%;">
									<div class="col-sm-12 horizontal-scroll">
										<table class="table table-hover table-responsive w-100 d-block d-md-table" style="width:100%;">
											<tbody>
											<tr>
											<td style="padding-top:20px;" >Product Name</td>
											<td><input type="text" name="product_title"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;" >Optional Name</td>
											<td><input type="text" name="product_title2"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;" >Product category</td>
											<td><select class="form-control" id="school" name="cat_id"/>
											<option>Select a Category</option>
											<?php
												$get_cats = "select * from categories";
												$run_cats = mysqli_query($conn, $get_cats);
												while($row_cats = mysqli_fetch_array($run_cats))
												{   
												$cat_id= $row_cats['cat_id']; 
												$cat_title=$row_cats['cat_title'];
												echo "<option value='$cat_id'>$cat_title</option>";
												}
											?>
											</select></td>
											<input type="hidden" name="cat_title" id="cat_hidden">
											</tr>
											<tr>
											<td style="padding-top:20px;">Product Units Available</td>
											<td><input type="text" name="product_unit" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Product Quantity</td>
											<td><input type="text" name="product_quantity" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Measuring Unit</td>
											<td><input type="text" name="measuring_unit" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Product CP</td>
											<td><input type="text" name="product_cost" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Product MRP</td>
											<td><input type="text" name="product_mrp" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Product SP</td>
											<td><input type="text" name="product_price" class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Product Image</td>
											<td><input type="file" name="product_img" class="form-control"/></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Product Keywords</td>
											<td><input type="text" name="product_keywords" class="form-control" /></td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="form-group">
									<center><input type="submit" name="update" value="Insert Product" class="btn" style="background:#fab017; font-weight:bold;" /></center>
								</div>
							</fieldset>
						</form>
					</div>
				</div>	
			</div>
			</div>
		</div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
	$("#school").change(function(){
	var school = $(this).val();
	var schoolname = $("#school option:selected").text();
	$("#cat_hidden").val(schoolname);
	});
    </script>
</body>

</html>