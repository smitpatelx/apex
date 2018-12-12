<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->

<?php

$title = "Add to offending";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Add to offending";
$desc = "Dashboard Page of QualityLife";

require('header.php');
if (!isset($_SESSION['user_type_s']) || $_SESSION['user_type_s']!=ADMIN){
  $session_message = [];
  $session_message[] = "Only Admin Allowed";
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

    $session_message = [];

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['user_type']) && isset($_GET['user_type'])) {
            $user_id = (string)$_GET['user_id'];
            $user_type = (string)$_GET['user_type'];

            $conn = db_connect();

            if($user_type == AGENT) {

                $sql="UPDATE users SET user_type='a' WHERE user_id::VARCHAR='$user_id'";

                if( $query=pg_query($conn,$sql) ) {
                    echo "CHANGED TO AGENT";
                    $session_message[] = "User type changed to agent";
                    $_SESSION['cookies_message'] = $session_message;
                    echo "<script> window.history.go(-1); </script>";
                } else {
                    echo "problem in changing user type";
                    $session_message[] = "User type not changed";
                    $_SESSION['cookies_message'] = $session_message;
                    echo "<script> window.history.go(-1); </script>";
                }
                
            } elseif ($user_type == PENDING) {
                
                $sql="UPDATE users SET user_type='p' WHERE user_id::VARCHAR='$user_id'";

                if( $query=pg_query($conn,$sql) ) {
                    echo "CHANGED TO PENDING";
                    $session_message[] = "User type changed to pending";
                    $_SESSION['cookies_message'] = $session_message;
                    echo "<script> window.history.go(-1); </script>";
                } else {
                    echo "problem in changing user type";
                    $session_message[] = "User type not changed";
                    $_SESSION['cookies_message'] = $session_message;
                    echo "<script> window.history.go(-1); </script>";
                }
            } elseif ($user_type == DISABLED) {
                
                $sql="UPDATE users SET user_type='d' WHERE user_id::VARCHAR='$user_id'";

                if( $query=pg_query($conn,$sql) ) {
                    echo "CHANGED TO DISABLE";
                    $session_message[] = "User type changed to disabled";
                    $_SESSION['cookies_message'] = $session_message;
                    echo "<script> window.history.go(-1); </script>";
                } else {
                    echo "problem in changing user type";
                    $session_message[] = "User type not changed";
                    $_SESSION['cookies_message'] = $session_message;
                    echo "<script> window.history.go(-1); </script>";
                }
            } elseif ($user_type == CLIENT) {
                
                $sql="UPDATE users SET user_type='c' WHERE user_id::VARCHAR='$user_id'";

                if( $query=pg_query($conn,$sql) ) {
                    echo "CHANGED TO CLIENT";
                    $session_message[] = "User type changed to client";
                    $_SESSION['cookies_message'] = $session_message;
                    echo "<script> window.history.go(-1); </script>";
                } else {
                    echo "problem in changing user type";
                    $session_message[] = "User type not changed";
                    $_SESSION['cookies_message'] = $session_message;
                    echo "<script> window.history.go(-1); </script>";
                }
            }

        } else {
            $session_message = [];
            $session_message[] = "Provide required variables";
            $_SESSION['cookies_message'] = $session_message;
            header('Location: ./admin.php');
            ob_flush();
        }
    }  else {
        $session_message = [];
        $session_message[] = "Only Get Method Allowed";
        $_SESSION['cookies_message'] = $session_message;
        header('Location: ./admin.php');
        ob_flush();
    }

require("./footer.php");
?>