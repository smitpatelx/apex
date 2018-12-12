<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

$title = "Favourite";
$file = "listing-display.php";
$date = "Sept 14 2018";
$banner = "Favourite";
$desc = "Favourite Page";

require('header.php');

if (!isset($_SESSION['username_s']) || $_SESSION['username_s']!=CLIENT){
    $session_message = [];
    $session_message[] = "Unauthorized access blocked.";
    $_SESSION['cookies_message'] = $session_message;   
    // header('Location: ./login.php');
    // ob_flush();  //Flush output buffer
}
?>
<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['listing_id']) || isset($_GET['method'])) {

            $user_id = $_SESSION['user_id_s'];
            $listing_id = $_GET['listing_id'];
            $method = $_GET['method'];

            $conn = db_connect();

            if($method == "like") {
                $sql="INSERT INTO favourites ( user_id, listing_id ) VALUES ( $user_id, $listing_id)";
                if( $query=pg_query($conn,$sql) ) {
                    echo "LIKE";
                    $session_message[] = "Post liked.";
                    $_SESSION['cookies_message'] = $session_message;
                    echo "<script> window.history.go(-1); </script>";
                } else {
                    echo "problem in LIKE";
                    $session_message[] = "Facing problem while liking.";
                    $_SESSION['cookies_message'] = $session_message;
                    echo "<script> window.history.go(-1); </script>";
                }
                
            } elseif ($method == "dislike") {
                
                $sql="DELETE FROM favourites WHERE user_id::VARCHAR='$user_id' AND listing_id = $listing_id";
                if( $query=pg_query($conn,$sql) ) {
                    echo "DISLIKE";
                    $session_message[] = "Post disliked.";
                    $_SESSION['cookies_message'] = $session_message;
                    echo "<script> window.history.go(-1); </script>";

                } else {
                    echo "problem in DISLIKE";
                    $session_message[] = "Facing problem while disliking.";
                    $_SESSION['cookies_message'] = $session_message;
                   echo "<script> window.history.go(-1); </script>";

                }
            }
        } else {
            $session_message[] = "Try Again";
            $_SESSION['cookies_message'] = $session_message;
            echo "<script> window.history.go(-1); </script>";
        }
    } else {
        $session_message[] = "Try Again";
        $_SESSION['cookies_message'] = $session_message;
        echo "<script> window.history.go(-1); </script>";
    }

require("./footer.php");
?>