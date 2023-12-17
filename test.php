<?php

include_once __DIR__. '/vendor/autoload.php';
include_once 'init.php';
if (isset($_GET['id'])) {

$id = $_GET['id'];


$farmer_obj = new Farmers();
$farmer = $farmer_obj->fetchFarmerById($id);

echo json_encode($farmer);

}
