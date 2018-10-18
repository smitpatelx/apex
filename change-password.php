<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

$title = "Change Password";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Change Password";
$desc = "Change Password Page of QualityLife";

require('header.php');

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
  
  <div class='grid-x mt-4'>
      <form class='cell medium-5 medium-offset-4 center row' action='dashboard.php'>
          <h2 class='col s12 m12 l12 center red-text dosis'>Change Password</h2>
          <div class="input-field col s12 m12 l12 center">
              <input placeholder="Current Password" name="current_password" id="current_password" type="password" class="validate">
              <label for="current_password">Current Password</label>
          </div>
          <div class="input-field col s12 m12 l12 center">
              <input placeholder="New Password" name="new_password" id="new_password" type="password" class="validate">
              <label for="new_password">New Password</label>
          </div>
          <div class="input-field col s12 m12 l12 center">
              <input placeholder="Confirm Password" name="conform_password" id="conform_password" type="password" class="validate">
              <label for="conform_password">Confirm Password</label>
          </div>
          <div class='input-field col s12 m12 l12 center'>
              <button class="btn waves-effect waves-light cayan lighten-1" type="submit" name="action">
                  <i class="fas fa-lock"></i> PROCEED
              </button>
          </div>
      </form>
  </div>
<?php
require("./footer.php");
?>
