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
require('header.php');

if (empty($_SESSION['username_s']) || $_SESSION['user_type_s'] != AGENT){
    header('Location: login.php');
    ob_flush();  //Flush output buffer
}
?>

<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>

    <div class='grid-x'>
        <h2 class='cell medium-5 medium-offset-4 center red-text dosis'>Create New Post</h2>
        <form class='cell medium-5 medium-offset-4 center row' action="dashboard_post_save.php" method='post' enctype="multipart/form-data" >
            <div class="input-field col s12">
                <input type="text" id='heading' name="dsh_post_head" class="validate"/>
                <label for="heading">Post Heading</label>
            </div>
            <div class="input-field col s6">
                <input type="text" id='location' name="dsh_post_location" class="validate"/>
                <label for="location">Location</label>
            </div>
            <div class="input-field col s6">
                <input type="text" id='price' name="dsh_post_price" class="validate"/>
                <label for="price">Price</label>
            </div>
            <div class="input-field col s6">
                <input type="text" id='total_area' name="dsh_post_area" class="validate"/>
                <label for="total_area">Total Area</label>
            </div>
            <div class="input-field col s6">
                <input type="text" id='contact' name="dsh_post_contact" class="validate"/>
                <label for="contact">Contact</label>
            </div>
            <h5 class="m-2">Upload one or more files</h5>
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="dsh_post_file1"/>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" id="Upload_one_or_more_files" name="dsh_post_file1"/>                               
                </div>
            </div>
            <div class='input-field col s12 center'>
                <!-- <input type="submit" class="btn waves-effect waves-light cayan lighten-1" name="submit"> -->
                <button class="btn waves-effect waves-light cayan lighten-1" name="dsh_post_submit" type="submit">
                    POST <i class="fas fa-check"></i> 
                </button>
            </div>
        </form>                    
    </div>

<?php
require("./footer.php");
?>
