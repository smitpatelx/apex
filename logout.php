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
    setcookie( 'username',  $_SESSION['username_s'], time()-3600);
    unset($_SESSION);
    
    session_destroy();
    }

    header("Location: ./index.php");
    ob_flush();  //Flush output buffer
    
?>
