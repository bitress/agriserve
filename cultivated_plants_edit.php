<?php

include_once 'init.php';


if (!$user->isLoggedIn()) {
    header("Location: login.php");
}

$editMode = false;
$editCultivatedPlantsId = null;
$editLandId = null;
$editCropId = null;
$editFarmTypeId = null;
$editSize = null;

// Check if editing an existing record
if (isset($_GET['id'])) {
    $editCultivatedPlantsId = $_GET['id'];
    $editMode = true;

    $sql = "SELECT * FROM cultivated_plants WHERE cultivated_plants_id = :cultivated_plants_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':cultivated_plants_id', $editCultivatedPlantsId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $editLandId = $row['land_id'];
        $editCropId = $row['crop_id'];
        $editFarmTypeId = $row['farm_type'];
        $editSize = $row['size'];
    } else {
        echo "Error fetching record: " . $stmt->errorInfo()[2];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_cultivated_plants_id'])) {
    $landId = $_POST['land_id'];
    $cropId = $_POST['crop_name'];
    $farmTypeId = $_POST['farm_type'];
    $size = $_POST['size'];

    // Check if editing an existing record
    $editCultivatedPlantsId = $_POST['edit_cultivated_plants_id'];
    $editMode = true;

    $sql = "UPDATE cultivated_plants SET land_id = :land_id, crop_id = :crop_id, farm_type = :farm_type, size = :size WHERE cultivated_plants_id = :cultivated_plants_id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':land_id', $landId, PDO::PARAM_INT);
    $stmt->bindParam(':crop_id', $cropId, PDO::PARAM_INT);
    $stmt->bindParam(':farm_type', $farmTypeId, PDO::PARAM_INT);
    $stmt->bindParam(':size', $size);
    $stmt->bindParam(':cultivated_plants_id', $editCultivatedPlantsId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: cultivated_plants.php");
    } else {
        echo "Error updating record: " . $stmt->errorInfo()[2];
    }
}



$page = "cultivated_plants";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | AgriServe</title>


    <link href="css/light.css" rel="stylesheet">
    <!--     <link href="css/dark.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@4cac1a6/css/all.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
    <script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>


</head>
<body>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class='sidebar-brand' href='/'>
					<span class="sidebar-brand-text align-middle">
						AgriServe
					</span>
                <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5"
                     stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF" style="margin-left: -3px">
                    <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                    <path d="M20 12L12 16L4 12"></path>
                    <path d="M20 16L12 20L4 16"></path>
                </svg>
            </a>

            <?php

            include_once 'includes/navbar.php';

            ?>

        </div>
    </nav>

    <div class="main">
        <?php
        include_once 'includes/nav.php';
        ?>

        <main class="content">
            <div class="container-fluid p-0">

                <div class="row mb-2 mb-xl-3">
                    <div class="col-auto d-none d-sm-block">
                        <h3><strong>Farmers'</strong> Cultivated Plants Information</h3>
                    </div>
                </div>
                <div class="row">


                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">

                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" action="cultivated_plants_edit.php">
                                        <div class="mb-3">
                                            <select class="form-control" name="land_id" id="land_id">
                                                <option selected disabled>Select Farmer</option>
                                                <?php
                                                $sql = "SELECT * FROM farmer_land_info INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id";
                                                $stmt = $db->query($sql);
                                                if ($stmt->execute()):
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                                                        ?>
                                                        <option value="<?= $row['farmer_land_id'] ?>" <?= ($editMode && $editLandId == $row['farmer_land_id']) ? 'selected' : '' ?>>
                                                            <?= $row['firstname'] ?> <?= $row['middlename'] ?> <?= $row['surname'] ?> <?= $row['extension_name'] ?> -  <?= $row['land_area'] ?> hectares
                                                        </option>
                                                    <?php
                                                    endwhile;
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select class="form-control" name="crop_name" id="crop_name">
                                                        <option selected disabled>Select Crop</option>
                                                        <?php
                                                        $sql = "SELECT * FROM crops";
                                                        $stmt = $db->query($sql);
                                                        if ($stmt->execute()):
                                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                                                                ?>
                                                                <option value="<?= $row['crop_id'] ?>" <?= ($editMode && $editCropId == $row['crop_id']) ? 'selected' : '' ?>>
                                                                    <?= $row['crop_name'] ?>
                                                                </option>
                                                            <?php
                                                            endwhile;
                                                        endif;
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="farm_type" id="farm_type">
                                                        <option selected disabled>Select Farm Type</option>
                                                        <?php
                                                        $sql = "SELECT * FROM farm_type";
                                                        $stmt = $db->query($sql);
                                                        if ($stmt->execute()):
                                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                                                                ?>
                                                                <option value="<?= $row['farm_type_id'] ?>" <?= ($editMode && $editFarmTypeId == $row['farm_type_id']) ? 'selected' : '' ?>>
                                                                    <?= $row['farm_type'] ?>
                                                                </option>
                                                            <?php
                                                            endwhile;
                                                        endif;
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" name="size" id="size" class="form-control" value="<?= ($editMode) ? $editSize : '' ?>">
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <input type="hidden" name="edit_cultivated_plants_id" value="<?= ($editMode) ? $editCultivatedPlantsId : '' ?>">
                                                <button type="submit" class="btn btn-success">Submit Form</button>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </main>


        <?php

        include_once 'includes/footer.php';

        ?>


    </div>
</div>


<script src="js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="js/init.js"></script>
<script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
<script>
    var farmersTable = $('#farm_land_info').DataTable();

    var select_box_element = document.querySelector('#farm_owner');

    dselect(select_box_element, {
        search: true
    });


</script>
</body>
</html>
