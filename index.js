
$(document).on('click', '.view_farmer', function (){
    let farmer_id = $(this).data('farmer-id');
    var viewProfileModal = new bootstrap.Modal(document.getElementById('viewFarmerProfileModal'))

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

// Set values for status information
            $("#view_is_pwd").val(farmerData.is_pwd);
            $("#view_is_4ps").val(farmerData.is_4ps);
            $("#view_is_ip").val(farmerData.is_ip);

// Set values for government ID information
            $("#view_government_id_type").val(farmerData.government_id_type);
            $("#view_government_id_number").val(farmerData.government_id_number);

// Set values for association information
            $("#is_associated").val(farmerData.is_associated);
            $("#view_association_name").val(farmerData.association_name);

// Set values for household information
            $("#is_household_head").val(farmerData.is_household_head);
            $("#view_household_head_relationship").val(farmerData.household_head_relationship);
            $("#view_living_household_members").val(farmerData.living_household_members);
            $("#view_no_of_female").val(farmerData.no_of_female);
            $("#view_no_of_male").val(farmerData.no_of_male);

// Set values for emergency contact information
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


    viewProfileModal.show();



});
$(document).on('click', '.delete_farmer', function (){

    let farmer_id = $(this).data('farmer-id')

    if(confirm("Are you sure you want to delete?")){
        $.ajax({
            type: "POST",
            url: "AgriServe/Ajax.php",
            dataType: 'json',
            data: {
                action: "deleteFarmer",
                id: farmer_id
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    notyf.success(response.message)
                    farmersTable.ajax.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            }
        })
    } else {
        notyf.error("Cancelled")

    }


});
$(document).on('click', '.edit_farmer', function (){

    let farmer_id = $(this).data('farmer-id')
    var editFormModal = new bootstrap.Modal(document.getElementById('editFarmerModal'))

    $.ajax({
        type: "POST",
        url: "AgriServe/Ajax.php",
        data: {action: "fetchFarmerById", id: farmer_id },
        success: function (data) {
            var farmerData = JSON.parse(data)

            $("#edit_first_name").val(farmerData.firstname);
            $("#edit_farmer_id").val(farmerData.farmer_id);
            $("#edit_middle_name").val(farmerData.middlename);
            $("#edit_last_name").val(farmerData.surname);
            $("#edit_extension_name").val(farmerData.extension_name);

            $("#edit_address").val(farmerData.address);

            $("#edit_sex").val(farmerData.sex);
            $("#edit_add_birthday").val(farmerData.date_of_birth);
            $("#edit_birthplace").val(farmerData.place_of_birth);

            $("#edit_mobile_number").val(farmerData.mobile_number);

            $("#edit_religion").val(farmerData.religion);
            $("#edit_civil_status").val(farmerData.civil_status);
            $("#edit_education_level").val(farmerData.highest_formal_education);
            $("#edit_mother_maiden_name").val(farmerData.mother_maiden_name);
            $("#edit_spouse_name").val(farmerData.spouse_name);

            // Set values for status information
            $("#edit_is_pwd").val(farmerData.is_pwd);
            $("#edit_is_4ps").val(farmerData.is_4ps);
            $("#edit_is_ip").val(farmerData.is_ip);

            // Set values for government ID information
            $("#edit_government_id_type").val(farmerData.government_id_type);
            $("#edit_government_id_number").val(farmerData.government_id_number);

            // Set values for association information
            $("#is_associated").val(farmerData.is_associated);
            $("#edit_association_name").val(farmerData.association_name);

            // Set values for household information
            $("#is_household_head").val(farmerData.is_household_head);
            $("#edit_household_head_relationship").val(farmerData.household_head_relationship);
            $("#edit_living_household_members").val(farmerData.living_household_members);
            $("#edit_no_of_female").val(farmerData.no_of_female);
            $("#edit_no_of_male").val(farmerData.no_of_male);

            // Set values for emergency contact information
            $("#edit_emergency_contact_name").val(farmerData.emergency_contact_name);
            $("#edit_emergency_contact_number").val(farmerData.emergency_contact_number);

        }
    })

    editFormModal.show()


});
$(document).ready(function () {
    $("#edit_farmer_form").on("submit", function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "AgriServe/Ajax.php",
            data: formData,
            dataType: 'json',
            contentType: false, // Ensure this is set to false for FormData
            processData: false, // Ensure this is set to false for FormData
            success: function (response) {
                console.log(response);
                if (response.success) {
                    notyf.success(response.message)
                    setTimeout(function () {
                        window.location.href = 'farmer_info.php'
                    }, 5000)
                } else {
                    alert('Error: ' + response.message);
                }
        }
        })

    });


        var farmersTable = $('#farmers').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'datatables/farmers_dt.php',
            'data': function(d) {
                d.barangay = $('#sudipen_barangay').val();
            }
        },
        'columns': [
            { data: 'firstname' },
            { data: 'middlename' },
            { data: 'surname' },
            { data: 'birth_date' },
            { data: 'mobile_number', orderable: false },
            { data: 'address' },
            { data: 'actions', orderable: false }
        ],
        'suppressWarnings': true
    });

    $('#sudipen_barangay').on('change', function() {
        farmersTable.ajax.reload();
    });

    $("#add_farmer_form").on("submit", function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        function handleDropdownChange(dropdown, key) {
            formData.append(key, dropdown.find('option:selected').text());
        }

        handleDropdownChange($('#add_province'), 'add_province');
        handleDropdownChange($('#add_municipality'), 'add_municipality');
        handleDropdownChange($('#add_barangay'), 'add_barangay');

        handleDropdownChange($('#add_birthplace_region'), 'add_birthplace_region');
        handleDropdownChange($('#add_birthplace_province'), 'add_birthplace_province');
        handleDropdownChange($('#add_birthplace_municipality'), 'add_birthplace_municipality');


        console.log(formData);

        // Submit the form data via AJAX
        $.ajax({
            type: "POST",
            url: "AgriServe/Ajax.php",
            data: formData,
            dataType: 'json',
            contentType: false, // Ensure this is set to false for FormData
            processData: false, // Ensure this is set to false for FormData
            success: function (response) {
                console.log(response);
                if (response.success) {
                    notyf.success(response.message)
                    farmersTable.ajax.reload();
                } else {
                    // Handle errors from the server
                    alert('Error: ' + response.message);
                }
            }
        });
    });
});




