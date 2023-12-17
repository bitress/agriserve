<?php

include_once 'init.php';

    if (!$user->isLoggedIn()) {
        header("Location: login.php");
    }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_crop"])) {
    try {
        $crop_name = htmlspecialchars($_POST['crop_name']);

        $stmt = $db->prepare("INSERT INTO crops (crop_name) VALUES (:crop_name)");

        $stmt->bindParam(':crop_name', $crop_name);

        $stmt->execute()    ;

        echo "Crop inserted successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_cultivated_plants"])) {
    $db = Database::getInstance();

    $land_id = $_POST['land_id'];
    $crop_id = $_POST['crop_name'];
    $size = $_POST['size'];
    $farm_type_id = $_POST['farm_type'];

    $sql = "INSERT INTO cultivated_plants (land_id, crop_id, size, farm_type) VALUES (:land_id, :crop_id, :size, :farm_type)";

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':land_id', $land_id, PDO::PARAM_INT);
    $stmt->bindParam(':crop_id', $crop_id, PDO::PARAM_INT);
    $stmt->bindParam(':size', $size, PDO::PARAM_STR);
    $stmt->bindParam(':farm_type', $farm_type_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Record inserted successfully!";
    } else {
        echo "Error inserting record: " . $stmt->errorInfo()[2];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $cultivated_plants_id = $_GET["delete"];

    $db = Database::getInstance();

    $sql = "DELETE FROM cultivated_plants WHERE cultivated_plants_id = :cultivated_plants_id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':cultivated_plants_id', $cultivated_plants_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Record deleted successfully!";
    } else {
        echo "Error deleting record: " . $stmt->errorInfo()[2];
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
       <?php include_once 'includes/nav.php' ?>
        <main class="content">
            <div class="container-fluid p-0">

                <div class="row mb-2 mb-xl-3">
                    <div class="col-auto d-none d-sm-block">
                        <h3><strong>Farm's</strong> Cultivated Plants</h3>
                    </div>
                </div>
                <div class="row">


                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">

                            <div class="card">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_cultivated_plants">
                                        Add Cultivated Plants
                                    </button>

                                    <div class="table-responsive">

                                        <table class="table table-hover" id="cultivated_plants">
                                            <thead>
                                            <tr>
                                                <th scope="col">Farm Owner</th>
                                                <th scope="col">Farm Crops</th>
                                                <th scope="col">Farm Location</th>
                                                <th scope="col">Farm Type</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php

                                            $sql = "SELECT * FROM farmer_land_info INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id INNER JOIN cultivated_plants ON cultivated_plants.land_id = farmer_land_info.farmer_land_id INNER JOIN crops ON cultivated_plants.crop_id = crops.crop_id INNER JOIN farm_type ON cultivated_plants.farm_type = farm_type.farm_type_id;";
                                            $stmt = $db->query($sql);
                                            if ($stmt->execute()):
                                                while ($f = $stmt->fetch(PDO::FETCH_ASSOC)):
                                                    ?>

                                                    <tr>
                                                        <td><?= $f['firstname'] ?> <?= $f['middlename'] ?> <?= $f['surname'] ?> <?= $f['extension_name'] ?> </td>
                                                        <td><?= $f['crop_name'] ?> </td>
                                                        <td><?= $f['location'] ?> </td>
                                                        <td><?= $f['farm_type'] ?> </td>
                                                        <td>  <div class="btn-group">
                                                                <button type="button" class="btn btn-outline-secondary edit_farmer" onclick="window.location.href = 'cultivated_plants_edit.php?id=<?= $f['cultivated_plants_id'] ?>'" data-farmer-id="<?= $f['cultivated_plants_id'] ?>"><i class="fal fa-pencil"></i></button>
                                                                <button type="button" class="btn btn-outline-danger delete_farmer" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='cultivated_plants.php?delete=<?= $f['cultivated_plants_id'] ?>' }" data-farmer-id="<?= $f['cultivated_plants_id'] ?>"><i class="fal fa-trash"></i></button>
                                                            </div></td>
                                                    </tr>

                                                <?php
                                                endwhile;
                                            endif;
                                            ?>



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">

                            <div class="card">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_crops">
                                        Add Crops
                                    </button>

                                    <div class="table-responsive">

                                        <table class="table table-hover" id="crops_dt">
                                            <thead>
                                            <tr>
                                                <th scope="col">Crops</th>
                                                <th >Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query = $db->query("SELECT * FROM crops");
                                            $cultivatedPlants = $query->fetchAll(PDO::FETCH_ASSOC);
                                            ?>

                                            <?php
                                            // Display cultivated plants
                                            foreach ($cultivatedPlants as $plant) {
                                                echo '<tr>';
                                                echo '<td>' . $plant['crop_name'] . '</td>';
                                                echo '<td><button class="btn btn-danger">Delete</button></td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
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

<div class="modal fade" id="add_crops" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Crops</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="cultivated_plants.php">
                    <div class="mb-3">
                        <label for="crop_name">Crop Name</label>
                        <input class="form-control" type="text" name="crop_name" id="crop_name" placeholder="Enter crop name">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary"  name="save_crop" id="crop_name">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add_cultivated_plants" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Cultivated Plants</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="cultivated_plants.php">
                    <div class="mb-3">
                        <select class="form-control" name="land_id" id="land_id">
                            <option selected disabled>Select Farmer</option>
                            <?php
                                $sql = "SELECT * FROM farmer_land_info INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id";
                                $stmt = $db->query($sql);
                                if ($stmt->execute()):
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                            ?>
                            <option value="<?= $row['farmer_land_id'] ?>"> <?= $row['firstname'] ?> <?= $row['middlename'] ?> <?= $row['surname'] ?> <?= $row['extension_name'] ?> -  <?= $row['land_area'] ?> hectares</option>
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
                                            <option value="<?= $row['crop_id'] ?>"><?= $row['crop_name'] ?></option>
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
                                            <option value="<?= $row['farm_type_id'] ?>"><?= $row['farm_type'] ?></option>
                                        <?php
                                        endwhile;
                                    endif;
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <input type="number" name="size" id="size" class="form-control">
                            </div>

                            </div>

                        <div class="mt-3">
                            <button type="submit" name="save_cultivated_plants" class="btn btn-success">Save Record</button>
                        </div>


                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="js/init.js"></script>
<script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
<script>
    var farmersTable = $('#cultivated_plants').DataTable();
    var crops_dt = $('#crops_dt').DataTable();

    var select_box_element = document.querySelector('#land_id');

    dselect(select_box_element, {
        search: true
    });


</script>
</body>
</html>
