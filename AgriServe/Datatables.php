<?php

class Datatables
{

    /**
     * @var Database
     */
    private $db;

    public function __construct()  {
        $this->db = Database::getInstance();
    }

    public function fetchFarmerLandInfoDT() {


        $id = $_POST['id'];

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();

        // Search
        $searchQuery = " ";
        if($searchValue != ''){
            $searchQuery = "  ";
        }

        // Total number of records without filtering
        $stmt = $this->db->prepare("SELECT COUNT(*) AS allcount  FROM farmer_land_info INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id WHERE farmer_land_info.farmer_id = {$id}");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        // Total number of records with filtering
        $stmt =  $this->db->prepare("SELECT COUNT(*) AS allcount FROM farmer_land_info INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id WHERE farmer_land_info.farmer_id = {$id} ".$searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        // Fetch records
        $stmt =  $this->db->prepare("SELECT * FROM farmer_land_info INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id WHERE farmer_land_info.farmer_id = {$id} ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

        // Bind values
        foreach ($searchArray as $key=>$search) {
            $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();

        foreach ($empRecords as $row) {
            $data[] = array(
                "land_area"=>$row['land_area'],
                "farm_location"=>$row['location'],
                "farm_ownership_type"=>$row['ownership_type'],
            );
        }

        // Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);


    }

    public function fetchCultivatedPlantsDT()
    {


        $id = $_POST['id'];

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();

        // Search
        $searchQuery = " ";
        if($searchValue != ''){
            $searchQuery = "  ";
        }

        // Total number of records without filtering
        $stmt = $this->db->prepare("SELECT COUNT(*) AS allcount  FROM cultivated_plants INNER JOIN crops ON crops.crop_id = cultivated_plants.crop_id INNER JOIN farmer_land_info ON farmer_land_info.farmer_land_id = cultivated_plants.land_id INNER JOIN farm_type ON farm_type.farm_type_id = cultivated_plants.farm_type INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id WHERE farmer_info.farmer_id = {$id}");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        // Total number of records with filtering
        $stmt =  $this->db->prepare("SELECT COUNT(*) AS allcount FROM cultivated_plants INNER JOIN crops ON crops.crop_id = cultivated_plants.crop_id INNER JOIN farmer_land_info ON farmer_land_info.farmer_land_id = cultivated_plants.land_id INNER JOIN farm_type ON farm_type.farm_type_id = cultivated_plants.farm_type INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id WHERE farmer_info.farmer_id = {$id} ".$searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        // Fetch records
        $stmt =  $this->db->prepare("SELECT * FROM cultivated_plants INNER JOIN crops ON crops.crop_id = cultivated_plants.crop_id INNER JOIN farmer_land_info ON farmer_land_info.farmer_land_id = cultivated_plants.land_id INNER JOIN farm_type ON farm_type.farm_type_id = cultivated_plants.farm_type INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id WHERE farmer_info.farmer_id = {$id} ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

        // Bind values
        foreach ($searchArray as $key=>$search) {
            $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();

        foreach ($empRecords as $row) {
            $data[] = array(
                "crop_name"=>$row['crop_name'],
                "farm_location"=>$row['location'],
                "farm_type"=>$row['farm_type'],
            );
        }

        // Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);


    }

}