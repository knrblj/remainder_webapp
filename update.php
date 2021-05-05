<?php 
include "connection.php";
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['name']))
{
$email=$_SESSION['email'];
$name=$_SESSION['name'];
?>


<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
		<?php 
		$id=$_GET['id'];
		$subject=$_GET['sb'];
		$message=$_GET['ms'];

		if(isset($_POST['submit']))
		{
			$email=$_POST['email'];
			$subject=$_POST['subject'];
			$message=$_POST['message'];
			$datetime=$_POST['datetime'];
			$query="UPDATE `maildata` SET `subject`='$subject',`message`='$message',`datetime`='$datetime' WHERE id='$id' and email='$email'";
			$run=mysqli_query($conn,$query);
			if($run)
			{
				header("location:home.php");
			}
			else
			{
				header("location:update.php?error=Something went wrong");
				exit();
			}
		}
		?>
		<form action="" method="POST">
		<h2>Schedule</h2>

		<?php if(isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']?></p>
		<?php } ?>

		<label>Email Address</label>
		<input type="email" name="email"  value="<?php echo $email; ?>" readonly><br>

		<label>Subject</label>
		<input type="text" name="subject" value="<?php echo $subject; ?>" required="">

		<label>Message</label>
		<input type="text" name="message" value="<?php echo $message; ?>"  required="">

		<label>Subject</label>
		<input type="datetime-local" name="datetime"  required="">

		<button type="submit" name="submit">ADD</button>
</body>
</html>

<?php 
}else
{
	header("location:login.php");
	exit();
}
?>