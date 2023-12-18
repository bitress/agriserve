<?php
use setasign\Fpdi\Fpdi;

include_once __DIR__. '/vendor/autoload.php';
include_once 'init.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];


    $farmer_obj = new Farmers();
    $row = $farmer_obj->fetchFarmerById($id);

    $addressComponents = explode(', ', $row['address']);
    $placeOfBirthComponents = explode(', ', $row['place_of_birth']);


    $farmer = array(
        "firstname" => $row['firstname'],
        "middlename" => $row['middlename'],
        "surname" => $row['surname'],
        "extension_name" => $row['extension_name'],
        "sex" => $row['sex'],
        "mobile_number" => $row['mobile_number'],
        "date_of_birth" => $row['date_of_birth'],
        "place_of_birth" => $row['place_of_birth'],
        "religion" => $row['religion'],
        "civil_status" => $row['civil_status'],
        "highest_formal_education" => $row['highest_formal_education'],
        "mother_maiden_name" => $row['mother_maiden_name'],
        "spouse_name" => $row['spouse_name'],
        "is_pwd" => $row['is_pwd'],
        "is_4ps" => $row['is_4ps'],
        "is_ip" => $row['is_ip'],
        "has_government_id" => $row['has_government_id'],
        "government_id_type" => $row['government_id_type'],
        "government_id_number" => $row['government_id_number'],
        "is_associated" => $row['is_associated'],
        "association_name" => $row['association_name'],
        "is_household_head" => $row['is_household_head'],
        "household_head_name" => $row['household_head_name'],
        "household_head_relationship" => $row['household_head_relationship'],
        "living_household_members" => $row['living_household_members'],
        "no_of_female" => $row['no_of_female'],
        "no_of_male" => $row['no_of_male'],
        "emergency_contact_name" => $row['emergency_contact_name'],
        "emergency_contact_number" => $row['emergency_contact_number']
    );


} else {
    header("Location: index.php");
}

function addLetterSpacing($text, $spacing) {
    $result = '';
    $length = strlen($text);

    for ($i = 0; $i < $length; $i++) {
        $result .= $text[$i];
        // Add spaces if not the last character
        if ($i < $length - 1) {
            for ($j = 0; $j < $spacing; $j++) {
                $result .= ' ';
            }
        }
    }

    return $result;
}


function formatDateFormat($inputDate)
{
    // Convert the input date string to a DateTime object
    $dateTime = new DateTime($inputDate);

    // Format the date as 'mdY'
    $formattedDate = $dateTime->format('mdY');

    return $formattedDate;
}




$pdf = new Fpdi();

// add a page
$pdf->AddPage('P', 'Legal');
$pdf->setSourceFile('RSBSA.pdf');
$tplIdx = $pdf->importPage(1);
$size = $pdf->getTemplateSize($tplIdx);
$pdf->useTemplate($tplIdx, 0, 0, 215, 350);
$pdf->SetFont('Arial');
$pdf->SetXY(30, 71);
$pdf->setFontSize(9);
$pdf->Write(0, $farmer['surname']); // Surname

$pdf->SetFont('Helvetica');
$pdf->SetXY(120, 71);
$pdf->setFontSize(9);
$pdf->Write(0, $farmer['firstname']); // First Name

$pdf->SetFont('Arial');
$pdf->SetXY(30, 81);
$pdf->setFontSize(9);
$pdf->Write(0, $farmer['middlename']); // Middle Name

$pdf->SetFont('Arial');
$pdf->SetXY(108, 81);
$pdf->setFontSize(9);
$pdf->Write(0, $farmer['extension_name']); // Extension Name

$pdf->SetFont('Arial');
$pdf->SetXY(165, 83);
$pdf->setFontSize(9);
$pdf->Write(0, ($farmer['sex'] == 'Male') ? '/' : ''); // Is female

$pdf->SetFont('Arial');
$pdf->SetXY(182, 83);
$pdf->setFontSize(9);
$pdf->Write(0, ($farmer['sex'] == 'Female') ? '/' : ''); // Is male
$pdf->SetFont('Arial');
$pdf->SetXY(28, 93);
$pdf->setFontSize(9);
$pdf->Write(0, $addressComponents[0]); // House number

