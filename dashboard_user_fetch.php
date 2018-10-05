<?php
/*
FILE:                   login.php
TITLE:                  Apex Listings - User Login Page
AUTHORS:                Blake Phillips, Smit Patel, Clayton Galliah-Penhale, Dylan Lopez
LAST MODIFIED:          October 4, 2018
DESCRIPTION:            Allows users to login to their profiles or allows new users to create an account
**/

    require('./includes/functions.php');
    
    $conn5 = db_connect();
    $first_name_dashboard = "trim(LOWER('$_GET[first_name_dashboard]'))";
    $last_name_dashboard = "trim(LOWER('$_GET[last_name_dashboard]'))";
    $user_name_dashboard = "trim(LOWER('$_GET[user_name_dashboard]'))";
    $email_dashboard = "trim(LOWER('$_GET[email_dashboard]'))";

    $sql5 = "UPDATE users SET first_name=$first_name_dashboard, 
        last_name=$last_name_dashboard, 
        username=$user_name_dashboard, 
        email=$email_dashboard 
        WHERE id= 1";

    $result5 = pg_query($conn5, $sql5);

?>