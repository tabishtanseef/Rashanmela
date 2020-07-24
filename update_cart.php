<?php
include_once("include/db_connect.php");
session_start();
header('Content-Type: application/json');

$user_id = $_POST['user_id'];  
$quantity = $_POST['quantity'];   
$sp = $_POST['sp'];  
$p_id = $_POST['p_id'];  
$new_sp = $quantity * $sp;

echo "<script>console.log('$user_id');</script>";
echo "<script>console.log('$quantity');</script>";
echo "<script>console.log('$sp');</script>";
echo "<script>console.log('$p_id');</script>";
echo "<script>console.log('$new_sp');</script>";

$users_arr = array();

if(mysqli_query($conn, "Update cart SET p_quantity= '". $quantity ."', p_sp= '". $new_sp ."' where p_id='$p_id' and user_id='$user_id'")) {
	$users_arr[] = array( "message" => "Day already started!");
}
else{
	$users_arr[] = array( "message" => "Day Not started!");
} 

// encoding array to json format
?>