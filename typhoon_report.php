<?php

include_once 'init.php';

if (!$user->isLoggedIn()) {
    header("Location: login.php");
}

$page = "typhoon_report";
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
                        <h3><strong>Typhoon</strong> Report</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">

                            <div class="card">
                                <div class="card-body">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#addTyphoonModal">Add Typhoon</button>

                                    <!-- Add Typhoon Modal -->
                                    <div class="modal" id="addTyphoonModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add Typhoon</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <form id="addTyphoonForm">
                                                        <div class="form-group">
                                                            <label for="typhoonName">Typhoon Name:</label>
                                                            <input type="text" class="form-control" id="typhoonName" required>
                                                        </div><br>
                                                        <div class="form-group">
                                                            <label for="typhoonIn">Typhoon In:</label>
                                                            <input type="date" class="form-control" id="typhoonIn" required>
                                                        </div><br>
                                                        <div class="form-group">
                                                            <label for="typhoonOut">Typhoon Out:</label>
                                                            <input type="date" class="form-control" id="typhoonOut" required>
                                                        </div><br>

                                                        <!-- Table for Barangay, Affected Farmers, and Area Affected -->
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th>Barangay</th>
                                                                <th>Affected Farmers</th>
                                                                <th>Area Affected</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <!-- Rows for Barangays will be added dynamically using JavaScript -->
                                                            </tbody>
                                                        </table>

                                                        <button type="button" class="btn btn-success" onclick="addRow()">Add Row</button>
                                                        <button type="submit" class="btn btn-primary" onClick="window.location.reload();">Add Typhoon</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br><br>

                                    <!-- Added Typhoon Information Table -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th >Typhoon Name</th>
                                                <th>Total Affected Barangays</th>
                                                <th>Total No. of Affected Farmers</th>
                                                <th>Total No. of Area Affected</th>
                                                <th>Typhoon In</th>
                                                <th>Typhoon Out</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch typhoon data from the database and display it in the table
                                            $typhoonQuery = "SELECT * FROM typhoon_report";
                                            $typhoonResult = $db->query($typhoonQuery);

                                            while ($typhoonRow = $typhoonResult->fetch(PDO::FETCH_ASSOC)) {
                                                $typhoonId = $typhoonRow['typhoon_id'];
                                                $typhoonName = $typhoonRow['typhoon_name'];
                                                $typhoonIn = $typhoonRow['typhoon_in'];
                                                $typhoonOut = $typhoonRow['typhoon_out'];

                                                // Calculate totals
                                                $detailsQuery = "SELECT COUNT(DISTINCT barangay) AS totalBarangays,
                                                            SUM(affected_farmers) AS totalAffectedFarmers,
                                                            SUM(area_affected) AS totalAreaAffected
                                                            FROM typhoon_details
                                                            WHERE typhoon_id = :typhoonId";
                                                $detailsStmt = $db->prepare($detailsQuery);
                                                $detailsStmt->bindParam(':typhoonId', $typhoonId);
                                                $detailsStmt->execute();
                                                $detailsRow = $detailsStmt->fetch(PDO::FETCH_ASSOC);

                                                $totalBarangays = $detailsRow['totalBarangays'];
                                                $totalAffectedFarmers = $detailsRow['totalAffectedFarmers'];
                                                $totalAreaAffected = $detailsRow['totalAreaAffected'];

                                                // Display the row in the table
                                                echo "<tr data-typhoon-id='{$typhoonId}'>
                                                    <td>{$typhoonName}</td>
                                                    <td>{$totalBarangays}</td>
                                                    <td>{$totalAffectedFarmers}</td>
                                                    <td>{$totalAreaAffected}</td>
                                                    <td>{$typhoonIn}</td>
                                                    <td>{$typhoonOut}</td>
                                                    <td>
                                                        <button class='btn btn-secondary' onclick=\"printTyphoon($typhoonId)\">Print</button>
                                                        <button class='btn btn-info' data-toggle='modal' data-target='#viewTyphoonModal{$typhoonId}'>View</button>
                                                        <button class='btn btn-warning' data-toggle='modal' data-target='#editTyphoonModal'>Edit</button>
                                                        <button class='btn btn-danger'>Delete</button>
                                                    </td>
                                                </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <!-- View Typhoon Modal -->
                                    <?php
// Fetch typhoon data from the database and display it in the modal
$typhoonResult = $db->query($typhoonQuery);

while ($typhoonRow = $typhoonResult->fetch(PDO::FETCH_ASSOC)) {
    $typhoonId = $typhoonRow['typhoon_id'];
    $typhoonName = $typhoonRow['typhoon_name'];
    $typhoonIn = $typhoonRow['typhoon_in'];
    $typhoonOut = $typhoonRow['typhoon_out'];

    echo "<div class='modal' id='viewTyphoonModal{$typhoonId}'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 class='modal-title'>View Typhoon</h4>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>
                        <p><strong>Typhoon Name:</strong> {$typhoonName}</p>
                        <p><strong>Typhoon In:</strong> {$typhoonIn}</p>
                        <p><strong>Typhoon Out:</strong> {$typhoonOut}</p>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Barangay</th>
                                    <th>Affected Farmers</th>
                                    <th>Area Affected</th>
                                </tr>
                            </thead>
                            <tbody>";

    // Fetch details for the specific typhoon
    $detailsQuery = "SELECT * FROM typhoon_details WHERE typhoon_id = :typhoonId";
    $detailsStmt = $db->prepare($detailsQuery);
    $detailsStmt->bindParam(':typhoonId', $typhoonId);
    $detailsStmt->execute();

    $totalAffectedFarmers = 0;
    $totalAreaAffected = 0;

    while ($detailsRow = $detailsStmt->fetch(PDO::FETCH_ASSOC)) {
        $barangay = $detailsRow['barangay'];
        $affectedFarmers = $detailsRow['affected_farmers'];
        $areaAffected = $detailsRow['area_affected'];

        // Accumulate totals
        $totalAffectedFarmers += $affectedFarmers;
        $totalAreaAffected += $areaAffected;

        // Display details in the modal
        echo "<tr>
                <td>{$barangay}</td>
                <td>{$affectedFarmers}</td>
                <td>{$areaAffected}</td>
            </tr>";
    }

    // Display totals in the modal
    echo "<tr>
            <td><strong>Total</strong></td>
            <td><strong>{$totalAffectedFarmers}</strong></td>
            <td><strong>{$totalAreaAffected}</strong></td>
        </tr>";

    echo "</tbody>
            </table>
        </div>
    </div>
</div>
</div>";
}
?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Edit Typhoon Modal -->
<div class="modal" id="editTyphoonModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Typhoon</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="editTyphoonForm" data-typhoon-id="<?php echo $typhoonId; ?>">
                    <div class="form-group">
                        <label for="editTyphoonName">Typhoon Name:</label>
                        <input type="text" class="form-control" id="editTyphoonName" required>
                    </div><br>
                    <div class="form-group">
                        <label for="editTyphoonIn">Typhoon In:</label>
                        <input type="date" class="form-control" id="editTyphoonIn" required>
                    </div><br>
                    <div class="form-group">
                        <label for="editTyphoonOut">Typhoon Out:</label>
                        <input type="date" class="form-control" id="editTyphoonOut" required>
                    </div><br>

                    <!-- Table for Barangay, Affected Farmers, and Area Affected -->
                    <table class="table" id="editTyphoonTable">
                        <thead>
                            <tr>
                                <th>Barangay</th>
                                <th>Affected Farmers</th>
                                <th>Area Affected</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows for Barangays will be added dynamically using JavaScript -->
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary" onClick="window.location.reload();">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


        <?php

        include_once 'includes/footer.php';

        ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        

        <script>
           // Function to add a new row to the table
function addRow() {
    const barangays = [
        "Bigbiga", "Bulalaan", "Castro", "Duplas", "Ilocano", "Ipet", "Maliclico", "Namaltugan",
        "Old Central", "Poblacion", "Porporiket", "San Francisco Norte", "San Francisco Sur",
        "San Jose", "Sengngat", "Turod", "Up-uplas"
    ];

    const tableBody = document.querySelector('tbody');

    // Check if the maximum number of barangays is already added
    if (tableBody.children.length >= barangays.length) {
        alert("All barangays have already been added.");
        return;
    }

    const newRow = document.createElement('tr');

    const barangayCell = document.createElement('td');
    const barangaySelect = document.createElement('select');
    barangaySelect.className = 'form-control';

    // Check if the barangay is already added
    const addedBarangays = Array.from(tableBody.children).map(row => row.children[0].firstChild.value);
    const availableBarangays = barangays.filter(barangay => !addedBarangays.includes(barangay));

    if (availableBarangays.length === 0) {
        alert("All barangays have already been added.");
        return;
    }

    for (const barangay of availableBarangays) {
        const option = document.createElement('option');
        option.text = barangay;
        barangaySelect.add(option);
    }
    barangayCell.appendChild(barangaySelect);
    newRow.appendChild(barangayCell);

    const affectedFarmersCell = document.createElement('td');
    const affectedFarmersInput = document.createElement('input');
    affectedFarmersInput.type = 'number';
    affectedFarmersInput.className = 'form-control';
    affectedFarmersInput.required = true;
    affectedFarmersCell.appendChild(affectedFarmersInput);
    newRow.appendChild(affectedFarmersCell);

    const areaAffectedCell = document.createElement('td');
    const areaAffectedInput = document.createElement('input');
    areaAffectedInput.type = 'number';
    areaAffectedInput.step = '0.01';
    areaAffectedInput.className = 'form-control';
    areaAffectedInput.required = true;
    areaAffectedCell.appendChild(areaAffectedInput);
    newRow.appendChild(areaAffectedCell);

    const removeBarangayCell = document.createElement('td');
    const removeBarangayButton = document.createElement('button');
    removeBarangayButton.className = 'btn btn-danger';
    removeBarangayButton.textContent = 'Remove';
    removeBarangayButton.addEventListener('click', function () {
        tableBody.removeChild(newRow);
    });
    removeBarangayCell.appendChild(removeBarangayButton);
    newRow.appendChild(removeBarangayCell);

    tableBody.appendChild(newRow);
}



            // Function to update the table with the latest typhoon data
            function updateTyphoonTable() {
                $.ajax({
                    type: 'GET',
                    url: 'get_typhoon_data.php',
                    success: function (data) {
                        const typhoonData = JSON.parse(data);
                        $('tbody').empty();

                        typhoonData.forEach(function (typhoon) {
                            const newRow = `<tr>
                                <td>${typhoon.typhoonName}</td>
                                <td>${typhoon.totalBarangays}</td>
                                <td>${typhoon.totalAffectedFarmers}</td>
                                <td>${typhoon.totalAreaAffected}</td>
                                <td>${typhoon.typhoonIn}</td>
                                <td>${typhoon.typhoonOut}</td>
                                <td>
                                    <button class='btn btn-info'>Print</button>
                                    <button class='btn btn-secondary'>View</button>
                                    <button class='btn btn-info'>Edit</button>
                                    <button class='btn btn-danger'>Delete</button>
                                </td>
                            </tr>`;
                            $('tbody').append(newRow);
                        });
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }

            $(document).ready(function () {
                $('#addTyphoonForm').submit(function (e) {
                    e.preventDefault();
                    const formData = {
                        typhoonName: $('#typhoonName').val(),
                        typhoonIn: $('#typhoonIn').val(),
                        typhoonOut: $('#typhoonOut').val(),
                        details: []
                    };

                    $('tbody tr').each(function () {
                        const barangay = $(this).find('select').val();
                        const affectedFarmers = $(this).find('input[type="number"]').eq(0).val();
                        const areaAffected = $(this).find('input[type="number"]').eq(1).val();

                        formData.details.push({
                            barangay: barangay,
                            affectedFarmers: affectedFarmers,
                            areaAffected: areaAffected
                        });
                    });

                    $.ajax({
                        type: 'POST',
                        url: 'add_typhoon.php',
                        data: {
                            formData: JSON.stringify(formData)
                        },
                        success: function (response) {
                            console.log(response);
                            alert('Typhoon and details added successfully.');
                            $('#addTyphoonModal').modal('hide');
                            updateTyphoonTable();
                            location.reload();
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                });

                $('tbody').on('click', '.btn-danger', function () {
                    const typhoonId = $(this).closest('tr').data('typhoon-id');
                    if (confirm('Are you sure you want to delete this typhoon record?')) {
                        $.ajax({
                            type: 'POST',
                            url: 'delete_typhoon.php',
                            data: {
                                typhoonId: typhoonId
                            },
                            success: function (response) {
                                console.log(response);
                                updateTyphoonTable();
                                location.reload();
                            },
                            error: function (error) {
                                console.error(error);
                            }
                        });
                    }
                });
            });
        </script>

        <script>
// Function to populate edit modal with existing data
function populateEditModal(typhoonId, typhoonName, typhoonIn, typhoonOut, details) {
    jQuery('#editTyphoonModal').modal('show');
    jQuery('#editTyphoonName').val(typhoonName);
    jQuery('#editTyphoonIn').val(typhoonIn);
    jQuery('#editTyphoonOut').val(typhoonOut);

    const tableBody = jQuery('#editTyphoonTable tbody')[0];
    tableBody.innerHTML = '';

    details.forEach(function (detail) {
        const newRow = tableBody.insertRow();

        const barangayCell = newRow.insertCell(0);
        const barangaySelect = document.createElement('select');
        barangaySelect.className = 'form-control';

        const option = document.createElement('option');
        option.text = detail.barangay;
        barangaySelect.add(option);
        barangayCell.appendChild(barangaySelect);

        const affectedFarmersCell = newRow.insertCell(1);
        const affectedFarmersInput = document.createElement('input');
        affectedFarmersInput.type = 'number';
        affectedFarmersInput.className = 'form-control';
        affectedFarmersInput.value = detail.affectedFarmers;
        affectedFarmersCell.appendChild(affectedFarmersInput);

        const areaAffectedCell = newRow.insertCell(2);
        const areaAffectedInput = document.createElement('input');
        areaAffectedInput.type = 'number';
        areaAffectedInput.step = '0.01';
        areaAffectedInput.className = 'form-control';
        areaAffectedInput.value = detail.areaAffected;
        areaAffectedCell.appendChild(areaAffectedInput);

        
    });
}


// Call this function when the 'Edit' button is clicked
$('tbody').on('click', '.btn-warning', function () {
        const typhoonId = $(this).closest('tr').data('typhoon-id');
        const typhoonName = $(this).closest('tr').find('td').eq(0).text();
        const typhoonIn = $(this).closest('tr').find('td').eq(4).text();
        const typhoonOut = $(this).closest('tr').find('td').eq(5).text();

        // Fetch details for the specific typhoon
        $.ajax({
            type: 'GET',
            url: 'get_typhoon_details.php',
            data: {
                typhoonId: typhoonId
            },
            success: function (data) {
                const details = JSON.parse(data);
                populateEditModal(typhoonId, typhoonName, typhoonIn, typhoonOut, details);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    // Handle form submission for editTyphoonForm
$('#editTyphoonForm').submit(function (e) {
    e.preventDefault();
    const typhoonId = $(this).data('typhoon-id'); // Retrieve typhoonId from data attribute

    const formData = {
        typhoonId: typhoonId,
        typhoonName: $('#editTyphoonName').val(),
        typhoonIn: $('#editTyphoonIn').val(),
        typhoonOut: $('#editTyphoonOut').val(),
        details: []
    };

    $('#editTyphoonTable tbody tr').each(function () {
        const barangay = $(this).find('select').val();
        const affectedFarmers = $(this).find('input[type="number"]').eq(0).val();
        const areaAffected = $(this).find('input[type="number"]').eq(1).val();

        formData.details.push({
            barangay: barangay,
            affectedFarmers: affectedFarmers,
            areaAffected: areaAffected
        });
    });

    console.log("Form Data:", formData); // Add this line for debugging

    $.ajax({
        url: 'update_typhoon.php',
        type: 'POST',
        data: { formData: JSON.stringify(formData) },
        success: function (response) {
            // Parse the JSON response
            var result = JSON.parse(response);

            // Check the status in the response
            if (result.status === 'success') {
                // If successful, show an alert with the success message
                alert(result.message);
            } else {
                // If there was an error, show an alert with the error message
                alert('Error: ' + result.message);
            }
        },
        error: function (xhr, status, error) {
            // Show an alert for any AJAX errors
            alert('AJAX Error: ' + error);
        }
    });
});



</script>

<script>
function printTyphoon(typhoonId) {
    // Open a new window with print_typhoon.php and pass typhoonId as a query parameter
    window.open('print_typhoon.php?typhoonId=' + typhoonId, '_blank');
}
</script>

    </body>
    </html>
