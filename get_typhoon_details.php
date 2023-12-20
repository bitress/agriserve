<?php
include_once 'init.php'; // Adjust the path to your initialization file

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['typhoonId'])) {
    $typhoonId = $_GET['typhoonId'];

    $detailsQuery = "SELECT * FROM typhoon_details WHERE typhoon_id = :typhoonId";
    $detailsStmt = $db->prepare($detailsQuery);
    $detailsStmt->bindParam(':typhoonId', $typhoonId);
    $detailsStmt->execute();

    $details = [];
    while ($detailsRow = $detailsStmt->fetch(PDO::FETCH_ASSOC)) {
        $details[] = [
            'barangay' => $detailsRow['barangay'],
            'affectedFarmers' => $detailsRow['affected_farmers'],
            'areaAffected' => $detailsRow['area_affected']
        ];
    }

    echo json_encode($details);
} else {
    // Handle invalid request
    echo json_encode(['error' => 'Invalid request']);
}
?>
