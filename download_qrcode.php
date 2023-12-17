<?php

include_once 'init.php';


if (!$user->isLoggedIn()) {
    header("Location: login.php");
}


$id = null;
$name = null;
if (isset($_GET['id'])) {
    $land_id = $_GET['id'];
    $db = Database::getInstance();

    $sql = "SELECT * FROM farmer_info WHERE farmer_info.farmer_id = :land_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':land_id', $land_id);
    $stmt->execute();
    $land_data = $stmt->fetch(PDO::FETCH_ASSOC);

    $id = $land_data['farmer_id'];
    $name = $land_data['firstname'] . ' '. $land_data['middlename']. ' ' . $land_data['surname']. ' '.$land_data['extension_name'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriServe | QR Code</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        #canvas-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        #myCanvas {
            border: 1px solid #000;
            background-color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <div id="canvas-container">
        <canvas id="myCanvas" width="300" height="400"></canvas>
        <button id="downloadButton" class="btn btn-primary mt-3">Download QR Code</button>
    </div>
</div>

<script>
    var canvas = document.getElementById("myCanvas");
    var ctx = canvas.getContext("2d");

    ctx.fillStyle = "#FFFFFF";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Create a hidden div for QR Code generation
    var qrCodeDiv = document.createElement("div");
    qrCodeDiv.style.display = "none";
    document.body.appendChild(qrCodeDiv);

    // Generate QR Code
    var qrCodeData = '<?= APP_URL ?>/view-farmer.php?id=<?= $id ?>';
    var qrCode = new QRCode(qrCodeDiv, qrCodeData);
    var qrCodeImage = qrCodeDiv.querySelector('img');

    qrCodeImage.onload = function() {
        var x = (canvas.width - qrCodeImage.width) / 2;
        var y = (canvas.height - qrCodeImage.height) / 5;
        ctx.drawImage(qrCodeImage, x, y);
    };

    var text = "<?= $name; ?>";
    ctx.font = "18px Arial";
    ctx.fillStyle = "#000000";
    ctx.fillText(text, (canvas.width - ctx.measureText(text).width) / 2, canvas.height - 80);

    var downloadButton = document.getElementById("downloadButton");
    downloadButton.addEventListener("click", function() {
        var dataURL = canvas.toDataURL("image/png");
        var link = document.createElement('a');
        link.href = dataURL;
        link.download = '<?= $name; ?>_QR_CODE.png';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
</script>

<!-- Add Bootstrap JS and Popper.js CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>


