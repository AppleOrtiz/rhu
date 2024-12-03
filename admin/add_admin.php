<?php
if(ISSET($_POST['save_user'])){
	$username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
    $password = $_POST['password'];
	$email = $_POST['email'];
	$conn = new mysqli("localhost", "root", "", "isrhh");
	$q1 = $conn->query("SELECT * FROM `facilitator_tbl` WHERE `username` = '$username'") or die(mysqli_error($conn));
	$f1 = $q1->fetch_array();
	$c1 = $q1->num_rows;
		if($c1 > 0){
			echo "<script>alert('Username already taken')</script>";
		}else{
			$conn->query("INSERT INTO `facilitator_tbl` (`username`, `firstname`, `middlename`, `lastname`, `password` , `email`) VALUES('$username', '$firstname', '$middlename', '$lastname', '$password', '$email')") or die(mysqli_error($conn));
			
		}
}
?>