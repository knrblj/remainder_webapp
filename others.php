<?php 
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['name']))
{
$email=$_SESSION['email'];
$name=$_SESSION['name'];
?>

<!DOCTYPE html>
<?php include('connection.php');?>

<html>
<head>
	<title>Schedule for others</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="dashboard.css?<?=filesize('dashboard.css');?>"></link>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	
	<div class="head">
		<img src="logo.png" alt="logo">
		<div class="head-text">
		<h2>Welcome</h2>
		<h4>Schedule for us, we will remind you</h4>
		</div>
	</div>
	<div class="topnav">
	<a href="others.php" class="active">Schedule for others</a>
  	<div id="myLinks">
  	<a href="home.php">Home</a>
    <a href="#about"><?php echo $name; ?></a>
    <a href="logout.php">Logout</a>
  	</div>
  	<a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars" style="color:#555;"></i>
  	</a>
	</div>
	<div class="table">
		<table>
			<thead>
				<tr>
					<th>id</th>
					<th>Receiver</th>
					<th>Subject</th>
					<th>Message</th>
					<th>Date & Time</th>
					<th colspan="2">operation</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql="SELECT * from somedata where semail='$email';";
					$run=mysqli_query($conn,$sql);
					$nums=mysqli_num_rows($run);
					$i=1;
					if($nums==0)
					{?>
						<tr>
							<td colspan="7">NO SCHEDULES FOUND</td>
						</tr>
					<?php
					}
					while($res=mysqli_fetch_array($run))
					{?>
						<tr>
							<td><?php $id=$res['id']; echo $i;?></td>
							<td><?php echo $res['remail'];?></td>
							<td><?php echo $res['subject'];?></td>
							<td><?php echo $res['message'];?></td>
							<td><?php echo $res['datetime'];?></td>
							<td><a href="oupdate.php?id=<?php echo $id;?>&rm=<?php echo $res['remail'];?>&sb=<?php echo $res['subject'];?>&ms=<?php echo $res['message'];?>"><i class="fa fa-edit" aria-hidden="true" style="color:green;"></i></a></td>
							<td><a href="odelete.php?id=<?php echo $id;?>"><i class="fa fa-trash" aria-hidden="true" style="color: red;"></i></a></td>

						</tr>
				<?php
					$i++;
				}
				?>
			</tbody>
		</table>
	</div>
	<form action="oadd.php" method="POST">
		<button>Add NewTask</button>
	</form>

	<script>
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
<script src="https://kit.fontawesome.com/7fd99e2f9d.js" crossorigin="anonymous"></script>
</body>
</html>
<?php 
}else
{
	header("location:login.php");
	exit();
}
?>