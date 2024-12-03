<?php

session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$db_name = "isrhh";

$conn = mysqli_connect($servername, $username_db, $password_db, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to find the facilitator with the provided username
    $query = mysqli_query($conn, "SELECT * FROM facilitator_tbl WHERE username='$username'");
    $exists = mysqli_num_rows($query);

    if ($exists > 0) {
        $row = mysqli_fetch_assoc($query);
        $table_user = $row['username'];
        $table_password = $row['password'];
        $facilitator_id = $row['fac_id']; // Get the specific fac_id for this user

        // Check if the password is correct
        if ($username == $table_user && $password == $table_password) {

            date_default_timezone_set('Asia/Manila');   
            
            // Store username, fac_id, and login time in the session
            $_SESSION['user'] = $username;
            $_SESSION['fac_id'] = $facilitator_id; 
            $_SESSION['login_time'] = date('H:i:s'); // Store current time

            // Redirect to dashboard after successful login
            header("Location: dash.php");
            exit();
        } else {
            Print '<script>alert("Your password was incorrect!");</script>';
            Print '<script>window.location.assign("index.php");</script>';
        }
    } else {
        Print '<script>alert("Your username was incorrect!");</script>';
        Print '<script>window.location.assign("index.php");</script>';
    }
}


?>