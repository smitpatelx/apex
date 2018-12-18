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
    $session_message = [];
    $session_message[] = "Login required to access this page";
    $_SESSION['cookies_message'] = $session_message;   
    header('Location: ./login.php');
    ob_flush();  //Flush output buffer
}
?>
  <script type="text/javascript">     
      $(window).on('load', function () {
          $('.preloader-background').hide();
      });      
  </script>
  <?php
    $dbconn = db_connect();
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $current_password = "";
        $new_password = "";
        $confirm_password = "";
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $current_password = trimT('current_password');
        $new_password = trimT('new_password');
        $confirm_password = trimT('confirm_password');

        if (!isset($current_password) || $current_password == "") {
            $errors[] = "Current Password field is empty.";
        }

        if (!isset($new_password) || $new_password == "") {
            $errors[] = "New Password field is empty.";
        }  else if(strlen($new_password) >= MAX_FIRST_NAME_LENGTH && strlen($new_password) <= MIN_FIRST_NAME_LENGTH) {
            $errors[] = "Password should be between 8 to 16 characters";
        }

        if (!isset($confirm_password) || $confirm_password == "") {
            $errors[] = "Confirm Password field is empty.";
        }

        if ($new_password != $confirm_password) {
            $errors[] = "New password and confirm password doesn't match.";
        }

        if (empty($errors)) {

            $current_password = hashmd5($current_password);
            $new_password = hashmd5($new_password);
            $confirm_password = hashmd5($confirm_password);
           
            $stmt = pg_prepare($dbconn, 'user_login', "SELECT * 
                                                        FROM users
                                                        WHERE users.user_name = $1 AND users.password = $2");

            $result = pg_execute($dbconn, 'user_login', array($_SESSION['username_s'], $current_password));

            if ($result != false) {

                $data = pg_fetch_array($result);

                    if ($current_password != $data['password']) {
                        $errors[] = "Current password is not correct.";
                    } else {

                    $stmt1 = pg_prepare($dbconn, 'user_last_access', "UPDATE users
                                                    SET password = '$confirm_password'
                                                    WHERE users.user_name = \$1 AND users.password = \$2");

                    $result1 = pg_execute($dbconn, 'user_last_access', array($_SESSION['username_s'], $current_password) );

                        $session_message = [];
                        $session_message[] = "Password Changed Successfully";
                        $_SESSION['cookies_message'] = $session_message;
                        header('Location: ./logout.php');
                        ob_flush();  //Flush output buffer
                    }
                
            } else {
                $errors[] = "Password is not correct.";
            }
        }
    }

    $current_password = "";
    $new_password = "";
    $confirm_password = "";
?>
  <div class='grid-x mt-4'>
      <?php
        if (!empty($errors)) {
            echo "<div class='cell small-12'>";
            echo "<div class='card m-4 p-4'>";
            foreach ($errors as $error) {
                echo "<p class='red-text'>" . $error . "</p><br/>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
      <form class='cell medium-5 medium-offset-4 center row' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <h2 class='col s12 m12 l12 center red-text dosis'>Change Password</h2>
          <h5 class='red-text dosis center text-lighten-2'><?php echo "<b>User ID :</b>\t".$_SESSION['username_s']."<br/> <b>Username :</b>\t".$_SESSION['user_id_s'] ?></h5>
          <div class="input-field col s12 m12 l12 center">
              <input value="<?php echo $current_password; ?>" name="current_password" id="current_password" type="password" class="validate">
              <label for="current_password">Current Password</label>
          </div>
          <div class="input-field col s12 m12 l12 center">
              <input value="<?php echo $new_password; ?>" name="new_password" id="new_password" type="password" class="validate">
              <label for="new_password">New Password</label>
          </div>
          <div class="input-field col s12 m12 l12 center">
              <input value="<?php echo $confirm_password; ?>" name="confirm_password" id="confirm_password" type="password" class="validate">
              <label for="confirm_password">Confirm Password</label>
          </div>
          <div class='input-field col s12 m12 l12 center'>
              <button class="btn grey darken-2 waves-effect waves-light z-depth-4" type="submit" name="action">
                  <i class="fas fa-lock"></i> PROCEED
              </button>
          </div>
      </form>
  </div>
<?php
require("./footer.php");
?>
