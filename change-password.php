<?php
/*
FILE:                   login.php
TITLE:                  Apex Listings - User Login Page
AUTHORS:                Blake Phillips, Smit Patel, Clayton Galliah-Penhale, Dylan Lopez
LAST MODIFIED:          October 4, 2018
DESCRIPTION:            Allows users to login to their profiles or allows new users to create an account
**/


$title = "Change Password";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Change Password";
$desc = "Change Password Page of QualityLife";

require('header.php');
?>

<div class="grid-x center">
      <div id="sign-in" class="col s12 cell large-6 large-offset-3 mt-4">
        <div class="cell large-4 large-offset-4 row">
        <form class="col s12" method = "post">
          <div class="row">
            <div class="input-field col s12">
              <input id="password" name="password" type="password" class="validate">
              <label for="password">Old Password</label>
            </div>
          </div>

        <div class="row">
            <div class="input-field col s12">
              <input id="password" name="password" type="password" class="validate">
              <label for="password">New Password</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light blue lighten-1" type="submit" name="action">Change
                    <i class="fas fa-redo-alt ml-2"></i>
                </button>
            </div>
        </div>

        </form>
      </div>
      </div>
</div>

<?php
require("./footer.php");
?>
