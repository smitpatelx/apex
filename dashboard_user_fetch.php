<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php
    require('./includes/constants.php');
    require('./includes/db.php');
    require("./includes/functions.php");

    
    if (empty($_SESSION['username_s']) || $_SESSION['user_type_s'] != ADMIN){
        header('Location: ./405.php');
        ob_flush();  //Flush output buffer
    }
    
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