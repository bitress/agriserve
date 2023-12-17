<?php

    include_once 'init.php';
$farmer_obj = new Farmers();

    if (!$user->isLoggedIn()) {
        header("Location: login.php");
    }

$page = "dashboard";


// Assuming you have a Database class with a getInstance() method
$db = Database::getInstance();

$sql = "
    SELECT
        CASE
            WHEN address LIKE '%Ilocano%' THEN 'Ilocano'
            WHEN address LIKE '%Namaltugan%' THEN 'Namaltugan'
            WHEN address LIKE '%Old Central%' THEN 'Old Central'
            WHEN address LIKE '%Poblacion%' THEN 'Poblacion'
            WHEN address LIKE '%Turod%' THEN 'Turod'
            ELSE 'Unknown'
        END AS barangay,
        COUNT(*) AS total_farmers
    FROM
        farmer_info
    WHERE
        address LIKE '%Ilocano%'
        OR address LIKE '%Namaltugan%'
        OR address LIKE '%Old Central%'
        OR address LIKE '%Poblacion%'
        OR address LIKE '%Turod%'
    GROUP BY
        barangay;
";

$stmt = $db->prepare($sql);
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
$values = [];

foreach ($data as $row) {
    $labels[] = $row['barangay'];
    $values[] = $row['total_farmers'];
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
                        <h3><strong>Analytics</strong> Dashboard</h3>
                    </div>
                </div>
                <div class="row">


                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Farmers</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3"><?= $farmer_obj->countFarmers() ?></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Agri Assistance</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="dollar-sign"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">$21.300</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Agri Adversity</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="mt-1 mb-3">14.212</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-12 col-md-12 col-xxl-12 d-flex order-1 order-xxl-1">

                        <div class="card flex-fill w-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Farmer in Each Barangay</h5>
                            </div>
                        <div class="card-body d-flex">
                            <div class="w-100">
                                <div class="py-2">
                                    <div class="row">

                                        <div class="col-md-8">
                                            <div class="chart chart-lg">
                                                <canvas id="chartjs-dashboard-pie"></canvas>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="container">
                                                <ul class="list-group">
                                                    <?php foreach ($data as $row): ?>
                                                        <li class="list-group-item">
                                                            <?php echo $row['barangay']; ?>
                                                            <span class="badge text-bg-success"><?php echo $row['total_farmers']; ?></span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>

                                        </div>

                                    </div>



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

<script src="js/app.js"></script>

<script>

    var labels = <?php echo json_encode($labels); ?>;
    var values = <?php echo json_encode($values); ?>;

    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    const randomColors = Array.from({ length: 5 }, () => getRandomColor());



        document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: randomColors,
                    borderWidth: 5,
                    borderColor: window.theme.white
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 70
            }
        });
    });
</script>
</body>
</html>
