<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->

<?php

$title = "Privacy Policy";
$file = "privacy_policy.php";
$date = "Sept 14 2018";
$banner = "Privacy Policy";
$desc = "Dashboard Page of QualityLife";
require("./header.php");


?>

<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>

 <div class='row my-4 black-text'>
    <h4 class='col l12 black-text center'>&copy; Copyright Info</h4>
    <h5 class='col l12 black-text left-align'>This website must not use for personal or commercial purpose without permission. <br/>   
        This project is created as per the requirements mentioned in
        <a href='http://opentech2.durhamcollege.org/pufferd/webd3201/'>Course WEBD3201</a>
    </h5>
    <h4 class='col l12 black-text center'> Privacy Info</h4>
    <h5 class='col l12 black-text left-align'><br/>We believe in strict copyright rules. <br/>
    All user's information will remain private.<br/>
    This website is secure and easy to use.<br/>     
    </h5>
</div>
<?php
require("./footer.php");
?>