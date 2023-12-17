<?php

    include_once 'init.php';

    if ($user->isLoggedIn()){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | AgriServe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="css/landing.css">
</head>
<body>
<header>
    <div class="head_container">
        <div class="logo">
            <img src="img/agrilogo.png">
            <a href="#">AgriServe</a>
        </div>
        <div class="menu" id="myTopnav">
            <ul>
                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="openNav()">&#9776;</a>
                <li>
                    <a href="#">About</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Responsive Cover Photo -->
    <img src="img/banner.png" alt="Cover Photo" class="cover-photo">
</header>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">About</a>
</div>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">About</a>
</div>
<!-- Grid System for Pictures with Text and Button -->
<div class="container">
    <div class="grid-container">
        <div class="grid-item">
            <img src="img/admin.png" alt="Image 1">
            <h3>Agriculture Officer</h3>
            <p>Login to Dashboard</p>
            <button type="button" class="btn btn-outline-primary" id="loginModalBtn">Login</button>
        </div>
        <div class="grid-item">
            <img src="img/farmer.png" alt="Image 2">
            <h3>Search Farmer Profile</h3>
            <p>Scan QR code to see farmer profile</p>
            <button type="button" class="btn btn-outline-primary"><a href="qr.html" style="text-decoration: none;">Scan QR code</a></button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="container-fluid">
                <div class="row">
                    <!-- The image half -->
                    <div class="col-md-6 d-none d-md-flex bg-image"></div>
                    <!-- The content half -->
                    <div class="col-md-6 bg-light">
                        <div class="position-relative">
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-dismiss="modal" aria-label="Close" id="closeLoginModal"></button>
                            <div class="login d-flex align-items-center py-5">
                                <!-- Demo content-->
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-10 col-xl-9 mx-auto">
                                            <h3 class="display-4">Login Page</h3>
                                            <p class="text-muted mb-4">Please enter your username and password</p>
                                            <form id="login_form">
                                                <div class="form-group mb-3">
                                                    <input name="username" id="username" type="text" placeholder="Username" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <input id="password" name="password" type="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End -->
                            </div>
                        </div>
                    </div>
                    <!-- End -->
                </div>
            </div>
        </div>
    </div>
</div>


<br>

<footer class="main-footer">
    <div class="container">
        <p class="footer-text"> &copy; AgriServe - Sudipen 2023 </p>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="assets/js/sha512.min.js"></script>
<script src="assets/js/common.js"></script>
<script src="assets/js/login.js"></script>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        //document.getElementById("header").style.marginLeft = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        //document.getElementById("header").style.marginLeft= "0";
    };
</script>
<script>
    $(document).ready(function() {
        $("#loginModalBtn").click(function() {
            $("#loginModal").modal("show");
        });
        $("#closeLoginModal").click(function() {
            $("#loginModal").modal("hide");
        });
    });
</script>
</body>
</html>