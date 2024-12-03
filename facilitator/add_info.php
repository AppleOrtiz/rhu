<?php
    if(isset($_POST['save_patients'])){	
        $firstname = $_POST['firstname']; 
        $middlename = $_POST['middlename']; 
        $lastname = $_POST['lastname']; 
        $suffix = $_POST['suffix'];  
        $civilstatus = $_POST['civilstatus']; 
        $birthdate = $_POST['birthdate']; 
        $maidenname= $_POST['maidenname']; 
        $mobileno = $_POST['mobileno']; 
        $bloodtype= $_POST['bloodtype']; 
        $cctid = $_POST['cctid']; 
        $contactperson= $_POST['contactperson']; 
        $pwd = $_POST['pwd']; 
        $indigenous= $_POST['indigenous']; 
        $religion = $_POST['religion']; 
        $education= $_POST['education']; 
        $occupation = $_POST['occupation'];
        $street_name = $_POST['street_name']; 
        $house_no = $_POST['house_no']; 
        $barangay = $_POST['barangay']; 
        $familyrole = $_POST['familyrole'];
        $pin= $_POST['pin']; 
        $memtype= $_POST['memtype'];
        $memcat= $_POST['memcat'];
        $bp = $_POST['bp'];   
        $weight= $_POST['weight']; 
        $height = $_POST['height']; 
        $contact = $_POST['contact']; 
        $gender = $_POST['gender'];
        $time = $_POST['time'];
        $famno = $_POST['famno'];




        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "isrhh");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        else{
            // Insert new user into the database
            $conn->query("INSERT INTO `patient_tbl`( `firstname`, `middlename`, `lastname`, `suffix`, `civilstatus`, `birthdate`, `gender`, `maidenname`, `mobileno`, `bloodtype`, `cctid`, `pwd`, `indigenous`, `contactperson`, `religion`, `education`, `occupation`, `street_name`, `house_no`, `barangay`, `familyrole`, `pin`, `memtype`, `memcat`, `bp`, `weight`, `height`, `contact`, `time`, `famno`) VALUES ('$firstname','$middlename','$lastname','$suffix','$civilstatus','$birthdate','$gender','$maidenname','$mobileno','$bloodtype','$cctid','$pwd','$indigenous','$contactperson','$religion','$education','$occupation','$street_name', '$house_no', '$barangay', '$familyrole','$pin','$memtype','$memcat','$bp','$weight','$height','$contact','$time','$famno')");
        }

        // Close the database connection
        $conn->close();
    }
?>
