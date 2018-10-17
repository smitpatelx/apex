<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

$title = "Register";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Register";
$desc = "Dashboard Page of QualityLife";

require('header.php');
?>
<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>
<?php
  //LOGIN FUNCTIONALITY
  //Authors: Blake, Dylan
  $errors = [];

  if ($_SERVER["REQUEST_METHOD"] == "GET")
  {
    //default for when page loads first time

    //initialize variables to be echo'ed into the 
    $username = "";
    $firstname = "";
    $lastname = "";
    $email = "";
    $password = "";
    $user_type = "";

  } else if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $firstname = trimT('first_name');
    $lastname = trimT('last_name');
    $username = trimT('user_name');
    $email = trimT('email');
    $password = trimT('password');
    $user_type = trimT('user_type');
    $enrol_date= date("Y-m-d",time());
    
    if (isset($firstname) && isset($lastname) && isset($username) && isset($user_type) && isset($email) && isset($password) ) {

      if (($firstname != "") && ($lastname != "") && ($username != "") && ($user_type != "") && ($email != "") && ($password != "") ) {

          $password = hashmd5($password);
          $conn = db_connect();
          $sql_u = "SELECT * FROM users WHERE user_name='$username'";
          $sql_e = "SELECT * FROM users WHERE email_address='$email'";
          $res_u = pg_query($conn, $sql_u);
          $res_e = pg_query($conn, $sql_e);

          if (pg_num_rows($res_u) > 0) {
            $errors[] = "Sorry... username already taken"; 	
          }else if(pg_num_rows($res_e) > 0){
            $errors[] = "Sorry... email already taken";      	
          }   
          else if (empty($errors)){
            
            $user_redirection = "";
            //check user_type
            if ($user_type == AGENT)
            {
              $user_redirection = "dashboard.php";
            }
            else if ($user_type == CLIENT)
            {
              $user_redirection = "welcome.php";
            }

            $save = "INSERT INTO users (first_name, last_name, user_name, email_address, password, user_type, enrol_date, last_access) 
                VALUES ('".$firstname."', '".$lastname."', '".$username."', '".$email."', '".$password."', '".$user_type."', '".$enrol_date."' ,'".$enrol_date."')";
            $results = pg_query($conn, $save);
            $_SESSION['username_s'] = $username;
            $_SESSION['user_type_s'] = $user_type;
            header('Location: '.$user_redirection.'');
            ob_flush();  //Flush output buffer
            
            }
            else
            {
              $errors[] = "Something went wrong! Try Again";
            }
      
        } 
        else 
        {
        $errors[] = "Make sure any input field is not blank";       
        }

      } 
      else 
      {
        $errors[] = "Input all fields and try again.";       
      }
  }
  //output error as Toast (java script)
  foreach($errors as $error)
  {
    echo "<script>M.toast({html: '".$error."'})</script>";
  }

?>

<div class="grid-x center m-3">
      <div id="sign-up" class="col s12 cell large-8 large-offset-2">
        <div class="row my-4">
        <form class="col s12" method ="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="on">
          <div class="row">
            <div class="input-field col s6">
              <input placeholder="First Name" id="first_name" name="first_name" type="text" class="validate" value="<?php echo $firstname; ?>">
              <label class="active" for="first_name">First Name</label>
            </div>
            <div class="input-field col s6">
              <input placeholder="Last Name" id="last_name" name="last_name" type="text" class="validate" value="<?php echo $lastname; ?>">
              <label for="last_name">Last Name</label>
            </div>
          </div>
           <div class="row">
            <div class="input-field col s12">
              <input id="username" type="text" name="user_name" class="validate" value="<?php echo $username; ?>">
              <label for="username">User Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="email" name="email" type="email" class="validate" value="<?php echo $email; ?>">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="password" type="password" name="password" class="validate" value="<?php echo $password; ?>">
              <label for="password">Password</label>
            </div>
            <div class="input-field col s6">
              <select name="user_type">
                <!-- <option value=" " disabled selected>Choose User Type</option> -->
                <option value="c">Clients</option>
                <option value="a">Agent</option>
              </select>
              <label>Choose User Type</label>
            </div>
          </div>         
          <div class="row">
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light blue lighten-1" type="submit" name="signup">Sign Up
                    <i class="fas fa-user-plus"></i>
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