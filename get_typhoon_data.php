<?php

include_once 'init.php';

// Fetch typhoon data from the database
$typhoonQuery = "SELECT typhoon_name, typhoon_in, typhoon_out FROM typhoon_report";
$typhoonResult = $db->query($typhoonQuery);

$typhoonData = array();

while ($typhoonRow = $typhoonResult->fetch(PDO::FETCH_ASSOC)) {
    $typhoonData[] = array(
        'typhoonName' => $typhoonRow['typhoon_name'],
        'typhoonIn' => $typhoonRow['typhoon_in'],
        'typhoonOut' => $typhoonRow['typhoon_out']
        // Add other fields as needed
    );
}

// Send the JSON-encoded typhoon data to the client
header('Content-Type: application/json');
echo json_encode($typhoonData);
