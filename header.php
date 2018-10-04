<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('./scripts/functions.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apex | <?php echo($title); ?></title>

    <link rel="icon" href="./assets/logo/ico.png">

    <link href="https://fonts.googleapis.com/css?family=Arima+Madurai|Montserrat|Pacifico|Rubik" rel="stylesheet">
    <link rel="stylesheet" href="./style/main.min.css">
    <link rel="stylesheet" href="./style/foundation/css/foundation.min.css">
    <link rel="stylesheet" href="./style/custom.css">
    <link rel="stylesheet" href="./style/aos.css">
    <link rel="stylesheet" href="./style/slick.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
    <script src="./scripts/js/jquery.min.js"></script>
    <script>       
        $(window).on('load', function () {
            $('.preloader-background').delay(1400).fadeOut('slow');

            $('.loading-text')
                .delay(1350)
                .fadeOut('slow');
            $('.preloader-wrapper')
                .delay(1350)
                .fadeOut('slow');
        });      
    </script>
</head>
<body>

    <div class="navbar-fixed">

        <div class="preloader-background white">
            <h2 class="center m-4 loading-text" data-splitting>APEX</h2>
            <div class="preloader-wrapper big active">       
                <div class="spinner-layer spinner-cyan-only lighten-1 ">
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

    
        <nav class="nav_bar" role="navigation">
            <div class="nav-wrapper">
                <!-- <img src="./assets/logo/bandcamp-brands.svg" alt="s" class="nav-bar-site-logo hide-on-med-and-down"> -->
                <div class="brand-logo-s">
                    <i class="fab fa-strava fa-3x hide-on-med-and-down nav-bar-site-logo"></i>
                </div>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a href="index.php" class="brand-logo stretch-it" data-splitting>
                    <h4 class="nav-bar-site-text">Apex Listings</h4>
                </a>
                
                <ul id="nav-mobile" class="right hide-on-med-and-down px-3">
                    <li class="waves-effect my-2 mx-2"><a href="index.php" class="nav-mobile-text">Home</a></li>
                    <li class="waves-effect my-2 mx-2"><a href="listing.php" class="nav-mobile-text">Listing</a></li>
                    <li class="waves-effect my-2 mx-2"><a href="login.php" class="nav-mobile-text">Login</a></li>
                    <li class="waves-effect my-2 mx-2"><a href="admin.php" class="nav-mobile-text">Admin</a></li>
                    <li class="waves-effect my-2 mx-2"><a href="dashboard.php" class="nav-mobile-text">Dashboard</a></li>
                </ul>
            </div>
        </nav>
    </div>
        <ul class="sidenav" id="mobile-demo">
            <!-- <li class="center-align">
                <form class="center container">
                    <div class="input-field blue-grey">
                    <input class="center-align black-text" id="search1" type="search" placeholder="SEARCH" required>
                    <label class="label-icon m-2 p-1" for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                    </div>
                </form>
            </li> -->
            <li class="center-align"><a href="index.php">Home</a></li>
            <li class="center-align"><a href="listing.php">Listing</a></li>
            <li class="center-align"><a href="login.php">Login</a></li>
            <li class="center-align"><a href="admin.php">Admin</a></li>
            <li class="center-align"><a href="dashboard.php">Dashboard</a></li>
            <li style="position: absolute;bottom:50px;width:250px;">
                <div class="footer-copyright">
                    <div class="container center footer-made-by">
                        <p>Made with <i class="fas fa-heart" style="color:red;"></i> by <a href="http://www.netdevv.com" >NETDEVV</a></p>
                    </div>
                </div>
            </li>
        </ul>
    
    <div id="main">
