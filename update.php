<?php
error_reporting(0);
$conn=mysqli_connect("localhost","root","","form");

?>
<html>
<head></head>
<body>

<form action="" method="GET">
status<input type ="text" name="status" value="<?php echo $_GET['status']; ?>"/> <br><br>
id<input type ="text" name="id" value="<?php  echo $_GET['id']; ?>"/> <br><br>

<input type="submit" name="submit" value="UPDATE"/>
</form>
<?php

if($_GET['submit'])
{
	$status=$_GET['status'];
	$id=$_GET['id'];
	// $hometown=$_GET['hometown'];
	// $gender=$_GET['gender'];
	$query="update images set status='$status' where id='$id'";
	$data=mysqli_query($conn, $query);
	if($data)
	{
	echo "<font color='green'>record update sucessful.<a href='admin_panel.php'>CHECK UPDATE";
	}
	else
		echo "<font color='red'>record update not sucessful.<a href='admin_panel.php'>CHECK UPDATE";
		
	}
else
{
	echo "<font color='blue'>Click on update button to save the changes";
}
	?>


</body>
</html>
