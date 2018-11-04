<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

$title = "Home";
$file = "index.php";
$date = "Sept 14 2018";
$banner = "HOME";
$desc = "Home Page of QualityLife";
require("./header.php");
?>
    <script type="text/javascript">       
        $(window).on('load', function () {
            $('.preloader-background').delay(1400).fadeOut('slow');

            $('.loading-text')
                .delay(1350)
                .fadeOut('slow');
            $('.preloader-wrapper')
                .delay(1350)
                .fadeOut('slow');
        });      
    </script>
    <div class="grid-x">
        <div class="cell large-12 medium-12 small-12 home_hero">
            <!-- <img src="./assets/bg/bg_dashboard.svg" alt="bg"> -->
            <div id="particles-js1"></div>
            <h1 class="dosis center white-text" data-aos="fade-up" data-aos-delay="2300" data-aos-duration="1500" data-splitting>APEX</h1>
            <p class="dosis center white-text" data-aos="fade-down" data-aos-delay="2300" data-aos-duration="1500" data-splitting>
                This project is created as per the requirements mention in
                <a href="http://opentech2.durhamcollege.org/pufferd/webd3201/" class="blue-text text-lighten-3">Course WEBD3201</a> .
                This website uses technologies like HTML, PHP, SCSS, Jquery, Materialize CSS . This is the real estate website which will show 
                houses from 7 cities, which includes - Ajax, Brooklin, Bowmanville, Oshawa, Pickring, Port Perry, Whitby.
            </p>
            <div class="center">
                <a data-aos="flip-up"  data-aos-delay="2300" data-aos-duration="1500" href="listing.php" class="waves-effect z-depth-5 home_btn transition-2">Discover More</a>
                <a data-aos="flip-down" data-aos-delay="2300" data-aos-duration="1500" class="modal-trigger waves-effect z-depth-5 home_btn transition-2" href="#modal1">&copy; Copyright</a>
            </div>
        </div>
    
        <div class="cell large-12 medium-12 small-12 slides slides_home">
            <img src="./assets/illustrations/1a.jpg" alt="bg"/>
            <img src="./assets/illustrations/2a.jpg" alt="bg"/>
            <img src="./assets/illustrations/3a.jpg" alt="bg"/>
        </div>
    </div>


    
    
<?php
require("./footer.php");
?>