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
$banner = "Welcome";
$desc = "Home Page of QualityLife";
require("./header.php");

if (empty($_SESSION['username_s'])){
    header('Location: 405.php');
    ob_flush();  //Flush output buffer
}
?>
<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>
 <div class="row">
        <div class="col l12 mt-4">
        <div class="card cyan lighten-1 z-depth-4 hoverable">
            <div class="card-content">
            <span class="card-title center-align">WELCOME <?php echo $_SESSION['username_s']; ?></span>
            <div class="container home-hero">
                <h6>If you are thinking of buying a home working with a QUALITY LIFE should be your first step. REALTOR.ca can connect you to QUALITY LIFE across Canada and help find the right home for you.<br/>
                    Start your property search with the fully redesigned QUALITY-LIFE.ca app for Android.
                </h6>
            </div>
            </div>
            <div class="card-action center">   
                <a href="listing_search.php" class=" waves-effect waves-light btn blue lighten-4 z-depth-5 cyan-text text-darken-4 transition-1">Listing</a>
            </div>
        </div>
        </div>
</div>
<script type="text/javascript">
    var myVar = setTimeout(cookies_message, 3000);
    
    function cookies_message() {
        <?php
        $cookies_message = $_SESSION['cookies_message'];
        foreach($cookies_message as $cookie_message)
        {
            // $cookie_message = "<div class='red_alert'>".$cookie_message."</div>";
            echo "M.toast({html: '".$cookie_message."', classes:'red'})";
        }
        ?>
    }
</script>
<?php
require("./footer.php");
?>