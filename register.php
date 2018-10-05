<?php
/*************
Front End: Smit Patel
Backend: Blake Philips, Dylan Lopez
Lab 10: Database/PHP Lab - User Registration
October 2, 2018
WEBD3201
**************/

$title = "Register";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Register";
$desc = "Dashboard Page of QualityLife";

require('header.php');
?>

<?php
//LOGIN FUNCTIONALITY
//Authors: Blake, Dylan
 
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
  //default for when page loads first time

  //initialize variables to be echo'ed into the 
  $username = "User Name";
  $firstname = "First Name";
  $lastname = "Last Name";
  $email = "Email";
  $password = "";

  //holds class info for login/register, to be changed for sticky forms so the currently used form will be showed, so you won't need to needlessly switch to the form every time
  $loginClassInfo = "active blue-text";
  $registerClassInfo = "blue-text";


} else if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $username = "User Name";
  $firstname = "First Name";
  $lastname = "Last Name";
  $email = "Email";
  $password = "";


  $loginClassInfo = "active blue-text";
  $registerClassInfo = "blue-text";
  //if a frm submit(post) is recieved

  //get requestType (if it is a login, or register) and store in variable
  $requestType = $_POST['requestType'];

  //if a login request is recieved
  if ($requestType == "login")
  {
    if (isset($_POST['email']) && isset($_POST['password']))
    {
      $email = trim($_POST['email']);
      $password = trim($_POST($_POST['password']));


      //todo
      //  do something with the data
    }    


  } 
  //if a register request is recieved
  else if ($requestType == "register")
  {

    $loginClassInfo = "blue-text";
    //make the register form the currently active form
    $registerClassInfo = "active blue-text";

    //gathering posted data
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
      $firstname = trim($_POST['first_name']);
      $lastname = trim($_POST['last_name']);
      $email = trim($_POST['email']);
      $password = trim($_POST['password']);


      //todo
      //  do something with the data



    } else {
      echo "Something went wrong! Input all fields and try again.";
    }

  }
  

}


?>

<div class="grid-x center">

      <div id="sign-up" class="col s12 cell large-8 large-offset-2">
        <div class="row my-4">
        <form class="col s12" method = "post">
          <div class="row">
            <div class="input-field col s6">
              <input type="hidden" id="requestType" name="requestType" value="register"> 
              <input placeholder="First Name" value = "<?php echo $firstname; ?>" id="first_name" name="first_name" type="text" class="validate">
              <label class="active" for="first_name">First Name</label>
            </div>
            <div class="input-field col s6">
              <input placeholder="Last Name" value = "<?php echo $lastname; ?>" id="last_name" name="last_name" type="text" class="validate">
              <label for="last_name">Last Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="password" type="password" name="password" class="validate">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="email" name="email" value = "<?php echo $email; ?>" type="email" class="validate">
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

</div>

<?php
require("./footer.php");
?>