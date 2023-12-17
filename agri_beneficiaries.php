<?php

include_once 'init.php';

    if (!$user->isLoggedIn()) {
        header("Location: login.php");
    }

    if (isset($_POST['save_adversity'])) {
        $farmerId = $_POST['farmer_id'];
        $commodity = $_POST['commodity'];
        $areasAffected = $_POST['areas_affected'];
        $typhoon = $_POST['typhoon'];
        $date = $_POST['date'];

        $stmt = $db->prepare("INSERT INTO `agri_adversity` (farmer_id, commodity, areas_affected, typhoon, date) 
                         VALUES (:farmerId, :commodity, :areasAffected, :typhoon, :date)");

        // Bind parameters
        $stmt->bindParam(':farmerId', $farmerId);
        $stmt->bindParam(':commodity', $commodity);
        $stmt->bindParam(':areasAffected', $areasAffected);
        $stmt->bindParam(':typhoon', $typhoon);
        $stmt->bindParam(':date', $date);

        $stmt->execute();

        echo "Okay";

    }

$page = "agri_beneficiaries";
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
                        <h3><strong>Agri</strong> Adversity</h3>
                    </div>
                </div>
                <div class="row">


                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">

                            <div class="card">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fal fa-plus"></i> Add Adversity
                                    </button>

                                    <button type="button" class="btn btn-success mb-3">
                                        <i class="fal fa-print"></i> Print
                                    </button>


                                    <div class="table-responsive">

                                        <table class="table table-hover" id="farm_land_info">
                                            <thead>
                                            <tr>
                                                <th scope="col">Farm Owner</th>
                                                <th scope="col">Commodity</th>
                                                <th scope="col">Areas Affected</th>
                                                <th scope="col">Typhoon</th>
                                                <th scope="col">Year</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            try {
                                $query = $db->query("SELECT  * FROM agri_adversity INNER JOIN farmer_info ON farmer_info.farmer_id = agri_adversity.farmer_id");
                                $data = $query->fetchAll(PDO::FETCH_ASSOC);

                                // Output data in HTML
                                foreach ($data as $row) {
                                    echo '<tr>';
                                    echo '<td>' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['surname'] . ' ' . $row['extension_name'] . '</td>';
                                    echo '<td>' . $row['commodity'] . '</td>';
                                    echo '<td>' . $row['areas_affected'] . '</td>';
                                    echo '<td>' . $row['typhoon'] . '</td>';
                                    echo '<td>' . date('Y', strtotime( $row['date'])) . '</td>';
                                    echo '<td>

<div class="btn-group"><button class="btn btn-danger"><i class="fal fa-trash"></i> Delete</button></div>
                                        </td>';
                                    echo '</tr>';
                                }
                            } catch (PDOException $e) {
                                // Handle database connection errors
                                echo '<tr><td colspan="6">Error fetching data</td></tr>';
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form method="POST" action="agri_beneficiaries.php">
                   <div class="mb-3">
                       <select class="form-control" name="farmer_id" id="farmer_id">
                           <option selected disabled>Select Farmer</option>
                           <?php
                           $sql = "SELECT * FROM farmer_land_info INNER JOIN farmer_info ON farmer_info.farmer_id = farmer_land_info.farmer_id";
                           $stmt = $db->query($sql);
                           if ($stmt->execute()):
                               while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                                   ?>
                                   <option value="<?= $row['farmer_id'] ?>"> <?= $row['firstname'] ?> <?= $row['middlename'] ?> <?= $row['surname'] ?> <?= $row['extension_name'] ?></option>
                               <?php
                               endwhile;
                           endif;
                           ?>
                       </select>
                   </div>

                   <div class="mb-3">
                       <label for="commodity" class="form-label">Commodity</label>
                       <input type="text" class="form-control" name="commodity" id="commodity">
                   </div>

                   <div class="mb-3">
                       <label for="areas_affected" class="form-label">Areas Affected</label>
                       <input type="text" class="form-control" name="areas_affected" id="areas_affected">
                   </div>

                   <div class="mb-3">
                       <label for="typhoon" class="form-label">Typhoon</label>
                       <input type="text" class="form-control" name="typhoon" id="typhoon">
                   </div>

                   <div class="mb-3">
                       <label for="date" class="form-label">Date</label>
                       <input type="date" class="form-control" name="date" id="date">
                   </div>

                   <button type="submit" name="save_adversity" class="btn btn-primary">Submit</button>

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
    var farmersTable = $('#farm_land_info').DataTable( );
    var select_box_element = document.querySelector('#farmer_id');

    dselect(select_box_element, {
        search: true
    });


</script>
</body>
</html>
