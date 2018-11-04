<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->

<?php

$title = "Listing Create";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Listing Create";
$desc = "Dashboard Page of QualityLife";

if (empty($_SESSION['username_s']) || $_SESSION['user_type_s'] != ADMIN || $_SESSION['user_type_s'] != AGENT){
    header('Location: login.php');
    ob_flush();  //Flush output buffer
}
?>

<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>


<?php
require("./footer.php");
?>
