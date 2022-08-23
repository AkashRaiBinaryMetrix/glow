function show_panel(value) {
    var val = value;
    //1-about_display
    //2-work_edu_display
    //3-places_lived_display
    //4-contact_info_display
    //5-family_info_display
    
    $("#about_display_edit").hide();
    $("#work_edu_display_edit").hide();
    $("#places_display_edit").hide();

    if (val == 1 || val == "1") {
        $("#about_display").show();
        $("#work_edu_display").hide();
        $("#places_lived_display").hide();
        $("#contact_info_display").hide();
        $("#family_info_display").hide();
        $(".section_1").addClass('profile-abactive');
        $(".section_2").removeClass('profile-abactive');
        $(".section_3").removeClass('profile-abactive');
        $(".section_4").removeClass('profile-abactive');
        $(".section_5").removeClass('profile-abactive');
    } else if (val == 2 || val == "2") {
        $("#about_display").hide();
        $("#work_edu_display").show();
        $("#places_lived_display").hide();
        $("#contact_info_display").hide();
        $("#family_info_display").hide();
        $(".section_2").addClass('profile-abactive');
        $(".section_1").removeClass('profile-abactive');
        $(".section_3").removeClass('profile-abactive');
        $(".section_4").removeClass('profile-abactive');
        $(".section_5").removeClass('profile-abactive');
    } else if (val == 3 || val == "3") {
        $("#about_display").hide();
        $("#work_edu_display").hide();
        $("#places_lived_display").show();
        $("#contact_info_display").hide();
        $("#family_info_display").hide();
        $(".section_3").addClass('profile-abactive');
        $(".section_2").removeClass('profile-abactive');
        $(".section_1").removeClass('profile-abactive');
        $(".section_4").removeClass('profile-abactive');
        $(".section_5").removeClass('profile-abactive');
    } else if (val == 4 || val == "4") {
        $("#about_display").hide();
        $("#work_edu_display").hide();
        $("#places_lived_display").hide();
        $("#contact_info_display").show();
        $("#family_info_display").hide();
        $(".section_4").addClass('profile-abactive');
        $(".section_3").removeClass('profile-abactive');
        $(".section_2").removeClass('profile-abactive');
        $(".section_1").removeClass('profile-abactive');
        $(".section_5").removeClass('profile-abactive');
    } else if (val == 5 || val == "5") {
        $("#about_display").hide();
        $("#work_edu_display").hide();
        $("#places_lived_display").hide();
        $("#contact_info_display").hide();
        $("#family_info_display").show();
        $(".section_5").addClass('profile-abactive');
        $(".section_4").removeClass('profile-abactive');
        $(".section_3").removeClass('profile-abactive');
        $(".section_2").removeClass('profile-abactive');
        $(".section_1").removeClass('profile-abactive');
    }
}
//about info
function about_display_edit() {
    $("#about_display").hide();
    $("#about_display_edit").show();
}
//education
function education_display_edit() {
    $("#work_edu_display").hide();
    $("#work_edu_display_edit").show();
}

function updateAboutInfo() {
    $.ajax({
        type: 'post',
        "_token": $('#token').val(),
        url: sBASEURL + "saveAbout",
        data: $('#about_display_edit_form').serialize(),
        success: function() {
            alert('Data updated successfully');
            window.location.reload();
        }
    });
}

function updateEducationInfo() {
    $.ajax({
        type: 'post',
        "_token": $('#token').val(),
        url: sBASEURL + "saveEducation",
        data: $('#work_edu_display_edit_form').serialize(),
        success: function() {
            alert('Data updated successfully');
            window.location.reload();
        }
    });
}

function delete_education(id) {
    let text = "Are you sure you want to delete this record?";
    if (confirm(text) == true) {
        $.ajax({
            type: "POST",
            url: sBASEURL + "deleteEducation",
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                alert("Record deleted successfully");
                window.location.reload();
            },
            error: function(data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    } else {}
}

function modal_education(id) {
    $.ajax({
        type: "POST",
        url: sBASEURL + "getEducation",
        data: {
            id: id,
            _token: '{{csrf_token()}}'
        },
        success: function(data) {
            var data = jQuery.parseJSON(data);
            $("#type_modal").val(data.type);
            $("#edu_description_modal").val(data.description);
            $("#joining_year_modal").val(data.joining_year);
            $("#completion_year_modal").val(data.completion_year);
            $("#education_id").val(id);
        },
        error: function(data, textStatus, errorThrown) {
            console.log(data);
        },
    });
}

function educationModalDataUpdate() {
    $.ajax({
        type: "POST",
        url: sBASEURL + "modalUpdateEducation",
        data: {
            id: $("#education_id").val(),
            type_modal: $("#type_modal").val(),
            edu_description_modal: $("#edu_description_modal").val(),
            joining_year_modal: $("#joining_year_modal").val(),
            completion_year_modal: $("#completion_year_modal").val(),
            _token: '{{csrf_token()}}'
        },
        success: function(data) {
        	alert("Record updated successfully");
            window.location.reload();
        },
        error: function(data, textStatus, errorThrown) {
            console.log(data);
        },
    });
}

function places_display_edit(){
	$("#places_lived_display").hide();
    $("#places_display_edit").show();
}