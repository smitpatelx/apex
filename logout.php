<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

  session_start();
  if ( isset( $_COOKIE[session_name()] ) ) {
    //clear cookie off client pc
    // setcookie( 'USER[user]',  $_SESSION['username_s'], time()-3600);
    // unset($_COOKIE['USER[]']);
    unset($_SESSION);
     //clear session from disk
    session_destroy();
    }

    header("Location: ./index.php");
    ob_flush();  //Flush output buffer
    
?>
