<?php
require_once 'conn.php';

// Check if the form is submitted
if (isset($_POST['edit_admin'])) {
    // Get the facilitator ID from the URL
    $fac_id = $_POST['fac_id'];

    // Get the values from the form
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Prepare the SQL query
    $sql = "UPDATE facilitator_tbl SET 
            username = '$username', 
            firstname = '$firstname', 
            middlename = '$middlename', 
            lastname = '$lastname', 
            password = '$password', 
            email = '$email' 
            WHERE fac_id = '$fac_id'";

    // Echo the query for debugging purposes
    echo "Query: $sql<br>";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Facilitator updated successfully.<br>";
        echo "Affected rows: " . $conn->affected_rows . "<br>";
    } else {
        echo "Error updating facilitator: " . $conn->error . "<br>";
    }
} else {
    // Handle the case where the form is not submitted
    echo "";
}
?>