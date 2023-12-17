<?php

class Land
{

    /**
     * @var Database
     */
    private $db;

    public  function __construct() {
        $this->db = Database::getInstance();
    }

    public function fetchAllLand() {

    }

    public function fetchLandById($id) {
        $sql = "SELECT * FROM farmer_land_info INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id WHERE farmer_land_id = :flid";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":flid", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    }

}