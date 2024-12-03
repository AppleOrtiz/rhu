<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "isrhh");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set header for JSON response
header('Content-Type: application/json');

// Get the selected barangay and year from the request
$barangay = $_GET['barangay'] ?? '';
$year = $_GET['year'] ?? '';

// Initialize the response data array
$response = [
    'barangay_data' => [],
    'weekly_data' => [],
    'monthly_data' => []
];

// Prepared statement for monthly patient count
if ($year) {
    $queryMonthly = $conn->prepare("
        SELECT MONTH(time) as month, COUNT(*) as count 
        FROM `patient_tbl` 
        WHERE YEAR(time) = ? 
        " . ($barangay ? "AND barangay = ?" : "") . " 
        GROUP BY MONTH(time)
    ");
    
    if ($barangay) {
        $queryMonthly->bind_param("is", $year, $barangay);
    } else {
        $queryMonthly->bind_param("i", $year);
    }
    
    $queryMonthly->execute();
    $resultMonthly = $queryMonthly->get_result();

    while ($row = $resultMonthly->fetch_assoc()) {
        $response['monthly_data'][] = $row;
    }
    $queryMonthly->close();
}

// Prepared statement for barangay patient count
if ($barangay) {
    $queryBarangay = $conn->prepare("
        SELECT barangay, COUNT(*) as count 
        FROM `patient_tbl` 
        WHERE barangay = ? 
        GROUP BY barangay
    ");
    $queryBarangay->bind_param("s", $barangay);
    $queryBarangay->execute();
    $resultBarangay = $queryBarangay->get_result();

    while ($row = $resultBarangay->fetch_assoc()) {
        $response['barangay_data'][] = $row;
    }
    $queryBarangay->close();
}

// Prepared statement for weekly patient count
if ($year && $barangay) {
    $queryWeekly = $conn->prepare("
        SELECT DAYOFWEEK(time) as day, COUNT(*) as count 
        FROM `patient_tbl` 
        WHERE barangay = ? AND YEAR(time) = ? 
        GROUP BY DAYOFWEEK(time)
    ");
    $queryWeekly->bind_param("si", $barangay, $year);
    $queryWeekly->execute();
    $resultWeekly = $queryWeekly->get_result();

    $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    while ($row = $resultWeekly->fetch_assoc()) {
        $row['day'] = $daysOfWeek[$row['day'] - 1]; // Adjust index for array
        $response['weekly_data'][] = $row;
    }
    $queryWeekly->close();
}

// Close the database connection
$conn->close();

// Output the data in JSON format
echo json_encode($response);
?>
