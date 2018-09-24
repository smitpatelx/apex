Splitting();

$(document).ready(function () {
    $('.sidenav').sidenav();
});

$(document).ready(function () {
    $('.carousel').carousel({
        fullWidth: true,
        indicators: true
    });
});

$(document).ready(function () {
    $('.modal').modal();
});

$(document).ready(function () {
    $('.tabs').tabs();
});

$(document).ready(function () {
    $('.slider').slider();
});

$body = $("body");

$(document).on({
    ajaxStart: function () { $body.addClass("loading_wrap"); },
    ajaxStop: function () { $body.removeClass("loading_wrap"); }
});

$('.preloader-background').delay(1400).fadeOut('slow');

$('.loading-text')
    .delay(1350)
    .fadeOut();
$('.preloader-wrapper')
    .delay(1350)
    .fadeOut();

AOS.init();

$(".post_dashboard").hide(0);
$(".welcome_dashboard").show(0);
$(".pass_dashboard").hide(0);
$(".users_dashboard").hide(0);
$(document).ready(function () {
    $(".postbtn_dashboard").click(function () {
        $(".post_dashboard").show(1000); 
        $(".welcome_dashboard").hide(1000);
        $(".pass_dashboard").hide(1000);
        $(".users_dashboard").hide(1000);
    });
    $(".passbtn_dashboard").click(function () {
        $(".post_dashboard").hide(1000);
        $(".welcome_dashboard").hide(1000);
        $(".pass_dashboard").show(1000);
        $(".users_dashboard").hide(1000);
    });
    $(".usersbtn_dashboard").click(function () {
        $(".post_dashboard").hide(1000);
        $(".welcome_dashboard").hide(1000);
        $(".pass_dashboard").hide(1000);
        $(".users_dashboard").show(1000);
    });
    $(".welcomebtn_dashboard").click(function () {
        $(".post_dashboard").hide(1000);
        $(".welcome_dashboard").show(1000);
        $(".pass_dashboard").hide(1000);
        $(".users_dashboard").hide(1000);
    });
});