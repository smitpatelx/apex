<?php
/*************
FILE: 						login.php
TITLE:						Apex Listings - User Login Page
AUTHORS:					Blake Phillips, Clayton Galliah-Penhale, Dylan Lopez, Smit Patel
LAST MODIFIED BY: Dylan Lopez
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
**************/
$title = "Login Page";
$file = "login.php";
$date = "October 2 2018";
$banner = "Log in";
$desc = "Login Page of Apex";
require("./header.php");
?>

<?php
//LOGIN FUNCTIONALITY
//Authors: Blake, Dylan

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
  //default for when page loads first time

  //initialize variables to be echo'ed into the
  $login = ""; // DL - initializing login id variable
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
      $login = trim($_POST['id_login']); // DL - added variable to hold id to be retreived from the form
      $email = trim($_POST['email']);
      $password = trim($_POST['password']);


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
      $lastaccess = trim($_POST['last_access'])
      //$password = trim($_POST['password']);

      // Connecting the database using predefined function
      $dbconn = db_connect();

      // Preparing query for execution
      $stmtLastAccess = pg_prepare($dbconn, 'my_query', "UPDATE users
                                              SET last_access = '".date("Y-m-d",time())."'
                                              WHERE id = $1 AND password = $2");

      // Execute the prepared query

    } else {
      echo "Something went wrong! Input all fields and try again.";
    }

  }


}


?>

<div class="grid-x center">

        <ul id="tabs-swipe-demo col l4 offset-4" class="tabs center">
            <li class="tab center"><a class="<?php echo $loginClassInfo;?>" href="#sign-in">Sign In</a></li>
            <li class="tab center"><a href="#sign-up" class="<?php echo $registerClassInfo; ?>">Sign UP</a></li>
        </ul>

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


      <div id="sign-in" class="col s12 cell large-8 large-offset-2">
        <div class="cell large-4 large-offset-4 row">
        <form class="col s12" method = "post">
          <div class="row">
            <div class="input-field col s12">
            <input type="hidden" id="requestType" name="requestType" value="login">
              <input id="email" name="email" type="email" class="validate" value = "<?php echo $email; ?>">
              <label for="email">Email</label>
            </div>
          </div>

        <div class="row">
            <div class="input-field col s12">
              <input id="password" name="password" type="password" class="validate">
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
