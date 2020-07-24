<?php
include("includes/db.php");
session_start();
if(!isset($_SESSION['admin_id'])) {
	header("Location: login.php");
}
if(isset($_GET['pid'])){
$_SESSION['pid'] = $_GET['pid'];
}
$id = $_SESSION['pid'];
?>
<!doctype html>
<html lang="en">

 
<head>
<!--
    Programming by Ildar Sagdejev ( http://twitter.com/tknomad )
  -->
<meta charset="UTF-8">
<title>Cloud 9 Carousel jQuery Plugin Demo</title>

<meta name="viewport" content="width=device-width, initial-scale=1">



</head>

 <center>
 <form method="post"  action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<table align="center"   border="0">
<tr> <td id="tab"><h3><center><b>Change Product Picture</b></center></h3></td></tr>
<tr>
<td><input type="file"  name="pic"/></td>
</tr>
<tr>
<td><button type="submit" name="ch">Change</button></td>
</tr>
 
</table>
</form>
 
 </center>
</DIV>
</body>
</html>

<?php
if(isset($_POST['ch']))
{ 	
$file = rand(1000,100000)."-".$_FILES['pic']['name'] ;
$files = preg_replace('/\s+/', '_', $file);
$temp_file = $_FILES['pic']['tmp_name'] ;
$file_size = $_FILES['pic']['size'];
$file_type = $_FILES['pic']['type'];
$folder="product_images/";
$target_file = $folder.basename($_FILES["pic"]["name"]);
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	
	
if($FileType != "jpg" && $FileType != "JPG" && $FileType != "png" && $FileType != "jpeg" && $FileType != "gif"  && $FileType != "PNG" )  
{
    echo "<script>alert('it seems your image format is not supported by our system, we are sorry for trouble!!!');</script>"; 
}
 else
 {   
 move_uploaded_file($temp_file,$folder.$files);
  echo $files;
 $insert_user = "UPDATE products SET image='$files' WHERE id=$id";
 $run_user = mysqli_query($conn, $insert_user);
		
if($run_user)
 {

       echo "<script>alert('successfully changed');</script>";
	 header ('Location:index.php');
 }
 else
 {

       echo "<script>alert('error while uploading...!!!');</script>";
      
 }
}
 
}


?>
