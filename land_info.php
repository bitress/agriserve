<?php

include_once 'init.php';


    if (!$user->isLoggedIn()) {
        header("Location: login.php");
    }


if (isset( $_GET['delete'])) {
    $db = Database::getInstance();
    $land_id = $_GET['delete'];

    // Prepare SQL statement
    $sql = "DELETE FROM farmer_land_info WHERE farmer_land_id = :land_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':land_id', $land_id);
    if ($stmt->execute()) {
        header("Location: land_info.php?success=1");
        exit();
    } else {
        header("Location: land_info.php?success=0");
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['save_land'])) {

        // Get form data
        $farmer_id = $_POST['farm_owner'];
        $land_area = $_POST['land_area'];
        $location = $_POST['land_location'];
        $agrarian_reform_beneficiary = isset($_POST['agrarian_reform_beneficiary']) ? 1 : 0;
        $ownership_type = $_POST['ownership_type'];
        $within_ancestral_domain = isset($_POST['within_ancestral_domain']) ? 1 : 0;
        $ownership_document_number = $_POST['ownership_document_number'];

        // Prepare SQL statement
        $sql = "INSERT INTO farmer_land_info (farmer_id, land_area, location, agrarian_reform_beneficiary, ownership_type, within_ancestral_domain, ownership_document_number)
                VALUES (:farmer_id, :land_area, :location, :agrarian_reform_beneficiary, :ownership_type, :within_ancestral_domain, :ownership_document_number)";

        // Prepare and execute the statement
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':farmer_id', $farmer_id);
        $stmt->bindParam(':land_area', $land_area);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':agrarian_reform_beneficiary', $agrarian_reform_beneficiary);
        $stmt->bindParam(':ownership_type', $ownership_type);
        $stmt->bindParam(':within_ancestral_domain', $within_ancestral_domain);
        $stmt->bindParam(':ownership_document_number', $ownership_document_number);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: land_info.php?success=1");
        } else {
            header("Location: land_info.php?success=0");
        }
    }

}
$page = "land_info";
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
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>


            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                            <div class="position-relative">
                                <i class="align-middle" data-feather="bell"></i>
                                <span class="indicator">4</span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                            <div class="dropdown-menu-header">
                                4 New Notifications
                            </div>
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <i class="text-danger" data-feather="alert-circle"></i>
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">Update completed</div>
                                            <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                            <div class="text-muted small mt-1">30m ago</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <i class="text-warning" data-feather="bell"></i>
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">Lorem ipsum</div>
                                            <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                                            <div class="text-muted small mt-1">2h ago</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <i class="text-primary" data-feather="home"></i>
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">Login from 192.186.1.8</div>
                                            <div class="text-muted small mt-1">5h ago</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <i class="text-success" data-feather="user-plus"></i>
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">New connection</div>
                                            <div class="text-muted small mt-1">Christina accepted your request.</div>
                                            <div class="text-muted small mt-1">14h ago</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-menu-footer">
                                <a href="#" class="text-muted">Show all notifications</a>
                            </div>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
                            <div class="position-relative">
                                <i class="align-middle" data-feather="maximize"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded" alt="Charles Hall" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class='dropdown-item' href='/pages-settings'><i class="align-middle me-1" data-feather="settings"></i> Settings &
                                Privacy</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Log out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content">
            <div class="container-fluid p-0">

                <div class="row mb-2 mb-xl-3">
                    <div class="col-auto d-none d-sm-block">
                        <h3><strong>Farmers'</strong> Land Information</h3>
                    </div>
                </div>
                <div class="row">


                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">

                            <div class="card">
                                <div class="card-body">

                                    <?php
                                    $success = isset($_GET['success']) ? $_GET['success'] : null;

                                    if ($success === '1') {
                                        echo '<div class="alert alert-success" role="alert">Record updated successfully.</div>';
                                    } elseif ($success === '0') {
                                        echo '<div class="alert alert-danger" role="alert">Error.</div>';
                                    }
                                    ?>

                                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addLandInfo">
                                        Add Land
                                    </button>


                                    <div class="table-responsive">

                                        <table class="table table-hover" id="farm_land_info">
                                            <thead>
                                            <tr>
                                                <th scope="col">Farm Owner</th>
                                                <th scope="col">Farm Land Area</th>
                                                <th scope="col">Farm Location</th>
                                                <th scope="col">Farm Ownership Type</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php

                                            $ownership_types = [
                                                "certificateOfLandTransfer" => "Certificate of Land Transfer",
                                                "emancipationPatent" => "Emancipation Patent",
                                                "individualCertificateOfLand" => "Individual Certificate of Land",
                                                "collectiveCLOA" => "Collective CLOA",
                                                "coownershipCLOA" => "Co-ownership CLOA",
                                                "agriculturalSalesPatent" => "Agricultural Sales Patent",
                                                "homesteadPatent" => "Homestead Patent",
                                                "freePatent" => "Free Patent",
                                                "certificateOfTitle" => "Certificate of Title or Regular Title",
                                                "certificateOfAncestralDomainTitle" => "Certificate of Ancestral Domain Title",
                                                "certificateOfAncestralLandTitle" => "Certificate of Ancestral Land Title",
                                                "taxDeclaration" => "Tax Declaration",
                                                "others" => "Others (e.g., Barangay Certification)"
                                            ];


                                            $sql = "SELECT * FROM farmer_land_info INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id";
                                                $stmt = $db->query($sql);
                                                if ($stmt->execute()):
                                                    while ($f = $stmt->fetch(PDO::FETCH_ASSOC)):
                                            ?>

                                                    <tr>
                                                        <td><?= $f['firstname'] ?> <?= $f['middlename'] ?> <?= $f['surname'] ?> <?= $f['extension_name'] ?> </td>
                                                        <td><?= $f['land_area'] ?> </td>
                                                        <td><?= $f['location'] ?> </td>
                                                        <td>
                                                            <?php
                                                            if (array_key_exists($f['ownership_type'], $ownership_types)):
                                                                echo  $ownership_types[$f['ownership_type']];
                                                            endif;
                                                            ?>
                                                        </td>
                                                        <td>  <div class="btn-group">
                                                                <button type="button" class="btn btn-outline-secondary edit_farmer" onclick="window.location.href = 'land_edit.php?id=<?= $f['farmer_land_id'] ?>'" data-farmer-id="<?= $f['farmer_land_id'] ?>"><i class="fal fa-pencil"></i></button>
                                                                <button type="button" class="btn btn-outline-danger delete_farmer" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='land_info.php?delete=<?= $f['farmer_land_id'] ?>' }" data-farmer-id="<?= $f['farmer_land_id'] ?>"><i class="fal fa-trash"></i></button>
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


                </div>
            </div>
        </main>


        <?php

        include_once 'includes/footer.php';

        ?>


    </div>
