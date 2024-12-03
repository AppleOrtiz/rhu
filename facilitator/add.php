<?php

include ('dashboard.php');
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/addds.css">
	<link rel="stylesheet" href="css/modals.css">
	<link rel="stylesheet" href="css/dashboard.css">
	
</head>
<body>
    
<main class="mt-2 pt-3">
<div class="row">
            <div class="col-md-15 mb-3 ms-4">
            	<div class="card">
                	<div class="card-header">
                    	<span><i class="bi bi-file-earmark-medical"></i> PATIENT HEALTH INFORMATION FORM </div>
               		<div class="card-body">
					   <form id = "form_user" method = "POST" enctype = "multi-part/form-data">
					<div class = "panel panel-default" style = "width:60%; margin:auto;">
					
					<div class="container-fluid"><br>
					<h2><a href="patients.php"  data-bs-toggle="modal" data-bs-target="#exitModal" style="margin-left: 97%;"><i class="bi bi-x-lg"></i></a><h2>

					<!-- Modal -->
						<div class="modal fade" id="exitModal" tabindex="-1" aria-labelledby="exitModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<h6 class="modal-title fs-5" id="exitModalLabel">Are you sure to leave without saving?</h6>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<h6>Click "Yes" if you want to want exit inputting patient information.</h6>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
								<a href="patients.php" class="btn btn-primary">Yes</a>
							</div>
							</div>
						</div>
						</div>
