<?php

include_once 'init.php';

if (!$user->isLoggedIn()) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = json_decode($_POST['formData'], true);

    $typhoonName = $formData['typhoonName'];
    $typhoonIn = $formData['typhoonIn'];
    $typhoonOut = $formData['typhoonOut'];
    $details = $formData['details'];

    // Insert the typhoon data into the database
    $insertTyphoonQuery = "INSERT INTO typhoon_report (typhoon_name, typhoon_in, typhoon_out) VALUES (:typhoonName, :typhoonIn, :typhoonOut)";
    $insertTyphoonStmt = $db->prepare($insertTyphoonQuery);
    $insertTyphoonStmt->bindParam(':typhoonName', $typhoonName);
    $insertTyphoonStmt->bindParam(':typhoonIn', $typhoonIn);
    $insertTyphoonStmt->bindParam(':typhoonOut', $typhoonOut);
    $insertTyphoonStmt->execute();

    // Get the last inserted typhoon_id
    $typhoonId = $db->lastInsertId();

    // Insert the typhoon details into the database
    $insertDetailsQuery = "INSERT INTO typhoon_details (typhoon_id, barangay, affected_farmers, area_affected) VALUES (:typhoonId, :barangay, :affectedFarmers, :areaAffected)";
    $insertDetailsStmt = $db->prepare($insertDetailsQuery);
    
    foreach ($details as $detail) {
        $barangay = $detail['barangay'];
        $affectedFarmers = $detail['affectedFarmers'];
        $areaAffected = $detail['areaAffected'];
        
        $insertDetailsStmt->bindParam(':typhoonId', $typhoonId);
        $insertDetailsStmt->bindParam(':barangay', $barangay);
        $insertDetailsStmt->bindParam(':affectedFarmers', $affectedFarmers);
        $insertDetailsStmt->bindParam(':areaAffected', $areaAffected);
        $insertDetailsStmt->execute();
    }

    echo "Typhoon and details added successfully.";
}
?>
