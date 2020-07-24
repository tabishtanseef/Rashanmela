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
								<legend>Update Products</legend>
								<div class="row sub" style="margin-top:2%;">
								<div class="col-sm-12 horizontal-scroll">
									<table id="school_list" class="table table-hover table-striped table-bordered table-responsive w-100 d-block d-md-table" style="width:100%;">
										<thead>
										<th>Edit</th>
										<th>Sr. No.</th>
										<th>Image</th>
										<th>Name</th>
										<th>Other Name</th>
										<th>Category</th>
										<th>Unit Available</th>
										<th>Quantity</th>
										<th>CP</th>
										<th>MRP</th>
										<th>SP</th>
										<th>Keyword</th>
										<th>Delete</th>
										</thead>
										<tbody>
										<?php
										$get_attendance="select * from products order by name DESC, id DESC";
										$run_attendance= mysqli_query($conn, $get_attendance);
										$n=1;
										while($row_attendance=mysqli_fetch_array($run_attendance))
										{
											
											$id = $row_attendance['id'];
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
											
											echo "<tr>
											<td><a href='edit.php?edit_id=$id'><img src='img/edit.png' style='width:25px; margin:auto;'></a></td>
											<td>$n</td>
											<td><img src='product_images/$image' style='width:100px;'></td>
											<td>$name</td>
											<td>$other_name</td>
											<td>$cat_title</td>
											<td>$unit</td>
											<td>$quantity</td>
											<td>$cp</td>
											<td>$mrp</td>
											<td>$sp</td>
											<td>$keywords</td>
											<td><a href='delete.php?del_id=$id'><img src='img/del.png' style='width:25px; margin:auto;'></a></td>
											</tr>";
										  $n++; 
										}
										?>
										</tbody>
									</table>
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
			$('#school_list').DataTable();
			$('.dataTables_length').addClass('bs-select');
        });
	$("#school").change(function(){
	var school = $(this).val();
	var schoolname = $("#school option:selected").text();
	$("#cat_hidden").val(schoolname);
	});
    </script>
</body>

</html>