<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->

<?php

$title = "Listing Update";
$file = "listing_images.php";
$date = "Sept 14 2018";
$banner = "Listing Update";
$desc = "Dashboard Page of QualityLife";
require("./header.php");

if (empty($_SESSION['username_s'])){
    $session_message = [];
    $session_message[] = "Unauthorized access blocked.";
    $_SESSION['cookies_message'] = $session_message;   
    header('Location: ./login.php');
    ob_flush();  //Flush output buffer
} else if ( $_SESSION['user_type_s'] == CLIENT) {
    header('Location: ./welcome.php');
    ob_flush();  //Flush output buffer
}
?>

<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>

<div class="slides slides_listing" style="margin-bottom: 70px;">
    <img src="./assets/illustrations/1a.jpg" alt="bg" />
    <img src="./assets/illustrations/2a.jpg" alt="bg" />
    <img src="./assets/illustrations/3a.jpg" alt="bg" />
    <img src="./assets/illustrations/4a.jpg" alt="bg" />
    <img src="./assets/illustrations/5a.jpg" alt="bg" />
    <img src="./assets/illustrations/6a.jpg" alt="bg" />
</div>

<?php
    $session_message = [];
    $errors = []; // Store all foreseen and unforseen errors here

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $image_id = $_GET["image_id"];
        
        $conn = db_connect();
        $sql = "SELECT * FROM listings WHERE listing_id = $image_id ";
        $query = pg_query($conn, $sql);

        $row = pg_fetch_assoc($query);

        echo "<div class='slides slides_listing' style='margin-bottom: 70px;'>";
        foreach(range(0, 2) as $x) {           
            echo "<img src='".$row['images_path']."' alt='bg' />";           
        }
        echo "</div>";
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

    }

?>

<div class='grid-x py-4'>
    <form class='cell medium-5 medium-offset-4 center row' action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' enctype="multipart/form-data" >
        <div class="file-field input-field col s12">
            <h6  class="grey-text text-lighten-1">Images</h6>
            <div class="btn">
                <span>File</span>
                <input type="file" name="dsh_post_file" value="<?php echo $dsh_post_file; ?>" multiple/>
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" id="Upload_one_or_more_files" name="dsh_post_file1" />                               
            </div>
        </div>
        <div class='input-field col s12 center'>
            <!-- <input type="submit" class="btn waves-effect waves-light cayan lighten-1" name="submit"> -->
            <button class="btn grey darken-2 waves-effect waves-light z-depth-4" name="dsh_post_submit" type="submit">
                UPLOAD <i class="fas fa-check"></i> 
            </button>
        </div>
    </form>
</div>
<?php
require("./footer.php");
?>