$pdf->SetFont('Arial');
$pdf->SetXY(88, 93);
$pdf->setFontSize(9);
$pdf->Write(0, $addressComponents[1]); // Street

$pdf->SetFont('Arial');
$pdf->SetXY(145, 93);
$pdf->setFontSize(9);
$pdf->Write(0, $addressComponents[2]); // Barangay

$pdf->SetFont('Arial');
$pdf->SetXY(28, 103);
$pdf->setFontSize(9);
$pdf->Write(0, $addressComponents[3]); // City/town

$pdf->SetFont('Arial');
$pdf->SetXY(88, 103);
$pdf->setFontSize(9);
$pdf->Write(0, $addressComponents[4]); // Province


$pdf->SetFont('Arial');
$pdf->SetXY(145, 103);
$pdf->setFontSize(9);
$pdf->Write(0, '');

$pdf->SetFont('Arial');
$pdf->SetXY(11, 117);
$pdf->setFontSize(9);
$pdf->Write(0, addLetterSpacing($farmer['mobile_number'], 1.5));

$pdf->SetFont('Arial');
$pdf->SetXY(114, 119);
$pdf->setFontSize(9);
$pdf->Write(0, ($farmer['highest_formal_education'] === 'preschool') ? '/' : ''); // Pre-school

$pdf->SetFont('Arial');
$pdf->SetXY(145, 119);
$pdf->setFontSize(9);
$pdf->Write(0, ($farmer['highest_formal_education'] === 'high_school') ? '/' : ''); // JHS (K-12)

$pdf->SetFont('Arial');
$pdf->SetXY(180, 119);
$pdf->setFontSize(9);
$pdf->Write(0, ($farmer['highest_formal_education'] === 'high_school') ? '/' : ''); // Vocational

$pdf->SetFont('Arial');
$pdf->SetXY(114, 124);
$pdf->setFontSize(9);
$pdf->Write(0, ($farmer['highest_formal_education'] === 'elementary') ? '/' : ''); // Elementary

$pdf->SetFont('Arial');
$pdf->SetXY(145, 124);
$pdf->setFontSize(9);
$pdf->Write(0, ($farmer['highest_formal_education'] === 'high_school') ? '/' : ''); // SHS (K-12)

$pdf->SetFont('Arial');
$pdf->SetXY(180, 124);
$pdf->setFontSize(9);
$pdf->Write(0, ($farmer['highest_formal_education'] === 'high_school') ? '/' : ''); // Post-graduate

$pdf->SetFont('Arial');
$pdf->SetXY(114, 129);
$pdf->setFontSize(9);
$pdf->Write(0, ($farmer['highest_formal_education'] === 'high_school') ? '/' : ''); // High school

$pdf->SetFont('Arial');
$pdf->SetXY(145, 129);
$pdf->setFontSize(9);
$pdf->Write(0, ($farmer['highest_formal_education'] === 'bachelors_degree') ? '/' : ''); // College

$pdf->SetFont('Arial');
$pdf->SetXY(180, 129);
$pdf->setFontSize(9);
$pdf->Write(0, ($farmer['highest_formal_education'] === 'other') ? '/' : ''); // None


$pdf->SetXY(10, 129);
$pdf->setFontSize(9);
$pdf->Write(0, addLetterSpacing(formatDateFormat($farmer['date_of_birth']), 3.3));

$pdf->SetFont('Arial');
$pdf->SetXY(60, 127);
$pdf->setFontSize(8);
$pdf->Write(0, $placeOfBirthComponents[0]); // Town

$pdf->SetXY(60, 132);
$pdf->setFontSize(8);
$pdf->Write(0, $placeOfBirthComponents[1]); // Province


$pdf->SetXY(78, 132);
$pdf->setFontSize(8);
$pdf->Write(0, "Philippines");

$pdf->SetXY(27, 143);
$pdf->setFontSize(8);
$pdf->Write(0, ($farmer['religion'] == 'Christianity') ? '/' : ''); // Christianity

$pdf->SetXY(49, 143);
$pdf->setFontSize(8);
$pdf->Write(0, ($farmer['religion'] == 'Islam') ? '/' : ''); // Islam

