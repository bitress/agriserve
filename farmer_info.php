<?php

include_once 'init.php';

    if (!$user->isLoggedIn()) {
        header("Location: login.php");
    }

$page = "farmer_info";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | AgriServe</title>
    <link href="css/light.css" rel="stylesheet">
    <!--     <link href="css/dark.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@4cac1a6/css/all.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <script src="https://unpkg.com/@bitjson/qr-code@1.0.2/dist/qr-code.js"></script>
</head>
<body>
<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class='sidebar-brand' href='/'>
                <span class="sidebar-brand-text align-middle"> AgriServe </span>
                <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF" style="margin-left: -3px">
                    <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                    <path d="M20 12L12 16L4 12"></path>
                    <path d="M20 16L12 20L4 16"></path>
                </svg>
            </a> <?php

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
                            <div class="dropdown-menu-header"> 4 New Notifications </div>
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
                            <a class='dropdown-item' href='/pages-settings'>
                                <i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy </a>
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
                        <h3>
                            <strong>Farmers'</strong> Personal Information
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="container p-2">
                                            <div class="row">
                                                <div class="col-md-4">
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
                                                <div class="col-md-8">
                                                    <div class="btn-group btn-group-sm ">
                                                        <button type="button" class="btn btn-primary" onclick="window.open('print_farmers.php', '_blank')">
                                                        <i class="fal fa-print"></i> Print
                                                    </button>
                                                        <button type="button" class="btn btn-success" onclick="window.location.href='add_farmer.php'">
                                                            <i class="fal fa-user-plus"></i> Add Farmer </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table table-hover" id="farmers">
                                            <thead>
                                            <tr>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Middle Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Birth Date</th>
                                                <th scope="col">Contact Number</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main> <?php

        include_once 'includes/footer.php';

        ?>
    </div>