</div>

<div class="modal fade" id="addLandInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="land_info.php">
                    <div class="mb-3">
                        <label>Farm Owner</label>
                        <select class="form-control" name="farm_owner" id="farm_owner">
                            <option selected disabled>Select Farmer</option>
                            <?php
                                $farmer_obj = new Farmers();
                                $farmers = $farmer_obj->fetchAllFarmers();

                                foreach ($farmers as $f):
                            ?>
                            <option value="<?= $f['farmer_id'] ?>"><?= $f['firstname'] ?> <?= $f['middlename'] ?> <?= $f['surname'] ?> <?= $f['extension_name'] ?> </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Ownership Type</label>
                            <select class="form-control" name="ownership_type">
                                <option value="certificateOfLandTransfer">Certificate of Land Transfer</option>
                                <option value="emancipationPatent">Emancipation Patent</option>
                                <option value="individualCertificateOfLand">Individual Certificate of Land</option>
                                <option value="collectiveCLOA">Collective CLOA</option>
                                <option value="coownershipCLOA">Co-ownership CLOA</option>
                                <option value="agriculturalSalesPatent">Agricultural Sales Patent</option>
                                <option value="homesteadPatent">Homestead Patent</option>
                                <option value="freePatent">Free Patent</option>
                                <option value="certificateOfTitle">Certificate of Title or Regular Title</option>
                                <option value="certificateOfAncestralDomainTitle">Certificate of Ancestral Domain Title</option>
                                <option value="certificateOfAncestralLandTitle">Certificate of Ancestral Land Title</option>
                                <option value="taxDeclaration">Tax Declaration</option>
                                <option value="others">Others (e.g., Barangay Certification)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Land Area</label>
                            <input type="text" class="form-control" placeholder="Land Area" name="land_area">
                        </div>
                        <div class="col-md-3">
                            <label>Land Location</label>
                            <input type="text" class="form-control" placeholder="Land Location" name="land_location">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Ownership Document Number</label>
                            <input type="text" class="form-control" name="ownership_document_number" id="ownership_document_number">
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input"  name="agrarian_reform_beneficiary">
                                <label class="form-check-label">Agrarian Reform Beneficiary</label>

                            </div>
                              </div>
                        <div class="col-md-3">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input"  name="within_ancestral_domain">
                                <label class="form-check-label">Within Ancestral Domain </label
                            </div>
                              </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" name="save_land" class="btn btn-primary">Save</button>
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
    var farmersTable = $('#farm_land_info').DataTable();

    var select_box_element = document.querySelector('#farm_owner');

    dselect(select_box_element, {
        search: true
    });


</script>
</body>
</html>
