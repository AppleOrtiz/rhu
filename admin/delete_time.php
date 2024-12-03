
	<?php
	require_once("conn.php");
	$id = $_GET['id'];
	$sql2 = "DELETE FROM `time_log` WHERE `id` = '$id'";
	$result2 = mysqli_query($conn,$sql2);
	
	if($result2)
		{
		header("refresh:0; time_log.php");	
		echo '<script>alert("You successfully Deleted!")</script>';
		exit();
		}
		else
			{
				echo'Check Query!';
			}
	?>