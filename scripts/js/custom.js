Splitting();

$(document).ready(function () {
    $('.sidenav').sidenav();
    $('.carousel').carousel({
        fullWidth: true,
        indicators: true
    });
    $('.modal').modal();
    $('.tabs').tabs();
    $('.slider').slider();
    $(".posts_search").dispatchEvent("input");
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
        $(".post_dashboard").show(400); 
        $(".welcome_dashboard").hide(400);
        $(".pass_dashboard").hide(400);
        $(".users_dashboard").hide(400);

        
        setTimeout(function(){
            $.get("dashboard_search.php", { "search": "%" }, function ($data) {
                $(".result").html($data);
            });
        },600);
    });
    $(".passbtn_dashboard").click(function () {
        $(".post_dashboard").hide(400);
        $(".welcome_dashboard").hide(400);
        $(".pass_dashboard").show(400);
        $(".users_dashboard").hide(400);
    });
    $(".usersbtn_dashboard").click(function () {
        $(".post_dashboard").hide(400);
        $(".welcome_dashboard").hide(400);
        $(".pass_dashboard").hide(400);
        $(".users_dashboard").show(400);
    });
    $(".welcomebtn_dashboard").click(function () {
        $(".post_dashboard").hide(400);
        $(".welcome_dashboard").show(400);
        $(".pass_dashboard").hide(400);
        $(".users_dashboard").hide(400);
    });
});


    $(".posts_search").on("input", function() {
        $search = $(".posts_search").val();
        if($search.length>0){
            $.get("dashboard_search.php", { "search": $search }, function ($data) {
                $(".result").html($data);
            })
        }
        else if ($search.length == 0)
        {
            $.get("dashboard_search.php", { "search": "%" }, function ($data) {
                $(".result").html($data);
            })
        }
    });