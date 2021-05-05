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
	<title>ADD SCHEDULES</title>
	<link rel="stylesheet" type="text/css" href="styles.css?<?=filesize('styles.css');?>"></link>
</head>
<body>
		<?php 
			if(isset($_POST['submit']))
			{
				$email=$_POST['email'];
				$subject=$_POST['subject'];
				$message=$_POST['message'];
				$datetime=$_POST['datetime'];
				$result=mysqli_query($conn,"INSERT INTO maildata VALUES('','$email','$subject','$message','$datetime');");
				if($result)
				{
					header("location:home.php");
				}
				else
				{
					header("location:add.php?error=Dont play with data");
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
		<input type="text" name="subject" placeholder="Enter your subject..." required="">

		<label>Message</label>
		<input type="text" name="message" placeholder="Enter your message.." required="">

		<label>Date & Time</label>
		<input type="datetime-local" name="datetime" placeholder="Enter the date" required="">

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