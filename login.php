<?php
/*************
Smit Patel
Lab 10: Database/PHP Lab - User Registration
09 April 2018
WEBD2201
**************/
$title = "Admin";
$file = "index.php";
$date = "Sept 14 2018";
$banner = "ADMIN";
$desc = "Admin Page of QualityLife";
require("./header.php");
?>

<div class="grid-x center">

        <ul id="tabs-swipe-demo col l4 offset-4" class="tabs center">
            <li class="tab center"><a class="active" href="#sugn-up">Sign In</a></li>
            <li class="tab center"><a href="#sign-in">Sign UP</a></li>
        </ul>

      <div id="sign-in" class="col s12 cell large-8 large-offset-2">
        <div class="row my-4">
        <form class="col s12" action="welcome.php">
          <div class="row">
            <div class="input-field col s6">
              <input placeholder="First Name" id="first_name" type="text" class="validate">
              <label for="first_name">First Name</label>
            </div>
            <div class="input-field col s6">
              <input placeholder="Last Name" id="last_name" type="text" class="validate">
              <label for="last_name">Last Name</label>
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
              <input id="email" type="email" class="validate">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light blue lighten-1" type="submit" name="action">Sign Up
                    <i class="material-icons right">send</i>
                </button>
            </div>
          </div>
           

        </form>
      </div>
      </div>


      <div id="sugn-up" class="col s12 cell large-8 large-offset-2">
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

 
</div>

<?php
require("./footer.php");
?>