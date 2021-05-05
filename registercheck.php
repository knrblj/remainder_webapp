<?php 
session_start();
include("connection.php");
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['cpassword']))
{
	function validate($data)
	{
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}

	$email=validate($_POST['email']);
	$name=validate($_POST['name']);
	$password=validate($_POST['password']);
	$cpassword=validate($_POST['cpassword']);

	if(strlen($name)<4)
	{
		header("location:register.php?error=Name must be greather than 4");
		exit();
	}
	else if(strlen($password)<6)
	{
		header("location:register.php?error=Password must be greather than 4");
		exit();
	}
	else if($password!=$cpassword)
	{
		header("location:register.php?error=Password and Confrim Password doesn't match");
		exit();
	}
	else
	{
		$query="select * from userdata where email='$email';";
		$run=mysqli_query($conn,$query);
		if(mysqli_num_rows($run)>0)
		{
			header("location:register.php?error=Email id already exists");
			exit();
		}
		else
		{
			$q="INSERT INTO userdata VALUES('','$email','$name','$password');";
			$r=mysqli_query($conn,$q);
			if($r)
			{
				header("location:login.php");
			}
			else
			{
				header("location:register.php?error=Something Went Wrong");
				exit();
			}
		}
	}
}
else
{
    header("location:register.php");
	exit();
}
?>