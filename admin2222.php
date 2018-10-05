<?php
/*************
Smit Patel
Lab 10: Database/PHP Lab - User Registration
09 April 2018
WEBD2201
**************/
$title = "Admin";
$file = "admin.php";
$date = "Sept 14 2018";
$banner = "ADMIN";
$desc = "Admin Page of QualityLife";
require("./header.php");
?>

    <h1 class="center m-4 blue-text text-lighten-2">Admin Login</h1>
    <div class="grid-x center">
        <div class="cell large-4 large-offset-4 row">
          <form class="col s12">
        
            <div class="row">
              <div class="input-field col s12">
                <input id="email" type="email" class="validate">
                <label for="email">Email</label>
              </div>
            </div>

          <div class="row">
              <div class="input-field col s12">
                <input id="password" type="password" class="validate">
                <label for="password">Password</label>
              </div>
          </div>

          <div class="row">
              <div class="input-field col s12">
                  <button class="btn waves-effect waves-light blue lighten-1" type="submit" name="action">Sign In
                      <i class="material-icons right">lock</i>
                  </button>
              </div>
          </div>
          </form>
        </div>
    </div>

<?php
require("./footer.php");
?>