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
        if (isset($_GET['listing_id'])) {
            $listing_id = $_GET['listing_id'];
            $method = $_GET['method'];

            $conn = db_connect();
            $info = "SELECT * FROM listings WHERE listing_id=$listing_id";
            $query2 = pg_query($conn, $info);
            $data = pg_fetch_assoc($query2);

            $current_user = $_SESSION['user_id_s'];
            $current_listing_owner = $data['user_id'];
            $current_listing_status = $data['status'];
            $provided_user = isset($_GET['user'])?$_GET['user']:"";

            $reported_on = date("Y-m-d",time());

            if ($method == "hide") {
                
                $sql = "UPDATE listings SET status='h' WHERE listing_id=$listing_id";
                $query = pg_query($conn, $sql);              

                $sql4 = "INSERT INTO offensives ( user_id, listing_id, reported_on, status) 
                VALUES ( '$current_user', $listing_id, '$reported_on', 'h')";
                $query4 = pg_query($conn, $sql4);
            
                $session_message[] = "Listing added to blacklist";
                $_SESSION['cookies_message'] = $session_message;
                echo "<script> window.history.go(-1); </script>";

            } elseif ($method == "unhide") {
                
                $sql = "UPDATE listings SET status='o' WHERE listing_id=$listing_id";
                $query = pg_query($conn, $sql);              

                $sql4 = "DELETE FROM offensives WHERE listing_id=$listing_id";
                $query4 = pg_query($conn, $sql4);
            
                $session_message[] = "Listing removed from blacklist";
                $_SESSION['cookies_message'] = $session_message;
                echo "<script> window.history.go(-1); </script>";

            } elseif ($method == "disable_user") {

                $sql3 = "UPDATE users SET user_type='d' WHERE user_id::VARCHAR='$current_listing_owner'";
                $query3 = pg_query($conn, $sql3); 

                $session_message[] = "User added to blacklist";
                $_SESSION['cookies_message'] = $session_message;
                echo "<script> window.history.go(-1); </script>";
                
            } elseif ($method == "enable_user") {

                $sql3 = "UPDATE users SET user_type='p' WHERE user_id::VARCHAR='$current_listing_owner'";
                $query3 = pg_query($conn, $sql3); 

                $session_message[] = "User enabled";
                $_SESSION['cookies_message'] = $session_message;
                echo "<script> window.history.go(-1); </script>";

            } elseif ($method == "disable_provided_user") {

                $sql3 = "UPDATE users SET user_type='d' WHERE user_id::VARCHAR='$provided_user'";
                $query3 = pg_query($conn, $sql3); 

                pg_query($conn, "DELETE FROM favourites WHERE user_id::VARCHAR='$provided_user'");

                $session_message[] = "User added to blacklist";
                $_SESSION['cookies_message'] = $session_message;
                echo "<script> window.history.go(-1); </script>";
                
            } elseif ($method == "enable_provided_user") {

                $sql3 = "UPDATE users SET user_type='p' WHERE user_id::VARCHAR='$provided_user'";
                $query3 = pg_query($conn, $sql3); 

                $session_message[] = "User enabled";
                $_SESSION['cookies_message'] = $session_message;
                echo "<script> window.history.go(-1); </script>";
            }

        } else {
            
        }
    }  else {
        echo "<script> window.history.go(-1); </script>";
    }

require("./footer.php");
?>