<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=file.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");

	require_once 'conn.php';
	
	$output = "";
	
	$output .="
		<table>
			<thead>
				<tr>
					<th>MIDDLE NAME</th>
					<th>fIRST NAME</th>
					<th>LASTNAME</th>
                    <th>SUFFIX</th>
                    <th>GENDER</th>
                    <th>CIVIL STATUS</th>
                    <th>BIRTH DATE</th>
                    <th>MOTHER'S MAIDEN NAME</th>
                    <th>MOBILE NO.</th>
                    <th>BLOOD TYPE</th>
                    <th>CCT ID</th>
                    <th>PWD</th>
                    <th>INDIGENOUS PEOPLE</th>
                    <th>RELIGION</th>
                    <th>EDUCATIONAL ATTAINMENT</th>
                    <th>OCCUPATION</th>
                    <th>HOUSE NO.</th>
                    <th>STREET NAME/ SUBD NAME</th>
                    <th>BARANAGAY</th>
                    <th>FAMILY ROLE</th>
                    <th>PIN NO.</th>
                    <th>MEM. TYPE</th>
                    <th>MEM. CATEGORY</th>
                    <th>BLOOD PRESSURE</th>
                    <th>WEIGHT</th>
                    <th>HEIGHT</th>
                    <th>CONTACT PERSON</th>
                    <th>CONTACT NO.</th>
				</tr>
			<tbody>
	";
	
	$query = $conn->query("SELECT * FROM `patient_tbl`") or die(mysqli_errno());
	while($fetch = $query->fetch_array()){
		
	$output .= "
				<tr>
					<td>".$fetch['middlename']."</td>
                    <td>".$fetch['firstname']."</td>
					<td>".$fetch['lastname']."</td>
                    <td>".$fetch['suffix']."</td>
                    <td>".$fetch['gender']."</td>
                    <td>".$fetch['civilstatus']."</td>
                    <td>".$fetch['birthdate']."</td>
                    <td>".$fetch['maidenname']."</td>
                    <td>".$fetch['mobileno']."</td>
                    <td>".$fetch['bloodtype']."</td>
                    <td>".$fetch['cctid']."</td>
                    <td>".$fetch['pwd']."</td>
                    <td>".$fetch['indigenous']."</td>
                    <td>".$fetch['religion']."</td>
                    <td>".$fetch['education']."</td>
                    <td>".$fetch['occupation']."</td>
                    <td>".$fetch['house_no']."</td>
                    <td>".$fetch['street_name']."</td>
                    <td>".$fetch['barangay']."</td>
                    <td>".$fetch['familyrole']."</td>
                    <td>".$fetch['pin']."</td>
                    <td>".$fetch['memtype']."</td>
                    <td>".$fetch['memcat']."</td>
                    <td>".$fetch['bp']."</td>
                    <td>".$fetch['weight']."</td>
                    <td>".$fetch['height']."</td>
                    <td>".$fetch['contactperson']."</td>
                    <td>".$fetch['contact']."</td>
                    

				</tr>
	";
	}
	
	$output .="
			</tbody>
			
		</table>
	";
	
	echo $output;
	
	
?>