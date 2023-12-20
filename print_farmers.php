<?php
include_once 'init.php';

// Fetch all farmers without sorting
$farmersQuery = "
SELECT
    fi.surname,
    fi.firstname,
    fi.middlename,
    fi.extension_name,
    SUBSTRING_INDEX(SUBSTRING_INDEX(fi.address, ',', -3), ',', 1) AS barangay,  -- Extract the barangay part
    GROUP_CONCAT(DISTINCT fli.location ORDER BY fli.location ASC SEPARATOR ', ') AS land_location,
    GROUP_CONCAT(DISTINCT fli.land_area ORDER BY fli.location ASC SEPARATOR ', ') AS land_area,
    GROUP_CONCAT(DISTINCT c.crop_name ORDER BY fli.location ASC SEPARATOR ', ') AS planted_crop
FROM farmer_info fi
LEFT JOIN farmer_land_info fli ON fi.farmer_id = fli.farmer_id
LEFT JOIN cultivated_plants cp ON fli.farmer_land_id = cp.land_id
LEFT JOIN crops c ON cp.crop_id = c.crop_id
GROUP BY fi.farmer_id";

$farmersStmt = $db->prepare($farmersQuery);
$farmersStmt->execute();
$farmers = $farmersStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-XI1TR0EdlFbDq42PEkgDy6bKBzhgNW0Zl/S3rFO6gfcyLfK4+5Cu1ZLPJhq7Czq+IJWkqY3HFuBtJ/CqQ5RlQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Print Farmers for Barangay</title>

    <style>
        @media print {
            /* Styles for printing */
            .btn, .dropdown {
                display: none !important;
            }

            @page {
                size: landscape;
            }
        }

        body {
            width: 29.7cm; /* Adjusted width for landscape */
            height: 21cm; /* Adjusted height for landscape */
            margin: 1cm auto;
            font-family: Arial, sans-serif;
            padding-right: 100px;
            padding-left: 100px;
        }

        .print-header {
            text-align: center;
        }

        .print-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .print-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .print-table th, .print-table td {
            border: 2px solid #000;
            padding: 8px;
            text-align: left; /* Align left for barangay cells */
        }

        /* Style for dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        .dropdown::before {
            content: '\25BC';
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            font-size: 20px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="print-header">
        <div><b>PROVINCE OF LA UNION</b></div>
        <div><b>Municipality of SUDIPEN</b></div>
        <br>
        <div class="print-title"></div>
    </div>

    <!-- Dropdown for selecting barangay -->
    <div class="dropdown">
        <select name="barangays" id="sudipen_barangay" class="form-control">
            <option disabled selected>Select Barangay</option>
            <option value="All">All Barangay</option>
            <option value="Bigbiga">Bigbiga</option>
            <option value="Bulalaan">Bulalaan</option>
            <option value="Castro">Castro</option>
            <option value="Duplas">Duplas</option>
            <option value="Ilocano">Ilocano</option>
            <option value="Ipet">Ipet</option>
            <option value="Maliclico">Maliclico</option>
            <option value="Namaltugan">Namaltugan</option>
            <option value="Old Central">Old Central</option>
            <option value="Poblacion">Poblacion</option>
            <option value="Porporiket">Porporiket</option>
            <option value="San Francisco Norte">San Francisco Norte</option>
            <option value="San Francisco Sur">San Francisco Sur</option>
            <option value="San Jose">San Jose</option>
            <option value="Sengngat">Sengngat</option>
            <option value="Turod">Turod</option>
            <option value="Up-uplas">Up-uplas</option>
        </select>
    </div>

    <!-- Table for farmer information -->
    <table class="print-table" id="farmersTable">
        <thead>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Extension Name</th>
                <th>Address (Barangay)</th>
                <th>Land Location</th>
                <th>Land Area (Hectares)</th>
                <th>Planted Crop</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($farmers as $farmer): ?>
                <tr>
                    <td><?php echo $farmer['surname']; ?></td>
                    <td><?php echo $farmer['firstname']; ?></td>
                    <td><?php echo $farmer['middlename']; ?></td>
                    <td><?php echo $farmer['extension_name']; ?></td>
                    <td><?php echo $farmer['barangay']; ?></td>
                    <td><?php echo $farmer['land_location']; ?></td>
                    <td><?php echo $farmer['land_area']; ?></td>
                    <td><?php echo $farmer['planted_crop']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="display: flex; margin-top: 40px;justify-content: center; align-items: center; align-content: center; ">
        <button style="background: transparent; color: black; padding: 10px; border-radius: 20px; font-size: 20px; width: 100px; outline-color: red;" class="btn" onclick="window.print()">
            <i class="fa fa-print" style="margin-right: 5px;"></i>Print
        </button>
    </div>

    <script>
        document.getElementById('sudipen_barangay').addEventListener('change', function () {
    var selectedBarangay = this.value;
    var table = document.getElementById('farmersTable');
    var rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    var printTitle = document.querySelector('.print-title');

    if (selectedBarangay === 'All') {
        printTitle.textContent = 'LIST OF FARMERS FOR ALL BARANGAY IN SUDIPEN';
    } else {
        printTitle.textContent = 'LIST OF FARMERS FOR BARANGAY ' + selectedBarangay.toUpperCase();
    }

    for (var i = 0; i < rows.length; i++) {
        var barangayCell = rows[i].getElementsByTagName('td')[4]; // Index 4 is the column with barangay info
        if (selectedBarangay === 'All' || barangayCell.innerText === selectedBarangay) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});

    </script>
</body>
</html>
