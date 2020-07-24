<?php
include("admin/includes/db.php");
session_start();

$id = $_GET['del_id'];
$user_id = $_GET['user_id'];

if(mysqli_query($conn, "Delete from cart where id='$id'")) {
		
	}
mysqli_close($conn); 

?> 
