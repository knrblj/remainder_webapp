<?php 
session_start();
include("connection.php");
if(isset($_POST['email']) && isset($_POST['password']))
{
	function validate($data)
	{
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
	$email=validate($_POST['email']);
	$password=validate($_POST['password']);
	if(empty($email))
	{
		header("location:login.php?error=Email Address Required");
		exit();
	}else if(empty($password))
	{
		header("location:login.php?error=Password Required");
		exit();
	}else
	{
		$sql="SELECT * FROM userdata where email='$email' and password='$password';";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)===1)
		{
			$row=mysqli_fetch_array($result);
			if($row['email']==$email && $row['password']==$password)
			{
				$_SESSION['name']=$row['name'];
				$_SESSION['email']=$row['email'];
				$_SESSION['id']=$row['id'];
				header("location:home.php");
				exit();
			}
			else
			{
				header("location:login.php?error=Incorrect Email and Password");
				exit();
			}
		}
		else
			{
				header("location:login.php?error=Incorrect Email and Password");
				exit();
			}
	}
}
else
	{
		header("location:login.php");
		exit();
	}
?>