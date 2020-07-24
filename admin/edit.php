<!DOCTYPE HTML>
<?php 
ob_start();
include_once("includes/db.php");
session_start();
$error = false;

if(isset($_GET['edit_id']))
{
	$_SESSION['product_id'] =$_GET['edit_id'];
	
}
$product_id = $_SESSION['product_id'];

if (isset($_POST['update'])) {

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$other_name = mysqli_real_escape_string($conn, $_POST['other_name']);
	$cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
	$cat_title = mysqli_real_escape_string($conn, $_POST['cat_title']);
	$unit = mysqli_real_escape_string($conn, $_POST['unit']);	
	$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);	
	$cp = mysqli_real_escape_string($conn, $_POST['cp']);	
	$mrp = mysqli_real_escape_string($conn, $_POST['mrp']);	
	$sp = mysqli_real_escape_string($conn, $_POST['sp']);	
	$keywords = mysqli_real_escape_string($conn, $_POST['keywords']);	

	if(mysqli_query($conn, "Update products SET name= '". $name ."', other_name= '". $other_name ."', cat_id= '". $cat_id ."', cat_title= '". $cat_title ."', unit= '". $unit ."', quantity= '". $quantity ."', cp= '". $cp ."', mrp= '". $mrp ."', sp= '". $sp ."', keywords= '". $keywords ."' where id = $product_id")) {
		$success_message = "Successfully Updated!";
		header( "refresh:4;url=index.php" );
	} else {
		$error_message = "Error in Updating...Please try again later!";
	}
	
	
}
?>

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
<link rel="stylesheet" href="MDB/css/mdb.min.css">
<link href="MDB/css/addons/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<!-- Font Awesome JS -->
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
<script src="js/date_time.js"></script> 
<style>

th, td{
text-align:center;
font-size:14px;
}
h4, th{
color:#E85A4F;
font-size:18px !important; 
font-weight:bold !important	;
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
.link{
	font-weight:bold;
	color:#E85A4F;
	text-align:left;
}
input[type=text]{
	width:100%;
}
a{
	color:white;
}
</style>
</head>
<body >
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
							<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
							<fieldset>
								<legend>Update Info</legend>
								<span class="text-success"><?php if (isset($success_message)) { echo $success_message; } ?></span>
								<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
								<div class="row" style="margin-top:2%;">
									<div class="col-md-12 horizontal-scroll sub" style="padding:20px;">
										<table class="table table-hover table-responsive w-100 d-block d-md-table" style="width:100%;">
											<tbody>
											<?php
											$get_attendance="select * from products where id='$product_id'";
											$run_attendance= mysqli_query($conn, $get_attendance);
											$row_attendance=mysqli_fetch_array($run_attendance);
											$cat_id = $row_attendance['cat_id'];
											$cat_title = $row_attendance['cat_title'];
											$name = $row_attendance['name'];
											$other_name = $row_attendance['other_name'];
											$unit = $row_attendance['unit'];
											$quantity = $row_attendance['quantity'];
											$cp = $row_attendance['CP'];
											$mrp = $row_attendance['MRP'];
											$sp = $row_attendance['SP'];
											$image = $row_attendance['image'];
											$keywords = $row_attendance['keywords'];
											?>
											<tr>
											<td style="padding-top:20px;" >Name</td>
											<td><input type="text" name="name" value="<?php echo $name; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;" >Other Name</td>
											<td><input type="text" name="other_name" value="<?php echo $other_name; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Category</td>
											<td>
											<select class="form-control" id="school" value="<?php echo $cat_title; ?>" name="cat_id"/>
											<option>Select a Category</option>
											<?php
												$get_cats = "select * from categories";
												$run_cats = mysqli_query($conn, $get_cats);
												while($row_cats = mysqli_fetch_array($run_cats))
												{   
												$c_id= $row_cats['cat_id']; 
												$c_title=$row_cats['cat_title'];
												if ($c_title==$cat_title){
													echo "<option value='$c_id' selected>$c_title</option>";
												}
												else{
													echo "<option value='$c_id'>$c_title</option>";
												}
												}
											?>
											</select></td>
											<input type="hidden" name="cat_title" id="cat_hidden">
											</tr>
											<tr>
											<td style="padding-top:20px;">Unit</td>
											<td><input type="text" name="unit"  value="<?php echo $unit; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Quantity</td>
											<td><input type="text" name="quantity"  value="<?php echo $quantity; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">C.P.</td>
											<td><input type="text" name="cp"  value="<?php echo $cp; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">MRP</td>
											<td><input type="text" name="mrp"  value="<?php echo $mrp; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">S.P.</td>
											<td><input type="text" name="sp"  value="<?php echo $sp; ?>"  class="form-control" /></td>
											</tr>
											<tr>
											<td style="padding-top:20px; color:red; font-weight:bold;"><a href="updatepic.php?pid=<?php echo $product_id;?>">Edit</a></td>
											<td><img src=<?php echo "product_images/$image";?> style="width:100px;"></td>
											</tr>
											<tr>
											<td style="padding-top:20px;">Keywords</td>
											<td><textarea name="keywords"  class="form-control" ><?php echo $keywords; ?> </textarea></td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
								
								<div class="form-group">
									<center><input type="submit" name="update" value="Update!" class="btn" style="background:#fab017; font-weight:bold;" /></center>
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