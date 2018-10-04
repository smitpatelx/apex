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
    $('.parallax').parallax();
    $('select').formSelect();
});
//MATERIALIZE @end

//FOR LOADING SCREEN 
$body = $("body");

$(document).on({
    ajaxStart: function () {
        $body.addClass("loading_wrap");
    },
    ajaxStop: function () {
        $body.removeClass("loading_wrap");
    }
});

// $(window).on('load', function () {
//     $('.preloader-background').delay(1400).fadeOut('slow');

//     $('.loading-text')
//         .delay(1350)
//         .fadeOut('slow');
//     $('.preloader-wrapper')
//         .delay(1350)
//         .fadeOut('slow');
// });

//FOR LOADING SCREEN  @end

//ON SCROLL ANIMATION
AOS.init({
    offset: 0,
    duration: 1000
});
//ON SCROLL ANIMATION @end

//FOR DASHBOARD
$(".post_dashboard").hide(0);
$(".welcome_dashboard").delay(1400).show();
$(".pass_dashboard").hide(0);
$(".users_dashboard").hide(0);
$(".create_post_dashboard").hide(0);
$(".dashboard_loader").delay(1400).fadeOut('slow');

$(document).ready(function () {
    $(".postbtn_dashboard").click(function () {
        $(".dashboard_loader").show();
        $(".create_post_dashboard").hide(400);
        $(".dashboard_loader").delay(1400).fadeOut('slow');
        $(".welcome_dashboard").hide(400); 
        $(".pass_dashboard").hide(400);
        $(".users_dashboard").hide(400);
        $(".post_dashboard").delay(1400).fadeIn(1000);
        $(".result").fadeIn(2000);
        $(".users_result").hide(400);

        //FOR LIVE SEARCH ON DASHBOARD
        setTimeout(function () {
            $.get("dashboard_search.php", {
                "search": "%"
            }, function ($data) {
                $(".result").html($data);
            });
        }, 600);
        //FOR LIVE SEARCH ON DASHBOARD @end
    });
    $(".passbtn_dashboard").click(function () {
        $(".create_post_dashboard").hide(400);
        $(".dashboard_loader").show();
        $(".dashboard_loader").delay(1400).fadeOut('slow');
        $(".post_dashboard").hide(400);
        $(".welcome_dashboard").hide(400);
        $(".pass_dashboard").fadeIn(1000);
        $(".users_dashboard").hide(400);
        $(".result").hide(400);
        $(".users_result").hide(400);
        
    });
    $(".usersbtn_dashboard").click(function () {
        $(".create_post_dashboard").hide(400);
        $(".dashboard_loader").show();
        $(".dashboard_loader").delay(1400).fadeOut('slow');
        $(".post_dashboard").hide(400);
        $(".welcome_dashboard").hide(400);
        $(".pass_dashboard").hide(400);
        $(".users_dashboard").fadeIn(1000);
        $(".users_result").fadeIn(2000);
        $(".result").hide(400);

        //FOR LIVE SEARCH USERS DASHBOARD
        setTimeout(function() {
                $.get("dashboard_user_results.php", {
                    "search7": "%"
                }, function ($data) {
                    $(".users_result").html($data);
                })
            
        }, 600);
        //FOR LIVE SEARCH USERS DASHBOARD @end
    });
    $(".welcomebtn_dashboard").click(function () {
        $(".create_post_dashboard").hide(400);
        $(".dashboard_loader").show();
        $(".dashboard_loader").delay(1400).fadeOut('slow');
        $(".post_dashboard").hide(400);
        $(".welcome_dashboard").fadeIn(1000);
        $(".pass_dashboard").hide(400);
        $(".users_dashboard").hide(400);
        $(".result").hide(400);
        $(".users_result").hide(400);
        
    });
    $(".newpostbtn_dashboard").click(function () {
        $(".create_post_dashboard").fadeIn(1000);
        $(".dashboard_loader").show();
        $(".dashboard_loader").delay(1400).fadeOut('slow');
        $(".post_dashboard").hide(400);
        $(".welcome_dashboard").hide(400);
        $(".pass_dashboard").hide(400);
        $(".users_dashboard").hide(400);
        $(".result").hide(400);
        $(".users_result").hide(400);

    });
});
//FOR DASHBOARD @end
$('.btn_toogle_disable').on('click', function () {
    $('.toogle_disable input').prop('disabled', function (i, v) {
        return !v;
    });
})
//FOR LIVE SEARCH ON DASHBOARD
$(".posts_search").on("input", function () {
    $search = $(".posts_search").val();
    if ($search.length > 0) {
        $.get("dashboard_search.php", {
            "search": $search
        }, function ($data) {
            $(".result").html($data);
        })
    } else if ($search.length == 0) {
        $.get("dashboard_search.php", {
            "search": "%"
        }, function ($data) {
            $(".result").html($data);
        })
    }
});
//FOR LIVE SEARCH ON DASHBOARD @end
$('.slides').slick({
    infinite: true,
    speed: 600,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    fade: true,
    autoplaySpeed: 4000,
    pauseOnHover: false,
    pauseOnFocus: false,
    dots: false,
    arrows: false,
    mobileFirst: true
});

$(document).ready(function () {
    var path = window.location.pathname.split("/").pop();

    // Account for home page with empty path
    if (path == '') {
        path = 'index.php';
    }

    var target = $('#nav-mobile a[href="' + path + '"]');
    // Add active class to target link
    target.addClass('nav_active');
})

//LISTING

//LISTING @end

