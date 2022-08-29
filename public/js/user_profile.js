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
    $("#contact_display_edit").hide();
    $("#family_info_display_edit").hide();
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

function places_display_edit() {
    $("#places_lived_display").hide();
    $("#places_display_edit").show();
}

function updatePlacesLivedInfo() {
    $.ajax({
        type: 'post',
        "_token": $('#token').val(),
        url: sBASEURL + "savePlacesLived",
        data: $('#places_lived_display_edit_form').serialize(),
        success: function() {
            alert('Data updated successfully');
            window.location.reload();
        }
    });
}

function delete_places(id) {
    let text = "Are you sure you want to delete this record?";
    if (confirm(text) == true) {
        $.ajax({
            type: "POST",
            url: sBASEURL + "deletePlacesLived",
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

function modal_placeslived(id) {
    $.ajax({
        type: "POST",
        url: sBASEURL + "getPlacesLived",
        data: {
            id: id,
            _token: '{{csrf_token()}}'
        },
        success: function(data) {
            var data = jQuery.parseJSON(data);
            $("#placeslived_description_modal").val(data.description);
            $("#type_placeslived_modal").val(data.type);
            $("#placeslived_id").val(id);
        },
        error: function(data, textStatus, errorThrown) {
            console.log(data);
        },
    });
}

function placeslivedModalDataUpdate() {
    $.ajax({
        type: "POST",
        url: sBASEURL + "modalUpdatePlacesLived",
        data: {
            id: $("#placeslived_id").val(),
            type_modal: $("#type_placeslived_modal").val(),
            places_description_modal: $("#placeslived_description_modal").val(),
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

function contact_display_edit() {
    $("#contact_info_display").hide();
    $("#contact_display_edit").show();
}

function updateContactInfo() {
    $.ajax({
        type: 'post',
        "_token": $('#token').val(),
        url: sBASEURL + "saveContact",
        data: $('#contact_display_edit_form').serialize(),
        success: function() {
            alert('Data updated successfully');
            window.location.reload();
        }
    });
}

function family_display_edit() {
    $("#family_info_display").hide();
    $("#family_info_display_edit").show();
}

function updateFamilyInfo() {
    var data = new FormData();

    //Form data
    var form_data = $('#family_display_edit_form').serializeArray();
    $.each(form_data, function (key, input) {
        data.append(input.name, input.value);
    });

    //File data
    var file_data = $('input[name="family_pic"]')[0].files;
    for (var i = 0; i < file_data.length; i++) {
        data.append("family_pic[]", file_data[i]);
    }

    //Custom data
    data.append('key', 'value');

    $.ajax({
        "_token": $('#token').val(),
        url: sBASEURL + "saveFamily",
        method: "post",
        processData: false,
        contentType: false,
        data: data,
        success: function (data) {
            alert('Data updated successfully');
            window.location.reload();
        },
        error: function (e) {
            //error
        }
    });
}

function delete_family(id) {
    let text = "Are you sure you want to delete this record?";
    if (confirm(text) == true) {
        $.ajax({
            type: "POST",
            url: sBASEURL + "deleteFamily",
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

function modal_family(id) {
    $.ajax({
        type: "POST",
        url: sBASEURL + "getFamily",
        data: {
            id: id,
            _token: '{{csrf_token()}}'
        },
        success: function(data) {
            var data = jQuery.parseJSON(data);
            $("#modal_family_name").val(data.name);
            $("#modal_family_relation").val(data.relation);
            $("#modal_family_id").val(id);
        },
        error: function(data, textStatus, errorThrown) {
            console.log(data);
        },
    });
}

function familyModalDataUpdate() {
    var data = new FormData();

    //Form data
    var form_data = $('#editFamilyModalForm').serializeArray();
    alert(form_data);
    $.each(form_data, function (key, input) {
        data.append(input.name, input.value);
    });

    //File data
    var file_data = $('input[name="modal_family_pic"]')[0].files;
    for (var i = 0; i < file_data.length; i++) {
        data.append("modal_family_pic[]", file_data[i]);
    }

    //Custom data
    data.append('key', 'value');

    $.ajax({
        "_token": $('#token').val(),
        url: sBASEURL + "updateFamily",
        method: "post",
        processData: false,
        contentType: false,
        data: data,
        success: function (data) {
            alert('Data updated successfully');
            window.location.reload();
        },
        error: function (e) {
            //error
        }
    });
}

function delete_photo(id,url){
    let text = "Are you sure you want to delete this photo?";
    if (confirm(text) == true) {
        $.ajax({
            type: "POST",
            url: sBASEURL + "deletePhoto",
            data: {
                id: id,
                url: url,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                alert("Deleted successfully");
                window.location.reload();
            },
            error: function(data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    } else {}
}

$(document).ready(function(){
    // File upload via Ajax
    $("#uploadForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: sBASEURL + "uploadPhoto",  
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#uploadStatus').html('<img src="images/uploading.gif"/>');
            },
            error:function(){
                $('#uploadStatus').html('<span style="color:#EA4335;">Images upload failed, please try again.<span>');
            },
            success: function(data){
                $('#uploadForm')[0].reset();
                $('#uploadStatus').html('<span style="color:#28A74B;">Images uploaded successfully.<span>');
                //$('.gallery').html(data);
                window.location.reload();
            }
        });
    });
    
    // File type validation
    $("#fileInput").change(function(){
        var fileLength = this.files.length;
        var match= ["image/jpeg","image/png","image/jpg","image/gif"];
        var i;
        for(i = 0; i < fileLength; i++){ 
            var file = this.files[i];
            var imagefile = file.type;
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))){
                alert('Please select a valid image file (JPEG/JPG/PNG/GIF).');
                $("#fileInput").val('');
                return false;
            }
        }
    });
});