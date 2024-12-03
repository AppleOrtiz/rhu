<?php
require_once 'conn.php';


if (isset($_POST['edit_ad'])) {
    
    $id = $_POST['id'];

    // Get the values from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    
    $sql = "UPDATE `admin_tbl` SET `username`='$username',`password`='$password',`email`='$email' WHERE `id` = '$id'";

   
    echo "Query: $sql<br>";

   
    if ($conn->query($sql) === TRUE) {
        echo "ADMINISTRATOR updated successfully.<br>";
        echo "Affected rows: " . $conn->affected_rows . "<br>";
    } else {
        echo "Error updating facilitator: " . $conn->error . "<br>";
    }
} else {
   
    echo "";
}
?>