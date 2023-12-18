<?php

include_once __DIR__. '/vendor/autoload.php';
include_once 'init.php';

header("Content-Type: application/json");
 $id = $_GET['id'];

$sql = "SELECT * FROM farmer_land_info LEFT JOIN ownership_document_type ON ownership_document_type.ownership_document_type_id = farmer_land_info.ownership_document_number LEFT JOIN cultivated_plants ON cultivated_plants.land_id = farmer_land_info.farmer_land_id LEFT JOIN crops ON crops.crop_id = cultivated_plants.crop_id WHERE farmer_land_info.farmer_id = {$id} LIMIT 3";
$stmt = $db->prepare($sql);
if ($stmt->execute()){
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}