var my_handlers = {
    fill_provinces: function () {
        var region_code = $(this).val();
        $('#add_province').ph_locations('fetch_list', [{ "region_code": region_code }]);
    },

    fill_cities: function () {
        var province_code = $(this).val();
        $('#add_municipality').ph_locations('fetch_list', [{ "province_code": province_code }]);
    },

    fill_barangays: function () {
        var city_code = $(this).val();
        $('#add_barangay').ph_locations('fetch_list', [{ "city_code": city_code }]);
    },

    fill_birthplace_provinces: function () {
        var region_code_ = $(this).val();
        $('#add_birthplace_province').ph_locations('fetch_list', [{ "region_code": region_code_ }]);
    },

    fill_birthplace_cities: function () {
        var province_code_ = $(this).val();
        $('#add_birthplace_municipality').ph_locations('fetch_list', [{ "province_code": province_code_ }]);
    },
};

$(function () {
    $('#add_region').on('change', my_handlers.fill_provinces);
    $('#add_province').on('change', my_handlers.fill_cities);
    $('#add_municipality').on('change', my_handlers.fill_barangays);

    $('#add_birthplace_region').on('change', my_handlers.fill_birthplace_provinces);
    $('#add_birthplace_province').on('change', my_handlers.fill_birthplace_cities);

    $('#add_region').ph_locations({ 'location_type': 'regions' });
    $('#add_province').ph_locations({ 'location_type': 'provinces' });
    $('#add_municipality').ph_locations({ 'location_type': 'cities' });
    $('#add_barangay').ph_locations({ 'location_type': 'barangays' });

    $("#add_birthplace_region").ph_locations({ 'location_type': 'regions' })
    $('#add_birthplace_province').ph_locations({ 'location_type': 'provinces' });
    $('#add_birthplace_municipality').ph_locations({ 'location_type': 'cities' });

    $("#add_birthplace_region").ph_locations('fetch_list');
    $('#add_region').ph_locations('fetch_list');
});

