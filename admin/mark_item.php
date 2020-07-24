<?php
include("includes/db.php");
session_start();

$id = $_GET['id'];
echo "<script>console.log($id);</script>";

if(mysqli_query($conn, "Update orders SET is_completed = '1', d_date=NOW() where id='$id'")) {
	
	}
	else{
		header( "refresh:4;url=p_order.php" );
	}
mysqli_close($conn); 
?> 
