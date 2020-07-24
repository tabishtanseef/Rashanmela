<?php
include("includes/db.php");
session_start();
if(!isset($_SESSION['admin_id'])) {
	header("Location: login.php");
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
.hidden{
	display:none;
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
			<div class="container-fluid out">
				<div class="row">
					<div class="col-md-12 col-md-offset-12 well">
						<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform" enctype="multipart/form-data">
							<fieldset>
								<legend>Pending Orders</legend>
								<div class="row sub" style="margin-top:2%;">
								<div class="col-sm-12 horizontal-scroll">
										<?php
										$get_products ="select order_id from orders where is_completed='0' order by id ASC";
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
										{	?>
									<table id="school_list<?php echo$shah; ?>" class="table table-hover table-striped table-bordered table-responsive w-100 d-block d-md-table" style="width:100%;">
										<thead>
										<th>Sr. No.</th>
										<th>Product Id</th>
										<th>Name</th>
										<th>Image</th>
										<th>Category</th>
										<th>Quantity</th>
										<th>Price</th>
										<th>Customer</th>
										<th>Number</th>
										<th>Address</th>
										<th>Status</th>
										</thead>
										<tbody>
										<?php
											$n=1;
											$total_price = 0;
											$get_pro ="select * from orders where order_id='$order_ids[$shah]'";
											$run_pro = mysqli_query($conn, $get_pro);	
											while($row_attendance=mysqli_fetch_array($run_pro))
											{
												$id = $row_attendance['id'];
												$user_id = $row_attendance['user_id'];
												$p_id = $row_attendance['p_id'];
												$order_id = $row_attendance['order_id'];
												$cat_title = $row_attendance['cat_title'];
												$name = $row_attendance['p_name'];
												$quantity = $row_attendance['quantity'];
												$price = $row_attendance['price'];
												$image = $row_attendance['image'];
												$user_name = $row_attendance['user_name'];
												$user_num = $row_attendance['user_num'];
												$user_address = $row_attendance['user_address'];
												$date = $row_attendance['date'];
												$day = $row_attendance['day'];
												$is_comp = $row_attendance['is_completed'];
												if($is_comp==0){
												echo "<tr id='$id'>
												<td>$n</td>
												<td>$p_id</td>
												<td>$name</td>
												<td><img src='product_images/$image' style='width:100px;'></td>
												<td>$cat_title</td>
												<td>$quantity</td>
												<td>$price</td>
												<td>$user_name</td>
												<td>$user_num</td>
												<td>$user_address</td>";
												
												?>
												<td><img src='img/d.png' onclick='mark_item(<?php echo $id;?>)' style='width:75px; margin:auto;'></td>
												</tr>
											<?php
												}
												else{
													
												}
											$n++; 
											  $total_price = $total_price + $price;
											}?>
											</tbody>
									</table>
									<h4>Your Order Id is - <span style="color:green;">#<?php echo $order_ids[$shah];?></span>  and total payable amount is <span style="color:green;">&#8377;<?php echo $total_price;?></span></h4>
									<hr>
									<?php
											$shah++;
										}
										?>
										
								</div>
							</div>
							</fieldset>
						</form>
					</div>
				</div>	
			</div>
		</div>
    </div>
	<iframe id="txtArea1" style="display:none"></iframe>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	 <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<script type="text/javascript" src="MDB/js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="MDB/js/addons/datatables.min.js"></script>
	<script type="text/javascript" src="MDB/js/mdb.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
			$('.dataTables_length').addClass('bs-select');
			
			var count = "<?php echo $new; ?>";
			for(var i=0; i<count; i++){
			$('#school_list'+i).DataTable();
			}
        });
		
function mark_item(delete_id){
	console.log(delete_id);
	$("#"+delete_id).addClass('hidden');
	$.ajax({
	url: 'mark_item.php',
	type: 'GET',
	data: {'id':delete_id},
	dataType: 'json',
	success:function(response){
	
	}
	
});
	
}
$(document).ajaxStop(function(){
    location.reload(true);
});
    </script>
</body>

</html>