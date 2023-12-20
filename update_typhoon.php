<?php

// Include database connection
include_once 'init.php';

// Get data from POST request
$data = json_decode($_POST['formData'], true);

try {
    // Extract typhoon data
    $typhoonName = $data['typhoonName'];
    $typhoonIn = $data['typhoonIn'];
    $typhoonOut = $data['typhoonOut'];
    $typhoonId = $data['typhoonId'];

    // Update typhoon_report table
    $updateTyphoonQuery = "UPDATE typhoon_report 
                           SET typhoon_name = :typhoonName, typhoon_in = :typhoonIn, typhoon_out = :typhoonOut 
                           WHERE typhoon_id = :typhoonId";

    $updateTyphoonStmt = $db->prepare($updateTyphoonQuery);
    $updateTyphoonStmt->bindParam(':typhoonName', $typhoonName);
    $updateTyphoonStmt->bindParam(':typhoonIn', $typhoonIn);
    $updateTyphoonStmt->bindParam(':typhoonOut', $typhoonOut);
    $updateTyphoonStmt->bindParam(':typhoonId', $typhoonId);
    $updateTyphoonStmt->execute();

    // Loop through details to update existing or insert new ones
    foreach ($data['details'] as $detail) {
        $barangay = $detail['barangay'];
        $affectedFarmers = $detail['affectedFarmers'];
        $areaAffected = $detail['areaAffected'];

        // Check if the detail already exists for the typhoon
        $checkDetailQuery = "SELECT COUNT(*) as count FROM typhoon_details WHERE typhoon_id = :typhoonId AND barangay = :barangay";
        $checkDetailStmt = $db->prepare($checkDetailQuery);
        $checkDetailStmt->bindParam(':typhoonId', $typhoonId);
        $checkDetailStmt->bindParam(':barangay', $barangay);
        $checkDetailStmt->execute();
        $count = $checkDetailStmt->fetch(PDO::FETCH_ASSOC)['count'];

        if ($count > 0) {
            // If the detail exists, update it
            $updateDetailsQuery = "UPDATE typhoon_details 
                                   SET affected_farmers = :affectedFarmers, area_affected = :areaAffected 
                                   WHERE typhoon_id = :typhoonId AND barangay = :barangay";

            $updateDetailsStmt = $db->prepare($updateDetailsQuery);
            $updateDetailsStmt->bindParam(':typhoonId', $typhoonId);
            $updateDetailsStmt->bindParam(':barangay', $barangay);
            $updateDetailsStmt->bindParam(':affectedFarmers', $affectedFarmers);
            $updateDetailsStmt->bindParam(':areaAffected', $areaAffected);
            $updateDetailsStmt->execute();
        } else {
            // If the detail doesn't exist, insert it
            $insertDetailsQuery = "INSERT INTO typhoon_details (typhoon_id, barangay, affected_farmers, area_affected) 
                                   VALUES (:typhoonId, :barangay, :affectedFarmers, :areaAffected)";

            $insertDetailsStmt = $db->prepare($insertDetailsQuery);
            $insertDetailsStmt->bindParam(':typhoonId', $typhoonId);
            $insertDetailsStmt->bindParam(':barangay', $barangay);
            $insertDetailsStmt->bindParam(':affectedFarmers', $affectedFarmers);
            $insertDetailsStmt->bindParam(':areaAffected', $areaAffected);
            $insertDetailsStmt->execute();
        }
    }

    echo json_encode(['status' => 'success', 'message' => 'Typhoon and details updated successfully']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error updating typhoon: ' . $e->getMessage()]);
}

?>
