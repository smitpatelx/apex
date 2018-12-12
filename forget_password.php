<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->

<?php

$title = "Forget Password";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Forget Password";
$desc = "Dashboard Page of QualityLife";

require('header.php');
if (isset($_SESSION['user_type_s'])){
  $session_message = [];
  $session_message[] = "Logout required to access login page.";
  $_SESSION['cookies_message'] = $session_message;
  user_redirection();
}

?>

<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>

<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "GET")
  {
    $user_name = "";
    $email = "";
    
  } else if ($_SERVER["REQUEST_METHOD"] == "POST") {

     $user_name = isset($_POST['user_name'])?$_POST['user_name']:"";
     $email = isset($_POST['email'])?$_POST['email']:"";

     if(!isset($user_name) || $user_name == "") {
        $errors[] = "Please enter user name.";
     }

     if(!isset($email) || $email == "") {
        $errors[] = "Please enter email.";
     }

     if(empty($errors)) {
        $conn = db_connect();
        $sql = "SELECT * FROM users WHERE user_name='$user_name' AND email_address='$email'";

        $query = pg_query($conn, $sql);


        if (pg_num_rows($query) > 0) {
            
            $data = pg_fetch_assoc($query);

            $lower_letters = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 3); // Generate 6 lowercase letters
            $upper_letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3); // Generate 1 uppercase letter
            $numbers = substr(str_shuffle('0123456789'), 0, 1); // Generate 1 number
            $sign = substr(str_shuffle('@&#'), 0, 1); // Generate 1 special character

            $password = substr(str_shuffle($lower_letters.''.$upper_letters.''.$numbers.''.$sign), 0, 8);

            $md5_pass = hashmd5($password);

            $sql2 = "UPDATE users SET password='$md5_pass' WHERE user_name='$user_name' AND email_address='$email'";
            $query2 = pg_query($conn, $sql2);

            $to = $data['email_address'];
            $subject = "User Password Reset";

            $message = "";
            $message .= "<br/><br/>Hi ".$data['first_name']." ".$data['last_name'];
            $message .= "<br/>Your new Password : ".$password;
            $message .= "<br/><br/>We advice you to change your password within 24 hrs.";
            $message .= "<br/>Thankyou for using <a href='https://netdevv.com'>NETDEVV.COM</a>";

            $header = 'From: services@netdevv.com' . "\r\n" .
                        'Reply-To: services@netdevv.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

            if ( mail($to, $subject, $message, $header) ) {

                $session_message[] = "Email send to your account.";
                $_SESSION['cookies_message'] = $session_message;
                header("Location: ./login.php");
                ob_flush();

            } else {
                $errors[] = "Sorry. This is not an acceptable email.";
            }
        } else {
            $errors[] = "Sorry... match doesn't found in database. Try again.";      	
        }  
     }

    }

    if (!empty($errors))
    {
        echo "<div class='card m-4 p-4'>";
        foreach($errors as $error)
        {
        echo "<p class='red-text'>".$error."</p><br/>";
        }
        echo "</div>";
    }
  
    $user_name = "";
    $email = "";

?>

<div class="grid-x center my-4 ml-4">
    <h5 class='cell small-12 dosis center red-text text-lighten-1'>Enter your user ID and email. We will send you new password if all went well.</h5>
      <div id="sign-in" class="col s12 cell large-8 large-offset-2">
        <div class="cell large-4 large-offset-4 row">
        <form class="col s12" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="row">
                <div class="input-field col s6">
                    <input id="user_name" name="user_name" value="<?php echo $user_name ?>" type="text" class="validate"/>
                    <label for="user_name">User Name</label>
                </div>

                <div class="input-field col s6">
                    <input id="email" name="email" type="text" class="validate" value="<?php echo $email; ?>"/>
                    <label for="email">Email</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light grey white-text" type="submit" name="action">Submit
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