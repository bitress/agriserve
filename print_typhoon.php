<?php
include_once 'init.php';

// Check if the typhoonId is provided in the URL
if (isset($_GET['typhoonId'])) {
    $typhoonId = $_GET['typhoonId'];

    // Fetch typhoon data from the database (replace with your actual query)
    $typhoonQuery = "SELECT * FROM typhoon_report WHERE typhoon_id = :typhoonId";
    $typhoonStmt = $db->prepare($typhoonQuery);
    $typhoonStmt->bindParam(':typhoonId', $typhoonId);
    $typhoonStmt->execute();
    $typhoonRow = $typhoonStmt->fetch(PDO::FETCH_ASSOC);

    // Fetch details for the specific typhoon
    $detailsQuery = "SELECT * FROM typhoon_details WHERE typhoon_id = :typhoonId";
    $detailsStmt = $db->prepare($detailsQuery);
    $detailsStmt->bindParam(':typhoonId', $typhoonId);
    $detailsStmt->execute();
    $details = $detailsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-XI1TR0EdlFbDq42PEkgDy6bKBzhgNW0Zl/S3rFO6gfcyLfK4+5Cu1ZLPJhq7Czq+IJWkqY3HFuBtJ/CqQ5RlQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Pre-Masterlist of Farmers Affected by Typhoon <?php echo $typhoonRow['typhoon_name']; ?></title>
  
    <style>

        @media print {
                /* Styles for printing */
                .btn {
                    display: none;
                }
            }

        body {
            width: 21cm;
            height: 29.7cm;
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

        .print-table th:nth-child(2), .print-table td:nth-child(2) {
            width: 25%;
            text-align: center; /* Align center for the "No. of Farmers Affected" column */
        }

        .print-table th:last-child, .print-table td:last-child {
            width: 25%;
            text-align: center; /* Align center for the last column (Total) */
        }
    </style>
</head>
<body>
    <div class="print-header">
        <div><b>PROVINCE OF LA UNION</b></div>
        <div><b>Municipality of SUDIPEN</b></div>
        <br>
        <br>
        <div class="print-title">PRE-MASTERLIST OF FARMERS AFFECTED BY TYPHOON <?php echo strtoupper($typhoonRow['typhoon_name']); ?></div>
    </div>

    <!-- Table for details -->
    <table class="print-table">
        <thead>
            <tr>
                <th style="text-align: center; padding: 15px;">Barangay</th>
                <th>No. of Farmers Affected</th>
                <th>AREA AFFECTED</th>
            </tr>
        </thead>
        <tbody>

            <!-- Populate table rows based on details -->
            <?php 
            $counter = 1;
            foreach ($details as $detail): ?>
                <tr>
                    <td><?php echo $counter++ . '. ' . $detail['barangay']; ?></td>
                    <td><?php echo $detail['affected_farmers']; ?></td>
                    <td><?php echo $detail['area_affected']; ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- Add the row for the total -->
            <tr>
                <td style="text-align: right;"><b>TOTAL</b></td>
                <td><b><?php echo array_sum(array_column($details, 'affected_farmers')); ?></b></td>
                <td><b><?php echo array_sum(array_column($details, 'area_affected')); ?></b></td>
            </tr>

        </tbody>
    </table>

    <!-- Submitted by -->
<div style="margin-top: 20px;">
    <p>Submitted by:</p><br>
    <input type="text" placeholder="Printed Name" name="submitted_by" style="width: 100%; padding: 5px; border: none;">
    <br>
    <input type="text" placeholder="Position" name="submitted_position" style="width: 100%; padding: 5px; border: none;">
</div>

<!-- Noted by -->
<div style="margin-top: 20px;">
    <p>Noted by:</p>
    <input type="text" placeholder="Printed Name" name="noted_by" style="width: 100%; padding: 5px; border: none;">
    <br>
    <input type="text" placeholder="Position" name="noted_position" style="width: 100%; padding: 5px; border: none;">
</div>


    <div style="display: flex; margin-top: 40px;justify-content: center; align-items: center; align-content: center; ">
        <button style="background: transparent; color: black; padding: 10px; border-radius: 20px; font-size: 20px; width: 100px; outline-color: red;" class="btn" onclick="window.print()">
            <i class="fa fa-print" style="margin-right: 5px;"></i>Print
        </button>
	</div>
</body>
</html>



<?php
} else {
    // Redirect to index.php if typhoonId is not provided
    header("Location: index.php");
}
?>