$pdf->SetXY(62, 143);
$pdf->setFontSize(8);
$pdf->Write(0, ($farmer['religion'] != 'Others') ? '/' : ''); // Others

if ($farmer['religion'] != 'Others') {
    $pdf->SetXY(84, 143);
    $pdf->setFontSize(7);
    $pdf->Write(0, $farmer['religion']);
}



$pdf->SetXY(33, 150);
$pdf->setFontSize(7);
$pdf->Write(0, ($farmer['civil_status'] == 'Single') ? '/' : '');  // Single

$pdf->SetXY(50, 150);
$pdf->setFontSize(7);
$pdf->Write(0, ($farmer['civil_status'] == 'Married') ? '/' : ''); // Married

$pdf->SetXY(67, 150);
$pdf->setFontSize(7);
$pdf->Write(0, ($farmer['civil_status'] == 'Widowed') ? '/' : ''); // Widowed

$pdf->SetXY(87, 150);
$pdf->setFontSize(7);
$pdf->Write(0, ($farmer['civil_status'] == 'Separated') ? '/' : ''); // Separated

if ($farmer['civil_status'] == 'Married') {
    $pdf->SetXY(33, 160);
    $pdf->setFontSize(8);
    $pdf->Write(0, $farmer['spouse_name']); // Display spouse name
}





$pdf->SetXY(33, 170);
$pdf->setFontSize(8);
$pdf->Write(0, $farmer['mother_maiden_name']);



$pdf->SetXY(49, 178);
$pdf->setFontSize(8);
$pdf->Write(0, "/");


$pdf->SetXY(64, 178);
$pdf->setFontSize(8);
$pdf->Write(0, "/");

$pdf->SetXY(50, 185);
$pdf->setFontSize(8);
$pdf->Write(0, "Name of the household head");


$pdf->SetXY(50, 192);
$pdf->setFontSize(8);
$pdf->Write(0, "Relationship household head");


$pdf->SetXY(54, 199);
$pdf->setFontSize(8);
$pdf->Write(0, "1"); // living household members


$pdf->SetXY(29, 206);
$pdf->setFontSize(8);
$pdf->Write(0, "1"); // no. of male household members


$pdf->SetXY(82, 206);
$pdf->setFontSize(8);
$pdf->Write(0, "1"); // no. of female household members



$pdf->SetXY(163, 136);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // is_pwd yes

$pdf->SetXY(179, 136);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // is_pwd no


$pdf->SetXY(163, 145);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // is_4ps yes

$pdf->SetXY(178, 145);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // is_4ps no

$pdf->SetXY(163, 151);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // is_ip yes

$pdf->SetXY(178, 151);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // is_ip no


$pdf->SetXY(128, 157);
$pdf->setFontSize(8);
$pdf->Write(0, "HAHAHAHA"); // if is_ip what?


$pdf->SetXY(143, 165);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // has government ID?   yes


$pdf->SetXY(159, 165);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // has government ID?   no


$pdf->SetXY(143, 169);
$pdf->setFontSize(8);
$pdf->Write(0, "National ID"); // if it has government ID, what id type


$pdf->SetXY(143, 174);
$pdf->setFontSize(8);
$pdf->Write(0, "27318937129371289"); // if it has government ID, what id number

$pdf->SetXY(181, 180);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // is farmer associated? yes

$pdf->SetXY(194, 180);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // is farmer associated? no

$pdf->SetXY(128, 187);
$pdf->setFontSize(8);
$pdf->Write(0, "HAHHAHAHA"); // if it is farmer associated? what

$pdf->SetXY(140, 197);
$pdf->setFontSize(8);
$pdf->Write(0, "HAHHAHAHA"); // emergency contact name



$pdf->SetXY(45, 218);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // main livelihood (farmer)



$pdf->SetXY(12, 237);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // is farming rice?


$pdf->SetXY(12, 243);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // is farming corn?


$pdf->SetXY(12, 250);
$pdf->setFontSize(8);
$pdf->Write(0, "/"); // is farming others?

$pdf->SetXY(35, 254);
$pdf->setFontSize(8);
$pdf->Write(0, "Butil ng Saging"); // if farming others? what is it?




$pdf->SetXY(140, 205);
$pdf->setFontSize(11);
$pdf->Write(0, addLetterSpacing("09123456789", 2.5)); // emergency contact name