<br>
					<img src="img/naic.png" alt="logo" class="mt-2" style="width:60px; height: 60px; margin-left: 8%; margin-bottom: 25px;">
					<img src="img/log.png" alt="logo" class="mt-2" style="width:60px; height: 60px; margin-left: 70%;  margin-bottom: 25px;">
			
					<center><h4>WIRELESS ACCESS FOR HEALTH <br> PHILIPPINE HEALTH INFORMATION EXCHANGE</h4>
					<p>NAIC RURAL HEALTH UNIT</p></center>
					<div class="row">
					<div class = "form-group">
							<label for = "famno">Family ID NO.: </label>
							<input class = "form-control" type = "text" name = "famno">
						</div>
						<div class = "form-group">
							<label for = "time">Date:* </label>
							<input class = "form-control" type = "date" name = "time" required = "required">
						</div>
					</div>
					<center><h3>PATIENT INFORMATION (IMPORMASYON NG PASYENTE)</h3>
					
					
					<div class="row">
						<div class = "form-group">
							<label for = "lastname">Lastname: (Apelyido)* </label>
							<input class = "form-control" type = "text" name = "lastname" required = "required">
						</div>
						
						<div class = "form-group">
							<label for = "pwd">Person with Disabilities:* </label>
							<select name = "pwd" class = "form-control" required = "required">
								<option value = ""></option>
								<option value = "YES">YES</option>
								<option value = "NO">NO</option>
							</select>
						</div>
						<div class = "form-group">
							<label for = "firstname">Firstname: (Pangalan)* </label>
							<input class = "form-control" type = "text" name = "firstname" required = "required">
						</div>
						
						<div class = "form-group">
							<label for = "indigenous">Indigenous People:* </label>
							<select name = "indigenous" class = "form-control" required = "required">
							<option value = ""></option>
								<option value = "YES">YES</option>
								<option value = "NO">NO</option>
							</select>
						</div>
						<div class = "form-group">
							<label for = "middlename">Middlename: (Gitnang Pangalan)*</label>
							<input class = "form-control" type = "text" name = "middlename" required = "required">
						</div>
						
						<div class = "form-group">
							<label for = "religion">Religion:* </label>
							<input class = "form-control" type = "text" name = "religion" required = "required">
						</div>
                        <div class = "form-group">
							<label for = "suffix">Suffix: (e.g. Jr., Sr., II, III)*</label>
							<input class = "form-control" type = "text" name = "suffix" >
						</div>
						<div class = "form-group">
							<label for = "education">Education:* </label>
							<input class = "form-control" type = "text" name = "education" required = "required">
						</div>
						<div class = "form-group">
							<label for = "gender">Sex: (Kasarian)*</label>
							<select name = "gender" class = "form-control" required = "required">
								<option value = ""></option>
								<option value = "MALE">MALE</option>
								<option value = "FEMALE">FEMALE</option>
							</select>
						</div>
						<div class = "form-group">
							<label for = "occupation">Occupation: </label>
							<input class = "form-control" type = "text" name = "occupation">
						</div>
						<div class = "form-group">
							<label for = "civilstatus">Civil Status:* </label>
							<select name = "civilstatus" class = "form-control" required = "required">
							<option value = ""></option>
								<option value = "SINGLE">SINGLE</option>
								<option value = "MARRIED">MARRIED</option>
								<option value = "SEPARATED">SEPARATED</option>
								<option value = "WIDOWED">WIDOWED</option>
								<option value = "DIVORCED">DIVORCED</option>
								
							</select>
						</div>
						<div class = "form-group">
							<div class="row align-items-center">
							<div class="col">
							<label for = "house_no">House No.:</label>
							<input class = "form-control" type = "text" name = "house_no">
							</div>
							<div class="col">
							<label for = "street_name">Street Name:</label>
							<input class = "form-control" type = "text" name = "street_name">
							</div>
							<div class="col">
							<label for = "barangay">Barangay:* </label>
							<select name = "barangay" class = "form-control"  required = "required">
							<option value = ""></option>
							<option value = "BAGONG KARSADA">Bagong Karsada</option>
								<option value = "BALSAHAN">Balsahan</option>
								<option value = "BAGONG KARSADA">Bagong Karsada</option>
								<option value = "BANCAAN">Bancaan</option>
								<option value = "BUCANA MALAKI">Bucana Malaki</option>
								<option value = "BUCANA SASAHAN">Bucana Sasahan</option>
								<option value = "CALUBCOB">Calubcob</option>
								<option value = "CAPT. C. NAZARENO">Capt. C. Nazareno</option>
								<option value = "GOMEZ-ZAMORA">Gomez - Zamora</option>
								<option value = "HALANG">Halang</option>
								<option value = "HUMBAC">Humbac</option>
								<option value = "IBAYO ESTACION">Ibayo Estacion</option>
								<option value = "IBAYO SILANGAN">Ibayo Silangan</option>
								<option value = "LABAC">Labac</option>
								<option value = "LATORIA">Latoria</option>
								<option value = "MABOLO">Mabolo</option>
								<option value = "MAKINA">Makina</option>
								<option value = "MALAINEN BAGO">Malainen Bago</option>
								<option value = "MALAINEN LUMA">Malainen Luma</option>
								<option value = "MOLINO">Molino</option>
								<option value = "MUNTING MAPINO">Munting Mapino</option>
								<option value = "MUZON">Muzon</option>
								<option value = "PALANGUE 1">Palangue 1</option>
								<option value = "PALANGUE 2 & 3">Palangue 2 & 3</option>
								<option value = "SABANG">Sabang</option>
								<option value = "SAN ROQUE">San Roque</option>
								<option value = "SANTULAN">Santulan</option>
								<option value = "SAPA">Sapa</option>
								<option value = "TIMALAN BALSAHAN">Timalan Balsahan</option>
								<option value = "TIMALAN CONCEPCION">Timalan Concepcion</option>
								
							</select></div>
							</div>
						</div>
                        <div class = "form-group">
							<label for = "birthdate">Birthdate: (Kapanganakan)*</label>
							<input class = "form-control" type = "date" name = "birthdate" required = "required">
						</div>
                        <div class = "form-group">
							<label for = "familyrole">Family Role: </label>
							<select name = "familyrole" class = "form-control"  >
							<option value = ""></option>
								<option value = "HEAD">HEAD</option>
								<option value = "MEMBER">MEMBER</option>
							</select>
						</div>
                        
                        <div class = "form-group">
							<label for = "maidenname">Mother's Maiden Name: (Pangalan ng Ina)</label>
							<input class = "form-control" type = "text" name = "maidenname">
						</div>
						<div class = "form-group">
							<label for = "pin">Pin Number: </label>
							<input class = "form-control" type = "text" placeholder="" name = "pin" >
						</div>
                        <div class = "form-group">
							<label for = "mobileno">Mobile Number:* </label>
							<input class = "form-control" type = "text" name = "mobileno" required = "required">
						</div>
						<div class = "form-group">
							<label for = "memtype">Mem_Type: </label>
							<select name = "memtype" class = "form-control" >
							<option value = ""></option>
								<option value = "MEMBER">MEMBER</option>
								<option value = "DEPENDENT">DEPENDENT</option>
							</select>
						</div>
                        <div class = "form-group">
							<label for = "bloodtype">Blood Type: </label>
							<select name = "bloodtype" class = "form-control" >
							<option value = ""></option>
								<option value = "UNKNOWN">UNKNOWN</option>
								<option value = "A+">A+</option>
								<option value = "O+">O+</option>
								<option value = "B+">B+</option>
								<option value = "AB+">AB+</option>
								<option value = "A-">A-</option>
								<option value = "O-">O-</option>
								<option value = "B-">B-</option>
								<option value = "AB-">AB-</option>
							</select>
						</div>
						<div class = "form-group">
							<label for = "memcat">Mem_Category: </label>
							<input class = "form-control" type = "text" name = "memcat" >
						</div>

                        <div class = "form-group">
							<label for = "cctid">CCT ID/ REG. DATE: </label>
							<input class = "form-control" type = "text" name = "cctid" >
						</div>

						<div class = "form-group">
							<label for = "bp">BP: </label>
							<input class = "form-control" type = "text" name = "bp">
						</div>
                        <div class = "form-group">
							<label for = "weight">Weight: (kg) </label>
							<input class = "form-control" type = "text" name = "weight">
						</div>

                        <div class = "form-group">
							<label for = "height">Height: (cm)</label>
							<input class = "form-control" type = "text" name = "height">
						</div>
						<h5>In case of emergency, please contact:</h5>
						<div class = "form-group">
							<label for = "contactperson">Contact Person: </label>
							<input class = "form-control" type = "text" name = "contactperson" >
						</div>

						<div class = "form-group">
							<label for = "contact">Contact No.: </label>
							<input class = "form-control" type = "text" name = "contact">
						</div>
                        
						<center>
						<h3>PATIENT CONSENT (PAHINTULOT NG PASYENTE)</h3>
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

						<div class="col-12">
    						<div class="form-check">
      							<input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      								<label class="form-check-label" for="invalidCheck">
        								Agree to terms and conditions
      								</label>
      								<div class="invalid-feedback">
        							You must agree before submitting.
      								</div>
    							</div>

								<!-- Button trigger modal -->
								<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Save</button>

								<!-- Modal -->
								<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title fs-5" id="exampleModalLabel">Confirm saving patient info?</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										Click "Save" if you want to save the patient information.
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<button class="btn btn-primary" name ="save_patients">Save</button>
									</div>
									</div>
								</div>
								</div>
								
					</div>	
					<?php require 'add_info.php'?>
					</div>
				</form>			
				</div>
			</div>
</div>
</main>
			<script src="modal.js"></script>
			<script src="js/alert.js"></script>  
</body>
</html>