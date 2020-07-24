<?php
include("includes/db.php");
session_start();
if(!isset($_SESSION['admin_id'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Rashan Mela</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<style type="text/css">
body{
	background-image: url('3.jpg');
    background-size: cover;
	
}
table{
	color:black;
	background-image: url('1.jpg');
    background-size: cover;
}
td{
	padding:10px;
}
</style>

</head>
<body>
<br>
<form method="POST"  action="insert_product.php" enctype="multipart/form-data">
<table width="700px"  align="center" border=1px >

<tr align= "center">
<td colspan="2" height="80px"><h1>Insert New Product</h1></td>
</tr>
<tr>
<td align="right" ><b>Product Name</b></td>
<td ><input type="text" name="product_title" required size="50"/></td>
</tr>
<tr>
<td align="right" ><b>Other Name</b></td>
<td ><input type="text" name="product_title2" placeholder="Optional" size="50"/></td>
</tr>

<tr>
<td align="right"><b>Product category</b></td>
<td><select name="product_cat"/>
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
</tr>

<tr>
<td align="right"><b>Product Units Available</b></td>
<td><input type="text" name="product_unit" size="50"/></td>
</tr>

<tr>
<td align="right"><b>Product Quantity</b></td>
<td><input type="text" name="product_quantity" placeholder="1 Packet/ 1 KG/ 1 Litre" size="50"/></td>
</tr>

<tr>
<td align="right"><b>Product CP</b></td>
<td><input type="text" name="product_cost" /></td>
</tr>

<tr>
<td align="right"><b>Product MRP</b></td>
<td><input type="text" name="product_mrp" /></td>
</tr>

<tr>
<td align="right"><b>Product SP</b></td>
<td><input type="text" name="product_price" /></td>
</tr>

<tr>
<td align="right"><b>Product Image 1</b></td>
<td><input type="file" name="product_img1"/></td>
</tr>

<tr>
<td align="right"><b>Product Keywords</b></td>
<td><input type="text" name="product_keywords" size="50"/></td>
</tr>

<tr>
<td align="right"><b>Product Keywords</b></td>
<td><input type="text" name="product_keywords" size="50"/></td>
</tr>

<tr align="center">
<td colspan="2"><input type="submit" name="insert_product" value="Insert Product"/></td>
</tr>

</table>
</form>
</body>
</html>


<?php






if(isset($_POST['insert_product']))
{
	
	//text data variables
	$product_title=$_POST['product_title'];
    $product_cat=$_POST['product_cat'];
	$product_price=$_POST['product_price'];
	$product_cost=$_POST['product_cost'];
	$product_desc=$_POST['product_desc'];
	$product_keywords=$_POST['product_keywords'];
	$status='on';
	
	//image_names
	$product_img1 = $_FILES['product_img1']['name'] ;
	$product_img2 = $_FILES['product_img2']['name'] ;
	
	//image temp names
	$temp_name1 = $_FILES['product_img1']['tmp_name'] ;
	$temp_name2 = $_FILES['product_img2']['tmp_name'] ;
	
	
	
	
	if($product_title=='' OR $product_cat=='' OR $product_price=='' OR $product_cost=='' OR $product_desc=='' OR $product_keywords=='' OR $product_img1=='')
	{
		echo "<script>alert('please fill all the fields')</script>";
	    exit();
	}
	else
	{   
           //uploading images to its folder
		   move_uploaded_file($temp_name1,"product_images/$product_img1");
		   move_uploaded_file($temp_name2,"product_images/$product_img2");
		
		$insert_product = "insert into products (cat_id,price_id,date,product_title,product_img1,product_img2,product_cost,product_desc,product_keywords,status)
		values ('$product_cat','$product_price',NOW(),'$product_title','$product_img1','$product_img2','$product_cost','$product_desc','$product_keywords','$status')";
	
	    $run_product= mysqli_query($con, $insert_product);
		
		if($run_product)
		{
			echo "<script> alert('Product inserted successfully') </script>";
		}
	
	}
	

	
	
	
}

?> 


 











