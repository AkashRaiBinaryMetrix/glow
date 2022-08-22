function show_panel(value) {
    var val = value;
    //1-about_display
    //2-work_edu_display
    //3-places_lived_display
    //4-contact_info_display
    //5-family_info_display
    $("#about_display_edit").hide();
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

function about_display_edit() {
    $("#about_display").hide();
    $("#about_display_edit").show();
}

function updateAboutInfo() {
    $.ajax({
        type: 'post',
        url: 'post.php',
        data: $('#about_display_edit_form').serialize(),
        success: function() {
            alert('Form data submitted successfully');
        }
    });
}