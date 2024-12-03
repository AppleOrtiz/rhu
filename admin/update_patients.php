<?php
// Check if the form is submitted
if (isset($_POST['update_patient'])) {
    // Get the patient ID from the URL
    $pa_id = $_GET['pa_id'];

    // Get the values from the form
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $suffix = $_POST['suffix'];
    $civiltatus = $_POST['civilstatus'];
    $birthdate = $_POST['birthdate'];
    $maidenname = $_POST['maidenname'];
    $mobileno = $_POST['mobileno'];
    $bloodtype = $_POST['bloodtype'];
    $cctid = $_POST['cctid'];
    $contactperson = $_POST['contactperson'];
    $pwd = $_POST['pwd'];
    $indigenous = $_POST['indigenous'];
    $religion = $_POST['religion'];
    $education = $_POST['education'];
    $occupation = $_POST['occupation'];
    $house_no = $_POST['house_no'];
    $street_name = $_POST['street_name'];
    $barangay = $_POST['barangay'];
    $familyrole = $_POST['familyrole'];
    $pin = $_POST['pin'];
    $memtype = $_POST['memtype'];
    $memcat = $_POST['memcat'];
    $bp = $_POST['bp'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $famno = $_POST['famno'];
    $time = $_POST['time'];

    // Prepare the SQL query
    $sql = "UPDATE patient_tbl SET 
            pa_id = '$pa_id', 
            firstname = '$firstname', 
            middlename = '$middlename', 
            lastname = '$lastname', 
            suffix = '$suffix', 
            civilstatus = '$civiltatus', 
            birthdate = '$birthdate', 
            maidenname = '$maidenname', 
            mobileno = '$mobileno', 
            bloodtype = '$bloodtype', 
            cctid = '$cctid', 
            contactperson = '$contactperson', 
            pwd = '$pwd', 
            indigenous = '$indigenous', 
            religion = '$religion', 
            education = '$education', 
            occupation = '$occupation', 
            house_no = '$house_no', 
            street_name = '$street_name', 
            barangay = '$barangay', 
            familyrole = '$familyrole', 
            pin = '$pin', 
            memtype = '$memtype', 
            memcat = '$memcat', 
            bp = '$bp', 
            weight = '$weight', 
            height = '$height', 
            contact = '$contact', 
            gender = '$gender', 
            famno = '$famno', 
            time = '$time' 
            WHERE pa_id = '$pa_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Patient updated successfully.";
    } else {
        echo "Error updating patient: " . $conn->error;
    }
} else {
    // Handle the case where the form is not submitted
    echo "Form not submitted.";
}
?>