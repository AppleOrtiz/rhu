<?php
session_start();
include "connection.php";


if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $date = date('y-m-d');
$sql = "INSERT INTO `user`(`username`, `password`) VALUES ('$username','$password')";
    $result = mysqli_query($con,$sql);

if ($result){
    header("refresh:0; index.php");
    echo '<script>alert("User Registered Successfully!")</script>';
    }

else{
    echo'<script>alert("Error SQL!")</script>';
    header("refresh:0; reg.php");

    }
}

session_abort();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<center>
<br><br>
	<form method="post">
		<label>Userid</label>
		<input type="text" name="" disabled="" placeholder="AUTO GENERATED"><br><br>
		<label>Name</label>
		<input type="text" name="username" placeholder="INPUT YOUR USERNAME" required> <br><br>
		<label>Password</label>
		<input type="password" name="password" placeholder="INPUT YOUR PASSWORD" required> <br><br>
		<input type="submit" name="submit" value="REGISTER"><br><br>
		<a href="index.php">BACK</a>
</form>
</center>
</body>
</html>