<?php
require_once("conn.php");
$id = $_GET['id'];
$sql2 = "DELETE FROM `announcements` WHERE `id` = '$id'";
$result2 = mysqli_query($conn,$sql2);

if($result2)
	{
	header("refresh:0; announcement.php");	
	echo '<script>alert("Announcement successfully Deleted!")</script>';
	exit();
	}
	else
		{
			echo'Check Query!';
		}
?>