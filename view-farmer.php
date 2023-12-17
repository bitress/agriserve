<?php

include_once 'init.php';


$page = "cultivated_plants";
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


    <div class="container py-5">
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


<script src="js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="js/init.js"></script>
<script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
<script>
    var farmersTable = $('#cultivated_plants').DataTable();
    var crops_dt = $('#crops_dt').DataTable();

    var farmer_id = '<?= $_GET['id'] ?>';


    $.ajax({
        type: "POST",
        url: "AgriServe/Ajax.php",
        data: {action: "fetchFarmerById", id: farmer_id },
        success: function (data) {
            var farmerData = JSON.parse(data)
            $("#view_first_name").val(farmerData.firstname);
            $("#view_farmer_id").val(farmerData.farmer_id);
            $("#view_middle_name").val(farmerData.middlename);
            $("#view_last_name").val(farmerData.surname);
            $("#view_extension_name").val(farmerData.extension_name);

            $("#view_address").val(farmerData.address);

            $("#view_sex").val(farmerData.sex);
            $("#view_add_birthday").val(farmerData.date_of_birth);
            $("#view_birthplace").val(farmerData.place_of_birth);

            $("#view_mobile_number").val(farmerData.mobile_number);

            $("#view_religion").val(farmerData.religion);
            $("#view_civil_status").val(farmerData.civil_status);
            $("#view_education_level").val(farmerData.highest_formal_education);
            $("#view_mother_maiden_name").val(farmerData.mother_maiden_name);
            $("#view_spouse_name").val(farmerData.spouse_name);

            $("#view_is_pwd").val(farmerData.is_pwd);
            $("#view_is_4ps").val(farmerData.is_4ps);
            $("#view_is_ip").val(farmerData.is_ip);

            $("#view_government_id_type").val(farmerData.government_id_type);
            $("#view_government_id_number").val(farmerData.government_id_number);

            $("#is_associated").val(farmerData.is_associated);
            $("#view_association_name").val(farmerData.association_name);

            $("#is_household_head").val(farmerData.is_household_head);
            $("#view_household_head_relationship").val(farmerData.household_head_relationship);
            $("#view_living_household_members").val(farmerData.living_household_members);
            $("#view_no_of_female").val(farmerData.no_of_female);
            $("#view_no_of_male").val(farmerData.no_of_male);

            $("#view_emergency_contact_name").val(farmerData.emergency_contact_name);
            $("#view_emergency_contact_number").val(farmerData.emergency_contact_number);


            $('#farmer_land_info').DataTable({
                'responsive':true,
                'processing': false,
                'serverSide': true,
                'serverMethod': 'post',
                'searching':false,
                "bDestroy": true,
                'ajax': {
                    'url':'AgriServe/Ajax.php',
                    "data": {
                        "id": farmer_id,
                        "action": 'dtLandInfo'
                    }
                },

                'columns': [
                    { data: 'land_area' },
                    { data: 'farm_location' },
                    { data: 'farm_ownership_type' },
                ],


                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,

                } ]

            });

            $('#cultivated_plants').DataTable({
                'responsive':true,
                'processing': false,
                'serverSide': true,
                'serverMethod': 'post',
                'searching':false,
                "bDestroy": true,
                'ajax': {
                    'url':'AgriServe/Ajax.php',
                    "data": {
                        "id": farmer_id,
                        "action": 'dtCultivatedPlants'
                    }
                },

                'columns': [
                    { data: 'crop_name' },
                    { data: 'farm_location' },
                    { data: 'farm_type' },
                ],


                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,

                } ]

            });

        }
    })


</script>
</body>
</html>
