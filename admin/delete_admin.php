
	<?php
	require_once("conn.php");
	$fac_id = $_GET['fac_id'];
	$sql2 = "DELETE FROM `facilitator_tbl` WHERE `fac_id` = '$fac_id'";
	$result2 = mysqli_query($conn,$sql2);
	
	if($result2)
		{
		header("refresh:0; create-ad.php");	
		echo '<script>alert("You successfully Deleted!")</script>';
		exit();
		}
		else
			{
				echo'Check Query!';
			}
	?>