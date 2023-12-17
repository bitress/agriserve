<?php

include_once 'init.php';
if (isset($_POST['agriAssistanceId'])) {

    $agriAssistanceId = $_POST['agriAssistanceId'];

    $sql = "DELETE FROM agri_assistance WHERE agri_assistance_id = :agri_assistance_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':agri_assistance_id', $agriAssistanceId, PDO::PARAM_INT);
    $stmt->execute();

    $db = null;

    echo "Record deleted successfully";
} else {
    echo "Invalid request";
}

