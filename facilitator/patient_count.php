<?php
$conn = new mysqli("localhost", "root", "", "isrhh");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the current date
$date = date("Y-m-d");

$query = "SELECT COUNT(*) as count FROM `patient_tbl` WHERE `date_added` = '$date'";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . $conn->error);
}

$fetch = $result->fetch_array();
$new_patient_today = $fetch['count'];
$conn->close();

// Generate data for the chart
$xValues = array('Today'); // assuming you want to display only today's data
$yValues = array($new_patient_today);

// Output the data as JSON
echo json_encode(array('xValues' => $xValues, 'yValues' => $yValues));
?>