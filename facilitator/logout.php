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

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']; // Keep this single assignment
    $facilitator_id = $_SESSION['fac_id'];

    date_default_timezone_set('Asia/Manila'); 

    // Time IN and Out 
    $login_time = $_SESSION['login_time'];
    $logout_time = date('H:i:s');
    $currentDate = date('Y-m-d');
 
    // Create DateTime objects
    $login = new DateTime($login_time);
    $logout = new DateTime($logout_time);

    // Calculate the difference
    $interval = $login->diff($logout);

    // Work Hours
    $workhours = $interval->format('%h Hours %i Minutes');

    // Insert query
    $timlogquery = mysqli_query($conn, "INSERT INTO `time_log`(`In`, `Out`, `date`, `work_hours`, `fac_id`) VALUES ('$login_time','$logout_time','$currentDate','$workhours','$facilitator_id')");

    // Check if the query was successful
    if ($timlogquery) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error SQL: " . mysqli_error($conn); // Display SQL error
        exit();
    }
}
?>