</div>
<div class="modal fade" id="viewFarmerProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Farmer's Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="view_farmer_form">

                    <div class="card">
                        <div class="card-body">


                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="view_first_name">First Name</label>
                                <input type="text" name="view_first_name" id="view_first_name" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_middle_name">Middle Name</label>
                                <input type="text" name="view_middle_name" id="view_middle_name" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_last_name">Last Name</label>
                                <input type="text" name="view_last_name" id="view_last_name" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="view_extension_name">Ext. Name</label>
                                <input type="text" name="view_extension_name" id="view_extension_name" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>Address</label>
                                <input id="view_address" name="view_address" class="form-control" placeholder="HOUSE/LOT/BLDG. NO./PUROK, STREET/SITIO/SUBDIV, BARANGAY, MUNICIPALITY, PROVINCE" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="view_sex">Sex</label>
                                <input type="text" id="view_sex" name="view_sex" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="view_add_birthday">Birthdate</label>
                                <input type="date" name="view_add_birthday" id="view_add_birthday" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Birthplace</label>
                                <input id="view_birthplace" name="view_birthplace" class="form-control" placeholder="MUNICIPALITY/CITY, PROVINCE" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_mobile_number">Mobile Number</label>
                                <input type="tel" id="view_mobile_number" name="view_mobile_number" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_religion">Religion</label>
                                <input type="text" id="view_religion" name="view_religion" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_civil_status">Civil Status</label>
                                <input type="text" id="view_civil_status" name="view_civil_status" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_education_level">Highest Formal Education</label>
                                <input type="text" name="view_education_level" id="view_education_level" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_mother_maiden_name">Mother's Maiden Name</label>
                                <input type="text" id="view_mother_maiden_name" name="view_mother_maiden_name" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_spouse_name">Spouse Name</label>
                                <input type="text" id="view_spouse_name" name="view_spouse_name" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_is_pwd">Is Person with Disability (PWD)</label>
                                <input type="text" id="view_is_pwd" name="view_is_pwd" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_is_4ps">Is 4Ps Beneficiary</label>
                                <input type="text" id="view_is_4ps" name="view_is_4ps" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_is_ip">Is Indigenous Person (IP)</label>
                                <input type="text" id="view_is_ip" name="view_is_ip" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_government_id_type">Government ID Type</label>
                                <input type="text" name="view_government_id_type" id="view_government_id_type" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="view_government_id_number">Government ID Number</label>
                                <input type="text" name="view_government_id_number" id="view_government_id_number" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="view_is_associated">Is Associated with an Organization</label>
                                <input type="text" id="view_is_associated" name="view_is_associated" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="view_association_name">Association Name</label>
                                <input type="text" name="view_association_name" id="view_association_name" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="view_household_head">Is Household Head</label>
                                <input type="text" name="view_household_head" id="view_household_head" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="view_household_head_relationship">Household Head Relationship</label>
                                <input type="text" name="view_household_head_relationship" id="view_household_head_relationship" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="view_living_household_members">Number of Living Household Members</label>
                                <input type="number" name="view_living_household_members" id="view_living_household_members" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="view_no_of_female">Number of Female Household Members</label>
                                <input type="number" name="view_no_of_female" id="view_no_of_female" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="view_no_of_male">Number of Male Household Members</label>
                                <input type="number" name="view_no_of_male" id="view_no_of_male" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="view_emergency_contact_name">Emergency Contact Name</label>
                                <input type="text" name="view_emergency_contact_name" id="view_emergency_contact_name" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="view_emergency_contact_number">Emergency Contact Number</label>
                                <input type="tel" name="view_emergency_contact_number" id="view_emergency_contact_number" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                        </div>
                    </div>


                    <div class="container">

                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Farmer Land Info</div>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="farmer_land_info">
                                        <thead>
                                        <tr>
                                            <th scope="col">Farm Land Area</th>
                                            <th scope="col">Farm Location</th>
                                            <th scope="col">Farm Ownership Type</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Farmer Cultivated Plants</div>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="cultivated_plants">
                                        <thead>
                                        <tr>
                                            <th scope="col">Farm Crops</th>
                                            <th scope="col">Farm Location</th>
                                            <th scope="col">Farm Type</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editFarmerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Farmer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_farmer_form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="edit_first_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" name="middle_name" id="edit_middle_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="edit_last_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="extension_name">Ext. Name</label>
                                <input type="text" name="extension_name" id="edit_extension_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>Address</label>
                                <input id="edit_address" name="edit_address" class="form-control" placeholder="HOUSE/LOT/BLDG. NO./PUROK, STREET/SITIO/SUBDIV, BARANGAY, MUNICIPALITY, PROVINCE">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="sex">Sex</label>
                                <select id="edit_sex" name="sex" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="birtdate">Birthdate</label>
                                <input type="date" name="add_birthday" id="edit_add_birthday" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Birthplace</label>
                                <input id="edit_birthplace" name="edit_birthplace" class="form-control" placeholder="MUNICIPALITY/CITY, PROVINCE">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="mobile_number">Mobile Number</label>
                                <input type="tel" id="edit_mobile_number" name="mobile_number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="religion">Religion</label>
                                <input type="text" id="edit_religion" name="religion" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="civil_status">Civil Status</label>
                                <select id="edit_civil_status" name="civil_status" class="form-control">
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="education_level">Highest Formal Education</label>
                                <select name="education_level" id="edit_education_level" class="form-control">
                                    <option value="elementary">Elementary</option>
                                    <option value="high_school">High School</option>
                                    <option value="college">College</option>
                                    <option value="bachelors_degree">Bachelor's Degree</option>
                                    <option value="masters_degree">Master's Degree</option>
                                    <option value="doctorate">Doctorate</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="mother_maiden_name">Mother's Maiden Name</label>
                                <input type="text" id="edit_mother_maiden_name" name="mother_maiden_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="spouse_name">Spouse Name</label>
                                <input type="text" id="edit_spouse_name" name="spouse_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="is_pwd">Is Person with Disability (PWD)</label>
                                <select id="edit_is_pwd" name="is_pwd" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="is_4ps">Is 4Ps Beneficiary</label>
                                <select id="edit_is_4ps" name="is_4ps" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="is_ip">Is Indigenous Person (IP)</label>
                                <select id="edit_is_ip" name="is_ip" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="government_id_type">Government ID Type</label>
                                <select name="government_id_type" id="edit_government_id_type" class="form-control">
                                    <option value="" selected disabled>Select an option</option>
                                    <option value="umid">Unified Multi-Purpose ID (UMID)</option>
                                    <option value="employeeId">Employee’s ID / Office ID</option>
                                    <option value="driverLicense">Driver’s License</option>
                                    <option value="prc">Professional Regulation Commission (PRC) ID</option>
                                    <option value="passport">Passport</option>
                                    <option value="seniorCitizenId">Senior Citizen ID</option>
                                    <option value="sss">Social Security System (SSS) ID</option>
                                    <option value="comelec">COMELEC / Voter’s ID / COMELEC Registration Form</option>
                                    <option value="philId">Philippine Identification (PhilID / ePhilID)</option>
                                    <option value="nbiClearance">NBI Clearance</option>
                                    <option value="ibpId">Integrated Bar of the Philippines (IBP) ID</option>
                                    <option value="firearmsLicense">Firearms License</option>
                                    <option value="afpslaiId">AFPSLAI ID</option>
                                    <option value="pvaoId">PVAO ID</option>
                                    <option value="afpBeneficiaryId">AFP Beneficiary ID</option>
                                    <option value="bir">BIR (TIN)</option>
                                    <option value="pagibig">Pag-ibig ID</option>
                                    <option value="pwdId">Person’s With Disability (PWD) ID</option>
                                    <option value="soloParentId">Solo Parent ID</option>
                                    <option value="4psId">Pantawid Pamilya Pilipino Program (4Ps) ID</option>
                                    <option value="barangayId">Barangay ID</option>
                                    <option value="postalId">Philippine Postal ID</option>
                                    <option value="philhealth">PhilHealth ID</option>
                                    <option value="schoolId">School ID</option>
                                    <option value="otherIds">Other valid government-issued IDs or Documents with picture and signature</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="government_id_number">Government ID Number</label>
                                <input type="text" name="government_id_number" id="edit_government_id_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="is_associated">Is Associated with an Organization</label>
                                <select id="is_associated" name="is_associated_edit" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="association_name">Association Name</label>
                                <input type="text" name="association_name" id="edit_association_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="is_household_head">Is Household Head</label>
                                <select id="is_household_head" name="is_household_head" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="household_head_relationship">Household Head Relationship</label>
                                <input type="text" name="household_head_relationship" id="edit_household_head_relationship" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="living_household_members">Number of Living Household Members</label>
                                <input type="number" name="living_household_members" id="edit_living_household_members" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="no_of_female">Number of Female Household Members</label>
                                <input type="number" name="no_of_female" id="edit_no_of_female" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="no_of_male">Number of Male Household Members</label>
                                <input type="number" name="no_of_male" id="edit_no_of_male" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="emergency_contact_name">Emergency Contact Name</label>
                                <input type="text" name="emergency_contact_name" id="edit_emergency_contact_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="emergency_contact_number">Emergency Contact Number</label>
                                <input type="tel" name="emergency_contact_number" id="edit_emergency_contact_number" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="hidden" name="id" id="edit_farmer_id">
                                    <input type="hidden" name="action" value="editFarmer">
                                    <button type="submit" name="editFarmerButton" id="editFarmerButton" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addFarmerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Farmer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_farmer_form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" name="middle_name" id="middle_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="extension_name">Ext. Name</label>
                                <input type="text" name="extension_name" id="extension_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label>Address</label>
                                <select id="add_region" name="dadd_region" class="form-control"></select>
                            </div>
                            <div class="mb-3">
                                <select id="add_barangay" name="dadd_barangay" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label></label>
                                <select id="add_province" name="dadd_province" class="form-control"></select>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="street" id="street" placeholder="STREET/SITIO/SUBDIV" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label></label>
                                <select id="add_municipality" name="dadd_municipality" class="form-control"></select>
                            </div>
                            <input type="text" id="house_number" name="house_number" placeholder="HOUSE/LOT/BLDG. NO./PUROK" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="sex">Sex</label>
                                <select id="sex" name="sex" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="birtdate">Birthdate</label>
                                <input type="date" name="add_birthday" id="add_birthday" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label>Birthplace</label>
                                <select id="add_birthplace_region" name="dadd_birthplace_region" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label></label>
                                <select id="add_birthplace_province" name="dadd_birthplace_province" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label></label>
                                <select id="add_birthplace_municipality" name="dadd_birthplace_municipality" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="mobile_number">Mobile Number</label>
                                <input type="tel" id="mobile_number" name="mobile_number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="religion">Religion</label>
                                <input type="text" id="religion" name="religion" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="civil_status">Civil Status</label>
                                <select id="civil_status" name="civil_status" class="form-control">
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="education_level">Highest Formal Education</label>
                                <select name="education_level" id="education_level" class="form-control">
                                    <option value="elementary">Elementary</option>
                                    <option value="high_school">High School</option>
                                    <option value="college">College</option>
                                    <option value="bachelors_degree">Bachelor's Degree</option>
                                    <option value="masters_degree">Master's Degree</option>
                                    <option value="doctorate">Doctorate</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="mother_maiden_name">Mother's Maiden Name</label>
                                <input type="text" id="mother_maiden_name" name="mother_maiden_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="spouse_name">Spouse Name</label>
                                <input type="text" id="spouse_name" name="spouse_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="is_pwd">Is Person with Disability (PWD)</label>
                                <select id="is_pwd" name="is_pwd" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="is_4ps">Is 4Ps Beneficiary</label>
                                <select id="is_4ps" name="is_4ps" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="is_ip">Is Indigenous Person (IP)</label>
                                <select id="is_ip" name="is_ip" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="government_id_type">Government ID Type</label>
                                <select name="government_id_type" id="government_id_type" class="form-control">
                                    <option value="" selected disabled>Select an option</option>
                                    <option value="umid">Unified Multi-Purpose ID (UMID)</option>
                                    <option value="employeeId">Employee’s ID / Office ID</option>
                                    <option value="driverLicense">Driver’s License</option>
                                    <option value="prc">Professional Regulation Commission (PRC) ID</option>
                                    <option value="passport">Passport</option>
                                    <option value="seniorCitizenId">Senior Citizen ID</option>
                                    <option value="sss">Social Security System (SSS) ID</option>
                                    <option value="comelec">COMELEC / Voter’s ID / COMELEC Registration Form</option>
                                    <option value="philId">Philippine Identification (PhilID / ePhilID)</option>
                                    <option value="nbiClearance">NBI Clearance</option>
                                    <option value="ibpId">Integrated Bar of the Philippines (IBP) ID</option>
                                    <option value="firearmsLicense">Firearms License</option>
                                    <option value="afpslaiId">AFPSLAI ID</option>
                                    <option value="pvaoId">PVAO ID</option>
                                    <option value="afpBeneficiaryId">AFP Beneficiary ID</option>
                                    <option value="bir">BIR (TIN)</option>
                                    <option value="pagibig">Pag-ibig ID</option>
                                    <option value="pwdId">Person’s With Disability (PWD) ID</option>
                                    <option value="soloParentId">Solo Parent ID</option>
                                    <option value="4psId">Pantawid Pamilya Pilipino Program (4Ps) ID</option>
                                    <option value="barangayId">Barangay ID</option>
                                    <option value="postalId">Philippine Postal ID</option>
                                    <option value="philhealth">PhilHealth ID</option>
                                    <option value="schoolId">School ID</option>
                                    <option value="otherIds">Other valid government-issued IDs or Documents with picture and signature</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="government_id_number">Government ID Number</label>
                                <input type="text" name="government_id_number" id="government_id_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="is_associated">Is Associated with an Organization</label>
                                <select id="is_associated" name="is_associated" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="association_name">Association Name</label>
                                <input type="text" name="association_name" id="association_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="is_household_head">Is Household Head</label>
                                <select id="is_household_head" name="is_household_head" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="household_head_relationship">Household Head Relationship</label>
                                <input type="text" name="household_head_relationship" id="household_head_relationship" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="living_household_members">Number of Living Household Members</label>
                                <input type="number" name="living_household_members" id="living_household_members" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="no_of_female">Number of Female Household Members</label>
                                <input type="number" name="no_of_female" id="no_of_female" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="no_of_male">Number of Male Household Members</label>
                                <input type="number" name="no_of_male" id="no_of_male" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="emergency_contact_name">Emergency Contact Name</label>
                                <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="emergency_contact_number">Emergency Contact Number</label>
                                <input type="tel" name="emergency_contact_number" id="emergency_contact_number" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="hidden" name="action" value="addFarmer">
                                    <button type="submit" name="submitForm" id="submitForm" class="btn btn-primary">Submit</button>
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
<script src="index.js"></script>
</body>
</html>