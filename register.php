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

if (!empty($_SESSION['username_s'])){
    $_SESSION['try_register'] = "Logout required for new user registration";
    header('Location: update.php');
    ob_flush();  //Flush output buffer
}
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
    $con_password = "";
    $street_address_1 = "";
    $street_address_2 = "";
    $city = "";
    $postal_code = "";
    $primary_phone_number = "";
    $secondry_phone_number = "";
    $fax_number = "";

  } else if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $firstname = trimT('first_name');
    $lastname = trimT('last_name');
    $username = trimT('user_name');
    $email = trimT('email');
    $password = trimT('password');
    $street_address_1 = trimT('street_address_1');
    $street_address_2 = trimT('street_address_2');
    $city = trimT('city');
    $postal_code = trimT('postal_code');
    $primary_phone_number = trimT('primary_phone_number');
    $secondry_phone_number = trimT('secondry_phone_number');
    $fax_number = trimT('fax_number');
    $con_password = trimT('con_password');
    $user_type = trimT('user_type');
    $enrol_date= date("Y-m-d",time());
    
    $password = hashmd5($password);
    $con_password = hashmd5($con_password);

    //for make it optional
    if ($street_address_2 == "" || !isset($street_address_2)) {
      $street_address_2 = "No-address";
    } 
    // if ($secondry_phone_number == "" || !isset($secondry_phone_number)) {
    //   $secondry_phone_number = "No-2ndphone";
    // } 
    // if ($fax_number == "" || !isset($fax_number)) {
    //   $fax_number = "no-faxnumber";
    // }

    if (isset($firstname) && isset($lastname) && isset($username) && isset($user_type) && isset($email) && isset($password) 
      && isset($con_password) && isset($street_address_1) && isset($street_address_2) && isset($city) && isset($postal_code) && isset($primary_phone_number)
      && isset($secondry_phone_number) && isset($fax_number) ) 
    {

      if (($firstname != "") && ($lastname != "") && ($username != "") && ($user_type != "") && ($email != "")
       && ($password != "") && ($con_password != "")  && ($street_address_1 != "")  && ($street_address_2 != "") && ($city != "") 
        && ($postal_code != "")  && ($primary_phone_number != "")  && ($secondry_phone_number != "") && ($fax_number != "") ) 
      {

          $password = hashmd5($password);
          $con_password = hashmd5($con_password);

          //to confirm password
          if ($password != $con_password) {
            $errors[] = "Both passwords are not same."; 
            $password = "";
            $con_password = "";
          } else if(strlen($password) >= MAX_FIRST_NAME_LENGTH && strlen($password) <= MIN_FIRST_NAME_LENGTH) {
            $errors[] = "Password should be between 8 to 16 characters";
            $password = "";
            $con_password = "";
          }
          if (strlen($firstname) >= MAX_FIRST_NAME_LENGTH && strlen($firstname) <= MIN_FIRST_NAME_LENGTH)
          {
            $errors[] = "First name should be between 3 to 20 characters"; 
            $firstname = "";
          }

          if (strlen($lastname) >= MAX_LAST_NAME_LENGTH && strlen($lastname) <= MIN_LAST_NAME_LENGTH)
          {
            $errors[] = "Last name should be between 3 to 30 characters"; 
            $lastname = "";
          }

          //remove illegal characters from email
          $email = filter_var($email, FILTER_SANITIZE_EMAIL);

          if (strlen($email) >= MAX_EMAIL_LENGTH && strlen($email) <= MIN_EMAIL_LENGTH)
          {
            $errors[] = "Email should be between 6 to 30 characters"; 
            $email = "";
          } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email address"; 
            $email = "";
          }

          if (strlen($street_address_1) >= MAX_ADDRESS_LENGTH && strlen($street_address_1) <= MIN_ADDRESS_LENGTH)
          {
            $errors[] = "Street address 1 should be between 6 to 30 characters"; 
            $street_address_1 = "";
          }
          if (strlen($street_address_2) >= MAX_ADDRESS_LENGTH && strlen($street_address_2) <= MIN_ADDRESS_LENGTH)
          {
            $errors[] = "Street address 2 should be between 6 to 30 characters"; 
            $street_address_2 = "";
          } 
          if (strlen($city) >= MAX_CITY_LENGTH && strlen($city) <= MIN_CITY_LENGTH )
          {
            $errors[] = "City should be between 3 to 17 characters"; 
            $city = "";
          } 
          if (strlen($postal_code) != POSTAL_CODE_LENGTH)
          {
            $errors[] = "Postal code should be 6 character"; 
            $postal_code = "";
          } else if (is_valid_postal_code($postal_code) == false) {
            $errors[] = "This canadian postal code is invalid"; 
            $postal_code = "";
          }

          if (strlen($primary_phone_number) >= MAX_PHONE_LENGTH && strlen($primary_phone_number) <= MIN_PHONE_LENGTH)
          {
            $errors[] = "Primary Phone Number Length should be between 10 to 15."; 
            $primary_phone_number = "";
          } else if (valid_phone_number($primary_phone_number) == false) {
              $errors[] = "Invalid Primary Phone Number."; 
              $primary_phone_number = "";
          }

          if (strlen($secondry_phone_number) >= MAX_PHONE_LENGTH && strlen($secondry_phone_number) <= MIN_PHONE_LENGTH)
          {
            $errors[] = "Secondary Phone Number Length should be between 10 to 15."; 
            $secondry_phone_number = "";
          } else if (valid_phone_number($secondry_phone_number) == false) {
              $errors[] = "Invalid Secondary Phone Number."; 
              $secondry_phone_number = "";
          }

          if (strlen($fax_number) >= MAX_FAX_LENGTH && strlen($fax_number) <= MIN_FAX_LENGTH)
          {
            $errors[] = "Fax Number Length should be between 10 to 15."; 
            $fax_number = "";
          } else if (valid_phone_number($fax_number) == false) {
              $errors[] = "Invalid Fax Number."; 
              $fax_number = "";
          }

          if (strlen($username) >= MAX_USERNAME_LENGTH && strlen($username) <= MIN_USERNAME_LENGTH)
          {
            $errors[] = "Username should be between 6 to 20 characters";
            $username = "";
          }

          $conn = db_connect();
          $sql_u = "SELECT * FROM users WHERE user_name='$username'";
          $sql_e = "SELECT * FROM users WHERE email_address='$email'";
          $res_u = pg_query($conn, $sql_u);
          $res_e = pg_query($conn, $sql_e);

          if (pg_num_rows($res_u) > 0) {
            $errors[] = "Sorry... username already taken"; 	
            $username = "";
          }else if(pg_num_rows($res_e) > 0){
            $errors[] = "Sorry... email already taken";      	
            $email = "";
          }   
          else if (empty($errors)){
            
            $primary_phone_number = display_phone_number($primary_phone_number);
            $secondry_phone_number = display_phone_number($secondry_phone_number);
            $fax_number = display_phone_number($fax_number);
            //$user_redirection = "";
            //check user_type
            // if ($user_type == AGENT)
            // {
            //   $user_redirection = "./dashboard.php";
            // }
            // else if ($user_type == CLIENT)
            // {
            //   $user_redirection = "./welcome.php";
            // }
            $save = "INSERT INTO users (first_name, last_name, user_name, email_address, password, user_type, street_address_1,
            street_address_2, city, postal_code, primary_phone_number, secondry_phone_number, fax_number,  enrol_date, last_access) 
                VALUES ('".$firstname."', '".$lastname."', '".$username."', '".$email."', '".$password."', '".$user_type."',
                '".$street_address_1."', '".$street_address_2."', '".$city."', '".$postal_code."', '".$primary_phone_number."', '".$secondry_phone_number."',
                '".$fax_number."', '".$enrol_date."' ,'".$enrol_date."')";
            $results = pg_query($conn, $save);
            $_SESSION['username_s'] = $username;
            $_SESSION['user_type_s'] = $user_type;
            $_SESSION['last_access_s'] = $enrol_date;
            $_SESSION['registration_success'] = "User Registered Successfully";
            header("Location: login.php");
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
  if (!empty($errors))
  {
    echo "<div class='card m-4 p-4'>";
    foreach($errors as $error)
    {
      echo "<p class='red-text'>".$error."</p><br/>";
    }
    echo "</div>";
  }
  $password = "";
  $con_password = "";

?>

<div class="grid-x center m-3">
      <div id="sign-up" class="col s12 cell large-8 large-offset-2">
        <div class="row my-4">
        <form class="col s12" method ="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="row">
            <div class="input-field col s2">
              <?php build_simple_dropdown("salutations", "Mr."); ?>
            </div>
            <div class="input-field col s5">              
              <input id="first_name" name="first_name" type="text" class="validate" value="<?php echo $firstname; ?>"/>
              <label class="active" for="first_name">First Name</label>
            </div>
            <div class="input-field col s5">
              <input id="last_name" name="last_name" type="text" class="validate" value="<?php echo $lastname; ?>"/>
              <label for="last_name">Last Name</label>
            </div>
          </div>
           <div class="row">
            <div class="input-field col s12">
              <input id="user_name" type="text" name="user_name" class="validate" value="<?php echo $username; ?>"/>
              <label for="user_name">User Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="email" name="email" type="text" class="validate" value="<?php echo $email; ?>"/>
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="street_address_1" name="street_address_1" type="text" class="validate" value="<?php echo $street_address_1; ?>"/>
              <label for="email">Street address 1</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="street_address_2" name="street_address_2" type="text" class="validate" value="<?php echo $street_address_2; ?>"/>
              <label for="email">Street address 2</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <!-- <input id="city" name="city" type="text" class="validate" value="<?php //echo $city; ?>"/>
              <label for="city">City</label> -->
              <?php build_dropdown("city", "property" , "city", "Select City", "oshawa"); ?>
            </div>
            <div class="input-field col s6">
              <?php build_simple_dropdown("provinces","ON"); ?>
            </div>
            <div class="input-field col s6">
              <input id="postal_code" name="postal_code" type="text" class="validate" value="<?php echo $postal_code; ?>"/>
              <label for="postal_code">Postal Code</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="primary_phone_number" name="primary_phone_number" type="text" class="validate" value="<?php echo $primary_phone_number; ?>"/>
              <label for="primary_phone_number">Primary Phone Number</label>
            </div>
            <div class="input-field col s6">
              <input id="secondry_phone_number" name="secondry_phone_number" type="text" class="validate" value="<?php echo $secondry_phone_number; ?>"/>
              <label for="secondry_phone_number">Secondry Phone Number</label>
            </div>
            <div class="input-field col s6">
              <input id="fax_number" name="fax_number" type="text" class="validate" value="<?php echo $fax_number; ?>"/>
              <label for="fax_number">Fax Number</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="password" type="password" name="password" class="validate" value="<?php echo $password; ?>"/>
              <label for="password">Password</label>
            </div>
            <div class="input-field col s6">
              <input id="con_password" type="password" name="con_password" class="validate" value="<?php echo $con_password; ?>"/>
              <label for="con_password">Confirm Password</label>
            </div>
            <div class="input-field col s6">
              <select name="user_type">
                <!-- <option value=" " disabled selected>Choose User Type</option> -->
                <option value="c">Clients</option>
                <option value="a">Agent</option>
              </select>
              <label>Choose User Type</label>
            </div>
            <div class="input-field col s6">
              <h6 class="grey-text text-lighten-1">Preferred contact method</h6>
              <?php build_radio("preferred_contact_method", "email"); ?>
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