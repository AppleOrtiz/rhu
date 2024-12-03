<?php
require_once("conn.php");
$pa_id = $_GET['pa_id'];
$sql2 = "DELETE FROM `patient_archive` WHERE `pa_id` = '$pa_id'";
$result2 = mysqli_query($conn,$sql2);

if($result2)
	{
	header("refresh:0; archive.php");	
	echo '<script>alert("Patient Form successfully Deleted!")</script>';
	exit();
	}
	else
		{
			echo'Check Query!';
		}
?>