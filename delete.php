<?php 
include "connection.php";
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['name']))
{
$email=$_SESSION['email'];
$name=$_SESSION['name'];
$id=$_GET['id'];
$query="DELETE FROM `maildata` WHERE id='$id' and email='$email'";
$run=mysqli_query($conn,$query);
if($run)
{
	header("location:home.php");
}
else
{
	echo "<script>alert('Dont play with data')</script>";
}
}
else
{
	header("location:login.php");
	exit();
}
?>