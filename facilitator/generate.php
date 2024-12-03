<?php
require_once('fpdf/fpdf.php');
require_once("conn.php");

$pa_id = $_GET['pa_id'];

// Check if connection succeeded
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Fetch data from the database
$query = "SELECT * FROM patient_tbl WHERE `pa_id` = '$pa_id'";
$result = $conn->query($query);
$data = $result->fetch_all(MYSQLI_ASSOC);

// Create a new PDF object
$pdf = new FPDF('P', 'mm', "Legal" );
$pdf->AddPage();

// Load the logo image
$pdf->Image('img/naic.png', 23, 10, 15, 15);
$pdf->Image('img/log.png', 178, 10, 15, 15);

// Title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 6, 'WIRELESS ACCESS FOR HEALTH', 0, 1, 'C');
$pdf->Cell(0, 6, 'PHILIPPINE HEALTH INFORMATION EXCHANGE', 0, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 6, 'NAIC RURAL HEALTH UNIT', 0, 1, 'C');



foreach ($data as $row) {
    $pdf->SetFont('Arial', '', 9);
    // Define column width
    $columnWidth = 100; // Adjust width as necessary

    // Set column widths
    $spacing = 10; // Spacing between columns

    // Output the first column
    $pdf->Cell($columnWidth, 5, 'Family ID No.: ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 5, 'Date:* ' , 0, 1, 'L');

    $pdf->Cell(90, 6, ($row['famno'] ?? ''), 1, 0, 'L',false);
    $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
    $pdf->Cell(95, 6, ($row['time'] ?? ''), 1, 1, 'L',false);
    $pdf->Ln(2); // Add a line break between points

    
}

$pdf->SetFont('Arial', 'B', 11);
$pdf->SetFillColor(0, 0, 0); // Black background
$pdf->SetTextColor(255); // White text
$pdf->Cell(0, 5, 'PATIENT INFORMATION (IMPORMASYON NG PASYENTE)', 0, 1, 'C', true);
$pdf->SetTextColor(0); // Reset text color to black
$pdf->Ln(1); // Add a line break between points

// Patient Information Section
$pdf->SetFont('Arial', '', 9);

foreach ($data as $row) {
    // Define column width
    $columnWidth = 100; // Adjust width as necessary
    
    // Set column widths
    $spacing = 10; // Spacing between columns

    // Output the first column
    $pdf->Cell($columnWidth, 6, 'Lastname: (Apelyido)* ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'Person with Disabilities: ' , 0, 1, 'L');

        // form-control
        $pdf->Cell(90, 6, ($row['lastname'] ?? ''), 1, 0, 'L',false);
        $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
        $pdf->Cell(95, 6, ($row['pwd'] ?? ''), 1, 1, 'L',false);

    $pdf->Cell($columnWidth, 6, 'Firstname: (Pangalan)* ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'Indigenous People: ' , 0, 1, 'L');

        // form-control
        $pdf->Cell(90, 6, ($row['firstname'] ?? ''), 1, 0, 'L',false);
        $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
        $pdf->Cell(95, 6, ($row['indigenous'] ?? ''), 1, 1, 'L',false);
    
    $pdf->Cell($columnWidth, 6, 'Middlename: (Gitnang Pangalan)*	' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'Religion: ' , 0, 1, 'L');

        // form-control
        $pdf->Cell(90, 6, ($row['middlename'] ?? ''), 1, 0, 'L',false);
        $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
        $pdf->Cell(95, 6, ($row['religion'] ?? ''), 1, 1, 'L',false);
    
    $pdf->Cell($columnWidth, 6, 'Suffix: (e.g. Jr., Sr., II, III) ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'Education:* ' , 0, 1, 'L');
    
        // form-control
        $pdf->Cell(90, 6, ($row['suffix'] ?? ''), 1, 0, 'L',false);
        $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
        $pdf->Cell(95, 6, ($row['education'] ?? ''), 1, 1, 'L',false);

    $pdf->Cell($columnWidth, 6, 'Sex: (Kasarian)* ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'Occupation: ' , 0, 1, 'L');

         // form-control
         $pdf->Cell(90, 6, ($row['gender'] ?? ''), 1, 0, 'L',false);
         $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
         $pdf->Cell(95, 6, ($row['occupation'] ?? ''), 1, 1, 'L',false);
    
    $pdf->Cell($columnWidth, 6, 'Civil Status:* ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'House No.:*             Street Name:            Barangay:*' , 0, 1, 'L');
    $pdf->Cell(90, 6, ($row['civilstatus'] ?? ''), 1, 0, 'L',false);
    $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
   
    //sa address!!
   
    $spacing =  4; // Spacing between columns
    $pdf->Cell(24, 6, ($row['house_no'] ?? ''), 1, 0, 'C',false);
    $pdf->Cell($spacing, 10, '', ); // Empty cell for spacing

        // form-control
        $pdf->Cell(26, 6, ($row['street_name'] ?? ''), 1, 0, 'C',false);
        $pdf->Cell($spacing, 5, '', ); // Empty cell for spacing
        $pdf->Cell(37, 6, ($row['barangay'] ?? ''), 1, 1, 'C',false);
        
    $spacing = 10; // Spacing between columns
    $pdf->Cell($columnWidth, 6, 'Birthdate: (Kapanganakan)* ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'Family Role: ' , 0, 1, 'L');

         // form-control
         $pdf->Cell(90, 6, ($row['birthdate'] ?? ''), 1, 0, 'L',false);
         $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
         $pdf->Cell(95, 6, ($row['familyrole'] ?? ''), 1, 1, 'L',false);
    
    $pdf->Cell($columnWidth, 6, 'Mothers Maiden Name: (Pangalan ng Ina) ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'Pin Number: ' , 0, 1, 'L');
    
         // form-control
         $pdf->Cell(90, 6, ($row['maidenname'] ?? ''), 1, 0, 'L',false);
         $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
         $pdf->Cell(95, 6, ($row['pin'] ?? ''), 1, 1, 'L',false);

    $pdf->Cell($columnWidth, 6, 'Mobile Number:: ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'Mem_Type: ', 0, 1, 'L');

          // form-control
          $pdf->Cell(90, 6, ($row['mobileno'] ?? ''), 1, 0, 'L',false);
          $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
          $pdf->Cell(95, 6, ($row['memtype'] ?? ''), 1, 1, 'L',false);
    
    $pdf->Cell($columnWidth, 6, 'Blood Type:* '  , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'Mem_Category: ' , 0, 1, 'L');

          // form-control
          $pdf->Cell(90, 6, ($row['bloodtype'] ?? ''), 1, 0, 'L',false);
          $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
          $pdf->Cell(95, 6, ($row['memcat'] ?? ''), 1, 1, 'L',false);
    
    $pdf->Cell($columnWidth, 6, 'CCT ID/ REG. DATE: ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'BP: ' , 0, 1, 'L');
    
          // form-control
          $pdf->Cell(90, 6, ($row['cctid'] ?? ''), 1, 0, 'L',false);
          $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
          $pdf->Cell(95, 6, ($row['bp'] ?? ''), 1, 1, 'L',false);

    $pdf->Cell($columnWidth, 6, 'Weight: ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'Height: ' , 0, 1, 'L');

          // form-control
          $pdf->Cell(90, 6, ($row['weight'] ?? ''), 1, 0, 'L',false);
          $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
          $pdf->Cell(95, 6, ($row['height'] ?? ''), 1, 1, 'L',false);

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell($columnWidth, 5,  'In case of emergency, please contact:', 0, 1, 'L');
    
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell($columnWidth, 6, 'Contact Person: ' , 0, 0, 'L');
    $pdf->Cell($columnWidth, 6, 'Contact No.: ' , 0, 1, 'L');

          // form-control
          $pdf->Cell(90, 6, ($row['contactperson'] ?? ''), 1, 0, 'L',false);
          $pdf->Cell($spacing, 20, '', 0); // Empty cell for spacing
          $pdf->Cell(95, 6, ($row['contact'] ?? ''), 1, 1, 'L',false);
    
          $pdf->Ln(2); // Add a line break between points
}


// Patient Consent Section
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetFillColor(0, 0, 0); // Black background
$pdf->SetTextColor(255); // White text
$pdf->Cell(0, 5, 'PATIENT CONSENT (PAHINTULOT NG PASYENTE)', 0, 1, 'C', true);

$pdf->SetFont('Arial', '', 8);
$pdf->SetTextColor(0); // Reset text color to black
$pdf->MultiCell(0, 5, "Ito ay kasulatan na nagbibigay pahintulot sa Naic Rural Health Unit na ilagak sa Wireless Access for Health (WAH) ang aking patient record (ITR). Sa aking pag-lagda sa kasulatang ito, buong linaw kong nauunawaan at idinedeklara ang mga sumunod:", 0, 'L');


// Create an array of points for the columns
$points = [
    "1. Binigbigyan pahintulot ko ang Naic Rural Health Unit, sa pamamagitan ng pag gamit ng WAH, na itala sa computer at gawing electronic ang aking patient record sa pang-unawang gagarnitin at pangangalagaan ito ng naaayon sa mga batas at regulasyon itinakda ng estado.",
    "2. Nauunawaan ko na ako ang mananatiling may-ari ng aking patient record at makikita, makahihingi ako ng kopya, at mapapahintulutan ko ang ibang tao na tignan at gamitin ang aking patient record batay sa mga nakatakdang regulasyon ng Philippine Health Information Exchange at Philippine Data Privacy Act of 2012.",
    "3. Nauunawaan ko na nilalayon ng Philippine Health Information Exchange na mapadali at mapabuti ang pagbibigay ng serbisyong medikal sa mga Pilipino sa pamamagitan ng pagkakaroon ng isang centralized database na kung saan lahat ng patient records sa buong bansa ay nakalulan sa isang computer sa pangangalaga ng national na pamahalaan. Naiintindihan ko na ang aking encrypted patient record ay maaaring ipadala sa centralized database na ito sa pamamagitan ng WAH alinsunod sa alituntunin ng Philippine Health Information Exchange at iba pang batas ng estado.",
    "5. Nauuwaan ko na kung sakaling wala akong sariling cellphone, binibigyan pahintulot ko rin ang Naic Rural Health Unit na i-record ang cellphone number ng pinakamalapit kong kamag-anak, kaibigan, o Assigned Personnel na may sakop sa aming district bilang alternatibo o karagdagang cellphone number na maaring gamitin para sa pagpapa-dala ng mga mensahe para akin. Ito ay bilang tugon-se-mga panahon at pagkakataong hindi ko matatanggap ang mga mensahe at ang mga taong ito ay maari akong paalalahanan batay sa schedule, appointment, or serbisyo sa Naic Rural Health Unit. 

6. Nauunawaan ko na sa mga pagkakataon hindi akma para sa akin ang natanggap kong text message, akin dapat itong ipag-bigay alam sa aking Assigned Personnel upang mabigyan ng kaukulang aksyon.   
7. Ang mga text messages na matatangap ko ay hindi ko buburahin hanggat hindi ko naipapakita ang message code sa aking Assigned Personnel sa panahonng pagkonsulta sa Health Clinic.

8. Kung nais kong mapawalang bisa ang ano mang nakasaad dito, nababatid kong kinakailangan kong bumalik sa aming Health Clinic upang personal na pirmahan ang Withdrawal of Consent Form.",
"4. Pinahihintulutan ko rin ang Naic Rural Health Unit na ako ay padalhan ng text messages (SMS) sa aking rehistradong cellphone gamit ang WAH. Nauunawaan ko na ang pagtanggap ko ng mga mensahe ay LIBRE at WALANG kabawasan sa aking load at ang mga mensaheng ito ay mahalaga upang mapaalalahanan ako sa aking mga konsulta, appointment, at mga balita patungkol sa kalusugan ko at ng aking pamilya.",
];

// Set the column width and height
$columnWidth = 90;
$lineHeight = 3.9;

// Calculate the number of points
$totalPoints = count($points);
$halfPoints = ceil($totalPoints / 2); // To split the points into two columns

// Loop through the first half of the points for the left column
foreach (array_slice($points, 0, $halfPoints) as $point) {
    $pdf->MultiCell($columnWidth, $lineHeight, $point, 0, 'J');
    $pdf->Ln(2.3); // Add a line break between points
}

// Move to the right column
$pdf->SetXY($pdf->GetX() + $columnWidth + 10, $pdf->GetY() - ($halfPoints * ($lineHeight + 22.8))); // Adjust Y position

// Loop through the second half of the points for the right column
foreach (array_slice($points, $halfPoints) as $point) {
    $pdf->MultiCell($columnWidth, $lineHeight, $point, 0, 'J');
    $pdf->Ln(0); // Add a line break between points
}

// Output the PDF document
$pdf->Output();
$conn->close();
?>
