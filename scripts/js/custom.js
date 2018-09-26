//FOR SPLITTING JS
Splitting();
//FOR SPLITTING JS @end

//MATERIALIZE
$(document).ready(function () {
    $('.sidenav').sidenav();
    $('.carousel').carousel({
        fullWidth: true,
        indicators: true
    });
    $('.modal').modal();
    $('.tabs').tabs();
    $('.slider').slider();
});
//MATERIALIZE @end

//FOR LOADING SCREEN 
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
//FOR LOADING SCREEN  @end

//ON SCROLL ANIMATION
AOS.init();
//ON SCROLL ANIMATION @end

//FOR DASHBOARD
$(".post_dashboard").hide(0);
$(".welcome_dashboard").show(0);
$(".pass_dashboard").hide(0);
$(".users_dashboard").hide(0);
$(document).ready(function () {
    $(".postbtn_dashboard").click(function () {
         
        $(".welcome_dashboard").hide(400);
        $(".pass_dashboard").hide(400);
        $(".users_dashboard").hide(400);
        // $(".post_dashboard").show(300);
        $(".post_dashboard").fadeIn(1000);
        // $(".post_dashboard").scroll();
        // $(".result").show(1000);
        $(".result").fadeIn(2000);

        //FOR LIVE SEARCH ON DASHBOARD
        setTimeout(function(){
            $.get("dashboard_search.php", { "search": "%" }, function ($data) {
                $(".result").html($data);
            });
        },600);
        //FOR LIVE SEARCH ON DASHBOARD @end
    });
    $(".passbtn_dashboard").click(function () {
        $(".post_dashboard").hide(400);
        $(".welcome_dashboard").hide(400);
        // $(".pass_dashboard").show(300);
        $(".pass_dashboard").fadeIn(1000);
        // $(".pass_dashboard").scroll();
        $(".users_dashboard").hide(400);
        $(".result").hide(400);
    });
    $(".usersbtn_dashboard").click(function () {
        $(".post_dashboard").hide(400);
        $(".welcome_dashboard").hide(400);
        $(".pass_dashboard").hide(400);
        // $(".users_dashboard").show( 300);
        $(".users_dashboard").fadeIn(1000);
        $(".result").hide(400);
        // $(".users_dashboard").scroll();
    });
    $(".welcomebtn_dashboard").click(function () {
        $(".post_dashboard").hide(400);
        // $(".welcome_dashboard").show(300);
        $(".welcome_dashboard").fadeIn(1000);
        // $(".welcome_dashboard").scroll();
        $(".pass_dashboard").hide(400);
        $(".users_dashboard").hide(400);
        $(".result").hide(400);
    });
});
//FOR DASHBOARD @end

//FOR LIVE SEARCH ON DASHBOARD
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
//FOR LIVE SEARCH ON DASHBOARD @end