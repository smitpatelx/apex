<?php

/*
FILE:                   login.php
TITLE:                  Apex Listings - User Login Page
AUTHORS:                Blake Phillips, Smit Patel, Clayton Galliah-Penhale, Dylan Lopez
LAST MODIFIED:          October 4, 2018
DESCRIPTION:            Allows users to login to their profiles or allows new users to create an account
**/

session_start();
  if ( isset( $_COOKIE[session_name()] ) ) {
    //clear cookie off client pc
    setcookie( session_name(), "", time()-3600, "/" );
    unset($_SESSION);
     //clear session from disk
    session_destroy();
    }

    header("Location: ./index.php");
    
?>
