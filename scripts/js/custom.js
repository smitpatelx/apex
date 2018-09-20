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