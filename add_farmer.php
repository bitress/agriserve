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
                                    <form id="add_farmer_form">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                <label>2x2 Picture</label>
                                                <input type="file" class="form-control">
                                                </div>
                                            </div>
                                        </div>

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
                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label for="is_ip">Is Indigenous Person (IP)</label>
                                                    <select id="is_ip" name="is_ip" class="form-control">
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label for="is_ip">If is an Indigenous Person (IP), what?</label>
                                                   <input type="text" name="ip_name" id="ip_name" class="form-control">
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
                                            <div class="col-md-2">
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
                                                    <label for="household_head_name">If not Household Head? Who?</label>
                                                    <input type="text" name="household_head_name" id="household_head_name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
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
                                                    <div class="mt-3">
                                                        <button type="button" onclick="addRow()" class="btn btn-primary">Add Land</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="dynamicRows">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Ownership Type</label>
                                                    <select class="form-control" name="ownership_type[]">
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
                                                    <input type="text" class="form-control" placeholder="Land Area" name="land_area[]">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Land Location</label>
                                                    <input type="text" class="form-control" placeholder="Land Location" name="land_location[]">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Ownership Document Number</label>
                                                    <input type="text" class="form-control" name="ownership_document_number" id="ownership_document_number[]">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" class="form-check-input"  name="agrarian_reform_beneficiary[]">
                                                        <label class="form-check-label">Agrarian Reform Beneficiary</label>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" class="form-check-input"  name="within_ancestral_domain[]">
                                                        <label class="form-check-label">Within Ancestral Domain </label
                                                    </div>
                                                </div>
                                            </div>
                                            </div>

                                        </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mt-3">
                                                        <input type="hidden" name="action" value="addFarmer">
                                                        <button type="submit" name="submitForm" id="submitForm" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>

                                    </form>
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

<script src="js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="js/init.js"></script>
<script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
<script src="index.js"></script>
<script>
    function addRow() {
        let newRow = $("#dynamicRows .row:first").clone();
        // Clear input values in the new row
        newRow.find('input').val('');
        // Append the new row to the container
        $("#dynamicRows").append(newRow);

    }

</script>
</body>
</html>