<?php
// Include the dashboard and connection files
include 'dashboard.php';
require_once 'conn.php';

// Check if the pa_id is set in the URL
if (isset($_GET['pa_id'])) {
    $pa_id = $_GET['pa_id'];

    // Prepare the SQL query
    $sql = "SELECT * FROM patient_archive WHERE pa_id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("i", $pa_id);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there is a result
    if ($result->num_rows > 0) {
        // Fetch the result
        $row = $result->fetch_assoc();

        // Assign the values to variables
        $id = $row['id'];
		$firstname = $row['firstname'];
		$middlename = $row['middlename'];
		$lastname = $row['lastname'];
		$suffix = $row['suffix'];
		$civiltatus = $row['civilstatus'];
		$birthdate = $row['birthdate'];
		$maidenname = $row['maidenname'];
		$mobileno = $row['mobileno'];
		$bloodtype = $row['bloodtype'];
		$cctid = $row['cctid'];
		$contactperson = $row['contactperson'];
		$pwd = $row['pwd'];
		$indigenous = $row['indigenous'];
		$religion = $row['religion'];
		$education = $row['education'];
		$occupation = $row['occupation'];
		$street_name = $row['street_name'];
		$house_no = $row['house_no'];
		$barangay = $row['barangay'];
		$familyrole = $row['familyrole'];
		$pin = $row['pin'];
		$memtype = $row['memtype'];
		$memcat = $row['memcat'];
		$bp = $row['bp'];
		$weight = $row['weight'];
		$height = $row['height'];
		$contact = $row['contact'];
		$gender = $row['gender'];
		$famno = $row['famno'];
		$time = $row['time'];
    } else {
        // Handle the case where there is no result
        echo "No patient found with the given ID.";
        exit;
    }
} else {
    // Handle the case where the pa_id is not set
    echo "Patient ID is not set.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
     function preventBack(){window.history.forward()};
     setTimeout("preventBack()",0);
     window.onunload=function(){null;}
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/adss.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<main class="mt-2 pt-3">
<body>
    <div class="panel-body">
        <form id="form_user" method="post" enctype="application/x-www-form-urlencoded">
            <div class="panel panel-default" style="width:60%; margin:auto;">
                <div class="container-fluid"><br>
                    <h2><a href="archive.php" style=" margin-top: 20px; margin-left: 820px;"><i class="bi bi-x-lg"></i></a><h2>
                    <br>
                    <img src="img/naic.png" alt="logo" class="mt-3" style="width:60px; height: 60px; margin-right: 70%; margin-bottom: 25px;">
                    <img src="img/log.png" alt ="logo" class="mt-3" style="width:60px; height: 60px; margin-right: 8%; margin-top: 20px; margin-bottom: 25px;">
            
                    <center><h4>WIRELESS ACCESS FOR HEALTH <br> PHILIPPINE HEALTH INFORMATION EXCHANGE</h4>
                    <p>NAIC RURAL HEALTH UNIT</p></center>
                    <div class="row">
                        <div class="row">
                            <div class="form-group">
                                <label for="famno">Family ID NO.: </label>
                                <input class="form-control" type="text" name="famno" value="<?php echo $famno ?>"  readonly>
                            </div>
                            <div class="form-group">
                                <label for="time">Date and Time:* </label>
                                <input class="form-control" type="date" name="time" value="<?php echo $time ?>"  readonly>
                            </div>
                        </div>
                        <center>
                            <h3>PATIENT INFORMATION (IMPORMASYON NG PASYENTE)</h3>
                        </center>
                        
                        <div class="row">
                            <div class="form-group">
                                <label for="lastname">Lastname:* </label>
                                <input class="form-control" type="text" name="lastname" value="<?php echo $lastname ?>" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label for="pwd">Person with Disabilities:* </label>
                                <input class="form-control" type="text" name="pwd" value="<?php echo $pwd ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="firstname">Firstname:* </label>
                                <input class="form-control" type="text" name="firstname" value="<?php echo $firstname ?>" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label for="indigenous">Indigenous People:* </label>
                                <input class="form-control" type="text" name="indigenous" value="<?php echo $indigenous ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="middlename">Middlename:* </label>
                                <input class="form-control" type="text" value="<?php echo $middlename ?>" name="middlename" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label for="religion">Religion:* </label>
                                <input class="form-control" type="text" value="<?php echo $religion ?>" name="religion" readonly>
                            </div>
                            <div class="form-group">
                                <label for="suffix">Suffix:* </label>
                                <input class="form-control" type="text" value="<?php echo $suffix ?>" name="suffix" readonly>
                            </div>
                            <div class="form-group">
                                <label for="education">Education:*  </label>
                                <input class="form-control" type="text" value="<?php echo $education ?>" name="education" readonly>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender:*  </label>
                                <input class="form-control" type="text" value="<?php echo $gender?>" name="gender" readonly>
                            </div>
                            <div class="form-group">
                                <label for="occupation">Occupation: </label>
                                <input class="form-control" type="text" value="<?php echo $occupation ?>" name="occupation" readonly>
                            </div>
                            <div class="form-group">
                                <label for="civilstatus">Civil Status:*  </label>
                                <input class="form-control" type="text" value="<?php echo $civiltatus ?>" name="civilstatus" readonly>
                            </div>
							<div class="form-group">
                            <div class="row align-items-center">
                                <div class="col">
                                    <label for="house_no">House No.:</label>
                                    <input class="form-control" type="text" value="<?php echo $house_no ?>" name="house_no" readonly>
                                </div>
                                <div class="col">
                                    <label for="street_name">Street Name:</label>
                                    <input class="form-control" type="text" value="<?php echo $street_name ?>" name="street_name" readonly>
                                </div>
                                <div class="col">
                                    <label for="barangay">Barangay:* </label>
                                    <input class="form-control" type="text" value="<?php echo $barangay ?>" name="barangay" readonly>
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="birthdate">Birthdate:*  </label>
                                <input class="form-control" type="date" value="<?php echo $birthdate ?>" name="birthdate" readonly>
                            </div>
                            <div class="form-group">
                                <label for="familyrole">Family Role: </label>
                                <input class="form-control" type="text" value="<?php echo $familyrole ?>" name="familyrole" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label for="maidenname">Mother's Maiden Name: </label>
                                <input class="form-control" type="text" value="<?php echo $maidenname ?>" name="maidenname" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pin">Pin Number: </label>
                                <input class="form-control" type="text" value="<?php echo $pin ?>" name="pin" readonly>
                            </div>
                            <div class="form-group">
                                <label for="mobileno">Mobile Number:*  </label>
                                <input class="form-control" type="text" value="<?php echo $mobileno ?>" name="mobileno" readonly>
                            </div>
                            <div class="form-group">
                                <label for="memtype">Mem_Type: </label>
                                <input class="form-control" type="text" value="<?php echo $memtype ?>" name="memtype" readonly>
                            </div>
                            <div class="form-group">
                                <label for="bloodtype">Blood Type: </label>
                                <input class="form-control" type="text" value="<?php echo $bloodtype ?>" name="bloodtype" readonly>
                            </div>
                            <div class="form-group">
                                <label for="memcat">Mem_Category: </label>
                                <input class="form-control" type="text" value="<?php echo $memcat ?>" name="memcat" readonly>
                            </div>

                            <div class="form-group">
                                <label for="cctid">CCT ID/ REG. DATE: </label>
                                <input class="form-control" type="text" value="<?php echo $cctid ?>" name="cctid" readonly>
                            </div>

                            <div class="form-group">
                                <label for="bp">BP: </label>
                                <input class="form-control" type="text" value="<?php echo $bp ?>" name="bp" readonly>
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight: </label>
                                <input class="form-control" type="text" value="<?php echo $weight ?>" name="weight" readonly>
                            </div>

                            <div class="form-group">
                                <label for="height">Height: </label>
                                <input class="form-control" type="text" value="<?php echo $height ?>" name="height" readonly>
                            </div>
                            <div class="form-group">
                                <label for="contactperson">Contact Person: </label>
                                <input class="form-control" type="text" value="<?php echo $contactperson ?>" name="contactperson" readonly>
                            </div>

                            <div class="form-group">
                                <label for="contact">Contact No.: </label>
                                <input class="form-control" type="text" value="<?php echo $contact ?>" name="contact" readonly>
                            </div>
                            
                            <center>
                                <h3>PATIENT'S CONSENT (PAHINTULOT NG PASYENTE)</h3>
                            </center>
                            
						<div class="container text-center">
						<div class="row align-items-start">
						<h5>Ito ay kasulatan na nagbibigay pahintulot sa Naic Rural health Unit na ilagak sa
							 Wirelss Access for Health (WAH) ang aking patient record (ITR). Sa aking paglagda
							  sa kasulatang ito, buong linaw kong nauunawaan at idinedeklara ang mga sumunod:</h5>
						<div class="col">
							 <h5>1. Binigbigyan pahintulot ko ang Naic Rural Health Unit, sa pamamagitan ng pag
							 gamit ng WAH, na itala sa computer at gawing electronic ang aking patient 
							 record sa pang-unawang gagamitin at pangangalagaan ito ng naaayon sa mga 
							 batas at regulasyon itinakda ng estado.</h5>

							 <h5>2. Nauunawan ko na ako ang mananatiling may-ari ng aking patient record at 
								makikita, makahihingi ako ng kopya, at mapapahintulutan ko ang ibang tao na tignan 
							 at gamitin ang aking patient record batay sa mga nakatakdang regulasyon ng 
							 Philippine Health Information Exchange at Philippine Data Privacy Act of 2012.</h5>

							<h5>3. Nauunawaan ko na nilalayon ng Philippine Health Information Exchange na mapadali
							at mapabuti ang pagbibigay ng serbisyong medikal sa mga Pilipino sa papamagitan ng 
							pagkakaroon ng isang centralized database na kung saan lahat ng patient records sa 
							buong bansa ay nakalulan sa isang computer sa pangagalaga ng national na pamaha- laan.
							Naiintindihan ko na ang aking encrypted patient record ay maaring ipadala sa centralized
							database na ito sa pamamagitan ng WAH alinsunod sa alituntunin ng Philippine Health 
							 Information Exchange at iba pang batas ng estado.</h5>
							
							<h5>4. Pinahihintulutan ko rin ang Naic Rural Health Unit na ako ay padalhan ng text messages 
								(SMS) sa aking rehistradong cellphone gamit ang WAH. Nauunawaan ko na ang pagtanggap ko ng
								 mga mensahe ay LIBRE at WALANG kabawasan sa aking load at ang mga mensaheng ito ay mahalaga
								  upang mapaalalahanan ako sa aking mga konsulta, appointment, at mga balita napatutungkol sa 
								  kalusugan ko at ng aking pamilya.</h5>
								  </div>
								  
								  <div class="col">
							<h5>5. Nauuwaan ko na kung sakaling wala akong sariling cellphone, binibigyan pahintulot ko rin 
								ang Naic Rural Health Unit na i-record ang cellphone number ng pinakamalapit kong kamag-anak, 
								kaibigan, o Assigned Personnel na may sakop sa aming district bilang alternatibo o karagdagang 
								cellphone number na maaring gamitin para sa pagpapadala ng mga mensahe para akin. Ito ay bilang
								 tugon sa mga panahon at pagkakataong hindi ko matatanggap ang mga mensahe at ang mga taong ito 
								 ay maari akong paalalahanan batay sa schedule, appointment, or serbisyo sa Naic Rural Health Unit.</h5>

							<h5>6. Nauunawaan ko na sa mga pagkakataon hindi akma para sa akin ang natanggap kong text message, akin 
								dapat itong ipag-bigay alam sa aking Assigned Personnel upang mabigyan ng kaukulang aksyon.</h5>

							<h5>7. Ang mga text messages na matatangap ko ay hindi ko buburahin hanggat hindi ko naipapakita ang
								 message code sa aking Assigned Personnel sa panahonng pagkonsulta sa Health Clinic.</h5>
							
								 <h5>8. Kung nais kong mapawalang bisa ang ano mang nakasaad dito, nababatid kong kinakailangan kong 
									bumalik sa aming Health Clinic upang personal na pirmahan ang Withdrawal of Consent Form.</h5>

                                <br>
                                <br><br>
                                
      								</div>
    							</div>
                            
                        </div>
                    </div>
                </form>            
            </div>
            
           
    </body>
</html>