<?php
ob_start();
require('./includes/constants.php');
require('./includes/db.php');
require('./includes/functions.php');

?>
<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<!-- <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Apex | <?php echo($title); ?></title>

    <link rel="icon" href="./assets/logo/ico.png"/>

    <link href="https://fonts.googleapis.com/css?family=Arima+Madurai|Montserrat|Pacifico|Rubik" rel="stylesheet"/>
    <link rel="stylesheet" href="./style/main.min.css"/>
    <link rel="stylesheet" href="./style/foundation/css/foundation.min.css"/>
    <link rel="stylesheet" href="./style/web3201.css"/>
    <link rel="stylesheet" href="./style/aos.css"/>
    <link rel="stylesheet" href="./style/slick.css"/>
    <link rel="stylesheet" href="./style/fa.min.css" />
       
    <script type="text/javascript" src="./includes/js/jquery.min.js"></script>
    <script type="text/javascript" src="./includes/js/vendors.js"></script>
    <!-- <script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
    </script> -->
</head>
<body>

    <div class="navbar-fixed">

        <div class="preloader-background tra-white">
            <!-- <h2 class="center m-4 loading-text" data-splitting>APEX</h2> -->
            <div class="preloader-wrapper big active">       
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>

    
        <div class="navm nav_bar">
            <div class="nav-wrapper">
                <div class="brand-logo-s">
                    <img src="./assets/logo/logo.png" class="hide-on-med-and-down nav-bar-site-logo" alt="APEX"/>
                </div>
                <script type="text/javascript">
                    $('.nav-bar-site-logo').on('click',function() {
                        window.location.href = "./index.php";
                    });
                </script>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger mt-2"><i class="fas fa-bars fa-2x"></i></a>
                <a href="index.php" class="brand-logo stretch-it nav-bar-site-text" data-splitting>
                    <?php echo $banner; ?>
                </a>

                <ul id="nav-mobile" class="right hide-on-med-and-down px-3 mt-1">
                    <li class="waves-effect my-2 mx-2"><a href="index.php" class="nav-mobile-text">Home</a></li>
                    <li class="waves-effect my-2 mx-2"><a href="listing_city_select.php" class="nav-mobile-text">Listing</a></li>
                    <?php
                        //logout btn
                        if (!empty($_SESSION['username_s'])){
                            echo "<li class='waves-effect mx-2 my-2'><a href='logout.php' class='nav-mobile-text'>Log Out</a></li>";
                            echo "<li class='waves-effect mx-2 my-2'><a href='update.php' class='nav-mobile-text'>Update</a></li>";
                            echo "<li class='waves-effect mx-2 my-2'><a href='listing_create.php' class='nav-mobile-text'>Create Listing</a></li>";
                        }
                        else{
                            echo "<li class='waves-effect my-2 mx-2'><a href='login.php' class='nav-mobile-text'>Login</a></li>";
                            echo "<li class='waves-effect my-2 mx-2'><a href='register.php' class='nav-mobile-text'>Register</a></li>";
                        }
                    ?>
                    
                    <li class="waves-effect my-2 mx-2 dropdown_1">                       
                        <a href="#" class="nav-mobile-text white-text">Pages</a>                          
                        <div class="drop_1">
                            <a href="admin.php">Admin</a>
                            <a href="dashboard.php">Dashboard</a>
                            <a href="listing-display.php">Listing Display</a>
                            <a href="welcome.php">Welcome</a>
                            <?php
                                //logout btn
                                if (!empty($_SESSION['username_s'])){
                                    echo "<a href='change-password.php'>Change Password</a>";
                                    echo "<a href='update.php'>Update</a>";
                                }
                            ?>
                        </div>
                    </li>                
                </ul>
            </div>
        </div>
    </div>
        <ul class="sidenav" id="mobile-demo">
            <li class="center-align"><a href="index.php">Home</a></li>
            <li class="center-align"><a href="listing_search.php">Listing</a></li>
            <li class="center-align"><a href="login.php">Login</a></li>
            <li class="center-align"><a href="register.php">Register</a></li>
            <?php
                //logout btn
                if (!empty($_SESSION['username_s'])){
                    echo "<li class='center-align'><a href='logout.php'><i class='fas fa-sign-out-alt fa-1x'></i></a></li>";
                }
            ?>
            <li style="position: absolute;bottom:50px;width:250px;">
                <div class="footer-copyright">
                    <div class="container center footer-made-by">
                        <p>Made with <i class="fas fa-heart" style="color:red;"></i> by <a href="http://www.netdevv.com" >NETDEVV</a></p>
                    </div>
                </div>
            </li>
        </ul>
    
    <div id="main">
    <?php session_message(); ?>