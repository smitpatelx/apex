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
    header('Location: ./update.php');
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
  $session_message = [];

  if ($_SERVER["REQUEST_METHOD"] == "GET")
  {
    //default for when page loads first time

    //initialize variables to be echo'ed into the 
    $username = "";
    $salutation = "Mr.";
    $firstname = "";
    $lastname = "";
    $email = "";
    $password = "";
    $user_type = "";
    $con_password = "";
    $street_address_1 = "";
    $street_address_2 = "";
    $city = "oshawa";
    $province = "ON";
    $postal_code = "";
    $primary_phone_number = "";
    $secondry_phone_number = "";
    $fax_number = "";
    $contact_method = "e";

  } else if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $salutation = trimT('salutation');
    $firstname = trimT('first_name');
    $lastname = trimT('last_name');
    $username = trimT('user_name');
    $email = trimT('email');
    $password = trimT('password');
    $street_address_1 = post('street_address_1');
    $street_address_2 = post('street_address_2');
    $city = trimT('city');
    $province = post('provinces');
    $postal_code = trimT('postal_code');
    $primary_phone_number = trimT('primary_phone_number');
    $secondry_phone_number = trimT('secondry_phone_number');
    $fax_number = trimT('fax_number');
    $con_password = trimT('con_password');
    $user_type = trimT('user_type');
    $contact_method = trimT('contact_method');
    $enrol_date= date("Y-m-d",time());
    
    $password = hashmd5($password);
    $con_password = hashmd5($con_password);

    //for make it optional
    // if ($street_address_2 == "" || !isset($street_address_2)) {
    //   $street_address_2 = "No-address";
    // } 
    // if ($secondry_phone_number == "" || !isset($secondry_phone_number)) {
    //   $secondry_phone_number = "No-2ndphone";
    // } 
    // if ($fax_number == "" || !isset($fax_number)) {
    //   $fax_number = "no-faxnumber";
    // }

      //to confirm password
      if (!isset($password) || $password == "") {
        $errors[] = "Password field is empty.";
      } else if ($password != $con_password) {
        $errors[] = "Both passwords are not same."; 
        $password = "";
        $con_password = "";
      } else if(strlen($password) >= MAX_FIRST_NAME_LENGTH && strlen($password) <= MIN_FIRST_NAME_LENGTH) {
        $errors[] = "Password should be between 8 to 16 characters";
        $password = "";
        $con_password = "";
      }

      if (!isset($firstname) || $firstname == "") {
        $errors[] = "First name field is empty.";
      } else if (strlen($firstname) >= MAX_FIRST_NAME_LENGTH && strlen($firstname) <= MIN_FIRST_NAME_LENGTH)
      {
        $errors[] = "You entered \"".$firstname."\" "."First name should be between 3 to 20 characters"; 
        $firstname = "";
      }

      if (!isset($lastname) || $lastname == "") {
        $errors[] = "Last name field is empty.";
      } else if (strlen($lastname) >= MAX_LAST_NAME_LENGTH && strlen($lastname) <= MIN_LAST_NAME_LENGTH)
      {
        $errors[] = "You entered \"".$lastname."\" "."Last name should be between 3 to 30 characters"; 
        $lastname = "";
      }

      //remove illegal characters from email
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);

      if (!isset($email) || $email == "") {
        $errors[] = "Email field is empty.";
      } else if (strlen($email) >= MAX_EMAIL_LENGTH && strlen($email) <= MIN_EMAIL_LENGTH)
      {
        $errors[] = "You entered \"".$email."\" "."Email should be between 6 to 30 characters"; 
        $email = "";
      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "You entered \"".$email."\" "."Invalid email address"; 
        $email = "";
      }

      if (!isset($street_address_1) || $street_address_1 == "") {
        $errors[] = "Street address 1 field is empty.";
      } else if (strlen($street_address_1) >= MAX_ADDRESS_LENGTH && strlen($street_address_1) <= MIN_ADDRESS_LENGTH)
      {
        $errors[] = "You entered \"".$street_address_1."\" "."Street address 1 should be between 6 to 30 characters"; 
        $street_address_1 = "";
      }
      
      if (isset($street_address_2) || $street_address_2 != "") {
          if (strlen($street_address_2) >= MAX_ADDRESS_LENGTH && strlen($street_address_2) <= MIN_ADDRESS_LENGTH)
          {
            $errors[] = "You entered \"".$street_address_2."\" "."Street address 2 should be between 6 to 30 characters"; 
            $street_address_2 = "";
          } 
      }
        
      if (!isset($postal_code) || $postal_code == "") {
        $errors[] = "Postal Code field is empty.";
      } else if (strlen($postal_code) != POSTAL_CODE_LENGTH)
      {
        $errors[] = "You entered \"".$postal_code."\" "."Postal code should be 6 character"; 
        $postal_code = "";
      } else if (is_valid_postal_code($postal_code) == false) {
        $errors[] = "You entered \"".$postal_code."\" "."This canadian postal code is invalid"; 
        $postal_code = "";
      }

      if (!isset($primary_phone_number) || $primary_phone_number == "") {
        $errors[] = "Primary phone number field is empty.";
      } else if (strlen($primary_phone_number) >= MAX_PHONE_LENGTH && strlen($primary_phone_number) <= MIN_PHONE_LENGTH)
      {
        $errors[] = "You entered \"".$primary_phone_number."\" "."Primary Phone Number Length should be between 10 to 15."; 
        $primary_phone_number = "";
      } else if (valid_phone_number($primary_phone_number) == false) {
          $errors[] = "You entered \"".$primary_phone_number."\" "."Invalid Primary Phone Number."; 
          $primary_phone_number = "";
      }

      if (isset($secondry_phone_number) && $secondry_phone_number != "") {
        if (strlen($secondry_phone_number) >= MAX_PHONE_LENGTH && strlen($secondry_phone_number) <= MIN_PHONE_LENGTH)
        {
          $errors[] = "You entered \"".$secondry_phone_number."\" "."Secondary Phone Number Length should be between 10 to 15."; 
          $secondry_phone_number = "";
        } else if (valid_phone_number($secondry_phone_number) == false) {
            $errors[] = "You entered \"".$secondry_phone_number."\" "."Invalid Secondary Phone Number."; 
            $secondry_phone_number = "";
        }
      }

      if (isset($fax_number) && $fax_number != "") {
        if (strlen($fax_number) >= MAX_FAX_LENGTH && strlen($fax_number) <= MIN_FAX_LENGTH)
        {
          $errors[] = "You entered \"".$fax_number."\" "."Fax Number Length should be between 10 to 15."; 
          $fax_number = "";
        } else if (valid_phone_number($fax_number) == false) {
            $errors[] = "You entered \"".$fax_number."\" "."Invalid Fax Number."; 
            $fax_number = "";
        }
      }

      if (!isset($username) || $username == "") {
        $errors[] = "Username field is empty.";
      } else if (strlen($username) >= MAX_USERNAME_LENGTH && strlen($username) <= MIN_USERNAME_LENGTH)
      {
        $errors[] = "You entered \"".$username."\" "."Username should be between 6 to 20 characters";
        $username = "";
      }

      if ($user_type==AGENT) {
        $user_type = PENDING;
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

        $sql = "INSERT INTO users (first_name, last_name, user_name, email_address, password, user_type, street_address_1,
                street_address_2, city, postal_code, primary_phone_number, secondry_phone_number, fax_number, province, salutation, 
                preferred_contact_method, enrol_date, last_access) 
                VALUES ( \$1, \$2, \$3, \$4, \$5, \$6, \$7, \$8, \$9, \$10, \$11, \$12, \$13, \$14, \$15, \$16, \$17, \$18 )";
        
        $stmt = pg_prepare($conn, 'user_register', $sql);

        $result = pg_execute($conn, 'user_register', array($firstname, $lastname, $username, $email, $password, $user_type,
                            $street_address_1, $street_address_2, $city, $postal_code, $primary_phone_number, $secondry_phone_number,
                            $fax_number, $province, $salutation, $contact_method, $enrol_date ,$enrol_date));
                            
        if ( false != $result) {
          $session_message[] = "User Registered Successfully";
          $_SESSION['cookies_message'] = $session_message;
          
          header("Location: ./login.php");
          ob_flush();  //Flush output buffer
        } else {
          $errors[] = "User Registration Unsuccessful";
        }
                    
        }
        else
        {
          $errors[] = "Something went wrong! Try Again";
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
              <?php build_simple_dropdown("salutations", "$salutation"); ?>
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
              <?php build_dropdown2("city", "property", "property", "city", "Select City", "$city"); ?>
            </div>
            <div class="input-field col s6">
              <?php build_simple_dropdown("provinces","$province"); ?>
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
              <?php build_radio("preferred_contact_method", "$contact_method"); ?>
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