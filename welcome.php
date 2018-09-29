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
$banner = "Welcome";
$desc = "Home Page of QualityLife";
require("./header.php");
?>

 <div class="row">
        <div class="col l12 mt-4">
        <div class="card cyan lighten-1 z-depth-4 hoverable">
            <div class="card-content">
            <span class="card-title center-align">WELCOME</span>
            <div class="container home-hero">
                <h6>If you are thinking of buying a home working with a QUALITY LIFE should be your first step. REALTOR.ca can connect you to QUALITY LIFE across Canada and help find the right home for you.<br/>
                    Start your property search with the fully redesigned QUALITY-LIFE.ca app for Android.
                </h6>
            </div>
            </div>
            <div class="card-action center">
            <a href="dashboard.php" class="waves-effect waves-light btn blue lighten-4 z-depth-5 cyan-text text-darken-4 transition-1">Dashboard</a>
            <a href="listing.php" class=" waves-effect waves-light btn blue lighten-4 z-depth-5 cyan-text text-darken-4 transition-1" href="#modal1">Listing</a>
            </div>
        </div>
        </div>
</div>

<?php
require("./footer.php");
?>