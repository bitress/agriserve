<?php

include_once 'init.php';

    if (!$user->isLoggedIn()) {
        header("Location: login.php");
    }

$page = "agri_assistance";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agriAssistanceId']) && isset($_POST['farmAssistance'])) {
        $agriAssistanceId = $_POST['agriAssistanceId'];
        $newFarmAssistance = $_POST['farmAssistance'];

        $sql = "UPDATE agri_assistance SET farm_assistance = :farm_assistance WHERE agri_assistance_id = :agri_assistance_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':farm_assistance', $newFarmAssistance, PDO::PARAM_STR);
        $stmt->bindParam(':agri_assistance_id', $agriAssistanceId, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect back to the page displaying the records
        header("Location: agri_assistance.php");
        exit();
    } else {
        echo "Invalid request";
    }
} else {
    echo "Invalid request";
}


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
                        <h3><strong>Agri</strong> Assistance</h3>
                    </div>
                </div>
                <div class="row">


                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">

                            <div class="card">
                                <div class="card-body">
                                  
                                  
                                  <?php
                                  
                                  if (isset($_GET['agriAssistanceId'])) {
    $agriAssistanceId = $_GET['agriAssistanceId'];

    $sql = "SELECT * FROM agri_assistance WHERE agri_assistance_id = :agri_assistance_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':agri_assistance_id', $agriAssistanceId, PDO::PARAM_INT);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display a form for editing
    echo "<form action='edit_assistance_record.php' method='post'>";
    echo "<input type='hidden' name='agriAssistanceId' value='" . $agriAssistanceId . "'>";
    echo "<label for='farmAssistance'>Farm Assistance:</label>";
    echo "<input type='text' id='farmAssistance' class='form-control' name='farmAssistance' value='" . $record['farm_assistance'] . "' required>";
    echo "<button class='btn btn-success mt-3' type='submit'>Update</button>";
    echo "</form>";
} else {
    echo "Invalid request";
}


                                  ?>


                                   
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

</body>
</html>
