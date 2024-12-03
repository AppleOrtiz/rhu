<?php
$conn = new mysqli("localhost", "root", "", "isrhh");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['pa_id']) && isset($_GET['lastname'])) {
    $pa_id = $conn->real_escape_string($_GET['pa_id']);
    $lastname = $conn->real_escape_string($_GET['lastname']); // Not used, but sanitized for security
    
    // Start a transaction
    $conn->begin_transaction();

    try {
        // Restore the patient record from archive
        // Ensure both INSERT and SELECT use the same column names
        
        $query = $conn->query("
            INSERT INTO `patient_tbl` 
            (
                `pa_id`, `firstname`, `middlename`, `lastname`, `suffix`, `civilstatus`, `birthdate`, 
                `maidenname`, `mobileno`, `bloodtype`, `cctid`, `contactperson`, `pwd`, `indigenous`, 
                `religion`, `education`, `occupation`, `house_no`, `street_name`, `barangay`, `familyrole`, 
                `pin`, `memtype`, `memcat`, `bp`, `weight`, `height`, `contact`, `gender`, `famno`, 
                `time`, `archived`, `is_active`
            ) 
            SELECT 
                `pa_id`, `firstname`, `middlename`, `lastname`, `suffix`, `civilstatus`, `birthdate`, 
                `maidenname`, `mobileno`, `bloodtype`, `cctid`, `contactperson`, `pwd`, `indigenous`, 
                `religion`, `education`, `occupation`, `house_no`, `street_name`, `barangay`, `familyrole`, 
                `pin`, `memtype`, `memcat`, `bp`, `weight`, `height`, `contact`, `gender`, `famno`, 
                `time`, `archived`, `is_active`
            FROM `patient_archive` 
            WHERE `pa_id` = '$pa_id'
        ");

        if (!$query) {
            throw new Exception("Error restoring patient: " . $conn->error);
        }

        // Delete from the archive after restoring
        $query = $conn->query("DELETE FROM `patient_archive` WHERE `pa_id` = '$pa_id'");
        if (!$query) {
            throw new Exception("Error deleting from archive: " . $conn->error);
        }

        // Commit the transaction
        $conn->commit();

        // Redirect after successful restore
        header('Location: archive.php');
        exit;

    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        die("Error: " . $e->getMessage());
    }
}

$conn->close();
?>