$pdf->AddPage('P', 'Legal');

$tplId2 = $pdf->importPage(2);
$size = $pdf->getTemplateSize($tplId2);
$pdf->useTemplate($tplId2, 0, 0, 215, 350);




$sql = "SELECT * FROM farmer_land_info LEFT JOIN ownership_document_type ON ownership_document_type.ownership_document_type_id = farmer_land_info.ownership_document_number LEFT JOIN cultivated_plants ON cultivated_plants.land_id = farmer_land_info.farmer_land_id LEFT JOIN crops ON crops.crop_id = cultivated_plants.crop_id WHERE farmer_land_info.farmer_id = {$id} LIMIT 3";
$stmt = $db->prepare($sql);
if ($stmt->execute()){
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    $yCoordinates = ($count == 1) ? [40] : (($count == 2) ? [40, 82] : [40, 82, 123]);

    foreach ($row as $index => $res) {
        $y = $yCoordinates[$index];


        $farm_location = explode(', ', $res['location']);


            $pdf->SetXY(50, $y);
            $pdf->setFontSize(8);
            $pdf->Write(0, $farm_location[0]);

            $pdf->SetXY(50, $y + 5);
            $pdf->setFontSize(8);
            $pdf->Write(0, $farm_location[1] ?? '');

            $pdf->SetXY(50, $y + 10);
            $pdf->setFontSize(7);
            $pdf->Write(0, $res['land_area']); // hectares
        $pdf->SetXY(50, $y + 19);
        $pdf->setFontSize(7);
        $pdf->Write(0, $res['ownership_document_number']); // ownership document no.

        $pdf->SetXY(64, $y + 15);
        $pdf->setFontSize(7);
        $pdf->Write(0, ($res['within_ancestral_domain'] == 'Yes') ? '/' : ''); // within ancestral domain, Yes

        $pdf->SetXY(79, $y + 15);
        $pdf->setFontSize(7);
        $pdf->Write(0, ($res['within_ancestral_domain'] == 'No') ? '/' : ''); // within ancestral domain, No

        $pdf->SetXY(64, $y + 22);
        $pdf->setFontSize(7);
        $pdf->Write(0, ($res['agrarian_reform_beneficiary'] == 'Yes') ? '/' : ''); // agrarian reform , Yes

        $pdf->SetXY(79, $y + 22);
        $pdf->setFontSize(7);
        $pdf->Write(0, ($res['agrarian_reform_beneficiary'] == 'No') ? '/' : ''); // agrarian reform, No

        $pdf->SetXY(22, $y + 29);
        $pdf->setFontSize(7);
        $pdf->Write(0, ($res['ownership_type'] == 'Registered Owner') ? '/' : ''); // ownership type, owner

        $pdf->SetXY(52, $y + 29);
        $pdf->setFontSize(7);
        $pdf->Write(0, ($res['ownership_type'] == 'others') ? '/' : ''); // ownership type, others

        $pdf->SetXY(65, $y + 29);
        $pdf->setFontSize(7);
        $pdf->Write(0, ($res['ownership_type'] == 'Others') ? $res['land_owner'] : ''); // ownership type, land_owner

        $pdf->SetXY(22, $y + 33);
        $pdf->setFontSize(7);
        $pdf->Write(0, ($res['ownership_type'] == 'Tenant') ? '/' : ''); // ownership type, tenant

        $pdf->SetXY(56, $y + 33);
        $pdf->setFontSize(7);
        $pdf->Write(0, ($res['ownership_type'] == 'Tenant') ? 'Tenant' : ''); // ownership type, land_owner

        $pdf->SetXY(22, $y + 37);
        $pdf->setFontSize(7);
        $pdf->Write(0, ($res['ownership_type'] == 'Lessee') ? '/' : ''); // ownership type, lessee

        $pdf->SetXY(56, $y + 37);
        $pdf->setFontSize(7);
        $pdf->Write(0, ($res['ownership_type'] == 'Lessee') ? $res['land_owner'] : ''); // ownership type, land_owner

            $y += 40;
             if ($index >= count($yCoordinates) - 1) {
                 break;

        }
    }
}


$pdf->Output('I', 'generated.pdf');
