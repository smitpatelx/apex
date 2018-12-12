<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

$title = "Update";
$file = "update.php";
$date = "Oct 30 2018";
$banner = "Update";
$desc = "Dashboard Page of QualityLife";
require("./header.php");

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
<?php
  //LOGIN FUNCTIONALITY
  //Authors: Blake, Dylan
  $errors = [];
  $session_message = [];
  $current_user_id = $_SESSION['user_id_s'];
  $username = $_SESSION['username_s'];

  if ($_SERVER["REQUEST_METHOD"] == "GET")
  {
    if (isset($current_user_id)) {

        $conn = db_connect();                              
        $sql2 = "SELECT * FROM users WHERE 
        user_id::VARCHAR = '$current_user_id' ";
        $result = pg_query($conn, $sql2);
        
        while($data = pg_fetch_assoc($result)) {
            $salutation = $data['salutation'];
            $firstname = $data['first_name'];
            $lastname = $data['last_name'];
            $email = $data['email_address'];                 
            $street_address_1 = $data['street_address_1'];
            $street_address_2 = $data['street_address_2'];
            $city = $data['city'];
            $province = $data['province'];
            $postal_code = $data['postal_code'];
            $primary_phone_number = $data['primary_phone_number'];
            $secondry_phone_number = $data['secondry_phone_number'];
            $fax_number = $data['fax_number'];
            $contact_method = $data['preferred_contact_method'];
            $password = "";
            $con_password = "";
        } 
    }

  } else if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $salutation = trimT('salutation');
    $firstname = trimT('first_name');
    $lastname = trimT('last_name');
    
    $email = trimT('email');
    $street_address_1 = post('street_address_1');
    $street_address_2 = post('street_address_2');
    $city = trimT('city');
    $province = post('provinces');
    $postal_code = trimT('postal_code');
    $primary_phone_number = trimT('primary_phone_number');
    $secondry_phone_number = trimT('secondry_phone_number');
    $fax_number = trimT('fax_number');
    $contact_method = trimT('contact_method');
    $enrol_date= date("Y-m-d",time());

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

      $conn = db_connect();
      
      if (empty($errors)){
        
        $primary_phone_number = display_phone_number($primary_phone_number);
        $secondry_phone_number = display_phone_number($secondry_phone_number);
        $fax_number = display_phone_number($fax_number);

        $sql = "UPDATE users SET first_name=\$1, last_name=\$2, user_name=\$3, email_address=\$4, street_address_1=\$5,
                street_address_2=\$6, city=\$7, postal_code=\$8, primary_phone_number=\$9, secondry_phone_number=\$10, fax_number=\$11, province=\$12, salutation=\$13, 
                preferred_contact_method=\$14
                WHERE user_id::VARCHAR = '$current_user_id'";
        
        $stmt = pg_prepare($conn, 'user_update', $sql);

        $result = pg_execute($conn, 'user_update', array($firstname, $lastname, $username, $email, 
                            $street_address_1, $street_address_2, $city, $postal_code, $primary_phone_number, $secondry_phone_number,
                            $fax_number, $province, $salutation, $contact_method));
                            
        if ( false != $result) {
          $session_message[] = "User information updated";
          $_SESSION['cookies_message'] = $session_message;
          user_redirection();
          
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
              <input id="user_name" type="text" name="user_name" class="validate" value="<?php echo $username; ?>" disabled/>
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
              <?php build_dropdown("city", "property" , "city", "Select City", "$city"); ?>
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
              <h6 class="grey-text text-lighten-1">Preferred contact method</h6>
              <?php build_radio("preferred_contact_method", $contact_method); ?>
            </div>
          </div>         
          <div class="row">
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light blue lighten-1" type="submit" name="signup">Update
                    <i class="fas fa-edit"></i>
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