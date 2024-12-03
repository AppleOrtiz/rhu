<?php
// archive.php

// Connect to the database
$conn = new mysqli("localhost", "root", "", "isrhh") or die(mysqli_error());

// Check if the pa_id and lastname are set
if (isset($_GET['pa_id']) && isset($_GET['lastname'])) {
  $pa_id = $_GET['pa_id'];
  $lastname = $_GET['lastname'];

  // Retrieve the patient data from patient_tbl
  $query = $conn->query("SELECT * FROM `patient_tbl` WHERE `pa_id` = '$pa_id' AND `lastname` = '$lastname'") or die(mysqli_error());
  $fetch = $query->fetch_array();

  // Insert the patient data into patient_archive
  $insert_query = "INSERT INTO `patient_archive` 
(`pa_id`, `id`, `firstname`, `middlename`, `lastname`, `suffix`, `civilstatus`, `birthdate`, `maidenname`, `mobileno`, `bloodtype`, `cctid`, `contactperson`, `pwd`, `indigenous`, `religion`, `education`, `occupation`, `house_no`, `street_name`, `barangay`, `familyrole`, `pin`, `memtype`, `memcat`, `bp`, `weight`, `height`, `contact`, `gender`, `famno`, `time`, `archived`, `is_active`) 
VALUES 
('$fetch[pa_id]', '$fetch[id]', '$fetch[firstname]', '$fetch[middlename]', '$fetch[lastname]', '$fetch[suffix]', '$fetch[civilstatus]', '$fetch[birthdate]', '$fetch[maidenname]', '$fetch[mobileno]', '$fetch[bloodtype]', '$fetch[cctid]', '$fetch[contactperson]', '$fetch[pwd]', '$fetch[indigenous]', '$fetch[religion]', '$fetch[education]', '$fetch[occupation]', '$fetch[house_no]', '$fetch[street_name]', '$fetch[barangay]', '$fetch[familyrole]', '$fetch[pin]', '$fetch[memtype]', '$fetch[memcat]', '$fetch[bp]', '$fetch[weight]', '$fetch[height]', '$fetch[contact]', '$fetch[gender]', '$fetch[famno]', '$fetch[time]', '$fetch[archived]', '$fetch[is_active]');
";
  $conn->query($insert_query) or die(mysqli_error());

  // Delete the patient data from patient_tbl
  $delete_query = "DELETE FROM `patient_tbl` WHERE `pa_id` = '$pa_id' AND `lastname` = '$lastname'";
  $conn->query($delete_query) or die(mysqli_error());

  // Close the database connection
  $conn->close();

  // Redirect to the original page or display a success message
  header("Location: patients.php"); // replace with the original page URL
  exit;
} else {
  echo "Error: pa_id and lastname are not set.";
}

?>