<?php
/*************
Smit Patel
Lab 10: Database/PHP Lab - User Registration
09 April 2018
WEBD2201
**************/
$title = "Home";
$file = "index.php";
$date = "Sept 14 2018";
$banner = "HOME";
$desc = "Home Page of QualityLife";
require("./header.php");
?>

    <div class="grid-x">
            <div class="cell large-12 medium-12 small-12 home_hero">
                <img src="./assets/bg/bg_dashboard.svg" alt="bg">
                <h1 class="dosis center white-text" data-aos="fade-up" data-aos-offset="0" data-aos-delay="2500" data-splitting>APEX</h1>
                <p class="dosis center white-text" data-aos="fade-down" data-aos-offset="0" data-aos-delay="2500" data-splitting>If you are thinking of buying a home working with a APEX should be your first step. APEX can connect you
                to APEX across Canada and help find the right home for you.<br />
                Start your property search with the fully redesigned APEX app for Android.</p>
                <div class="center">
                    <a data-aos="flip-up" data-aos-delay="2500"  data-aos-duration="1500" href="listing.php" class="waves-effect z-depth-5 home_btn transition-2">Discover More</a>
                    <a data-aos="flip-down" data-aos-delay="2500" data-aos-duration="1500" class="modal-trigger waves-effect z-depth-5 home_btn transition-2" href="#modal1">&copy; Copyright</a>
                </div>
            </div>
    </div>
    <div class="slides slides_home">
        <img src="./assets/illustrations/1a.jpg" alt="bg">
        <img src="./assets/illustrations/2a.jpg" alt="bg">
        <img src="./assets/illustrations/3a.jpg" alt="bg">
    </div>


    
    
<?php
require("./footer.php");
?>