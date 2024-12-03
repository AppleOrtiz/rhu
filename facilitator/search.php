<?php
include 'conn.php';

$search = $_POST['search'];

$stmt = $conn->prepare("SELECT height, weight FROM patient_tbl WHERE name LIKE ?");
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    echo "Error: " . $conn->error;
    exit;
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Height: " . $row['height'] . " cm<br>";
        echo "Weight: " . $row['weight'] . " kg";
    }
} else {
    echo "No patient found with that name.";
}

$stmt->close();
$conn->close();
?>