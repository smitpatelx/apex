<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php
$title = "Listing";
$file = "index.php";
$date = "Sept 14 2018";
$banner = "LISTING";
$desc = "Listing Page of QualityLife";
require("./header.php");

?>
<script type="text/javascript">       
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
<div class="slides slides_listing" style="margin-bottom: 70px;">
    <img src="./assets/illustrations/1a.jpg" alt="bg" />
    <img src="./assets/illustrations/2a.jpg" alt="bg" />
    <img src="./assets/illustrations/3a.jpg" alt="bg" />
    <img src="./assets/illustrations/4a.jpg" alt="bg" />
    <img src="./assets/illustrations/5a.jpg" alt="bg" />
    <img src="./assets/illustrations/6a.jpg" alt="bg" />
</div>

<!-- <div class="grid-x filters_listing" style="margin-top: 0;">
    <div class="cell medium-2 large-2 small-2" style="width:120px;">
        <label>Results per page</label>
        <select id="results-per-page">
        </select>
    </div>
</div>
<div class="grid-x grid-margin-x pb-4">
    <div class="cell large-1 large-offset-5">
        <a class="btn-small" onclick="pageChange(-1)" style="float: right;"><i class="fas fa-arrow-left"></i></a>
    </div>
    <div class="cell large-1">
        <a class="btn-small" onclick="pageChange(1)"><i class="fas fa-arrow-right"></i></a>
    </div>
</div> -->

<div class="grid-x grid-padding-x" style="justify-content: center;">
    <div id="listing-output" class="cell medium-12 large-12 small-12 grid-x grid-margin-x small-up-2 medium-up-2 large-up-4">
    <?php 

    if (isset($_SESSION['search_pg_fetch_assoc'])) {
        // output data of each row
        foreach($_SESSION['search_pg_fetch_assoc'] as $user_id_result) {
            // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";

        $conn = db_connect();

        $sql = "SELECT * FROM listings WHERE user_id = '$user_id_result'";
        $result = pg_query($conn, $sql);
        
        while($row = pg_fetch_assoc($result)){
        $image_link = "";
        $image_link = $row["images_path"];
        if (true == checkRemoteFile($image_link)) {
            // $image_link = $row["images_path"];
            $image_link = $image_link;
        } else {
            $image_link = "./images/no_image.svg";
        }
        echo  "<div class='card cell medium-3 large-3 small-6 z-depth-4 hoverable' data-aos='fade-up' data-aos-offset='200'>";
        echo  "<div class='card-image waves-effect waves-block waves-light'>";
        echo  "<img class='activator' src='".$image_link."' alt='img_".$row["listing_id"]."' />";
        echo  "</div>";
        echo  "<div class='card-content'>";
        echo  "<span class='card-title activator blue-text text-darken-4'>".$row["headline"]."<i class='fas fa-ellipsis-v right'></i></span>";
        echo  "<p><a href='/listing_display.php?listing_id=".$row["listing_id"]."' class='btn waves-effect waves-block waves-light z-depth-4 blue-grey darken-1 white-text position-fixed-bottom'>Know More</a></p>";
        echo  "</div>";
        echo  "<div class='card-reveal p-0'>";
        echo  "<span class='card-title white-text text-darken-4 grey p-2'>Information <i class='fas fa-times right p-4'></i></span>";
        echo  "<ul>";
        echo     "<li>Location: ".$row["address"]."</li>";
        echo      "<li>Price: $".$row["price"]."</li>";
        echo      "<li>Space: ".$row["area"]." sqft</li>";
        echo    "</ul>";
        echo  "</div>";
        echo"</div>";     
        }
    }

    } else {
        header('Location: listing_search.php');
        ob_flush();
    }

?>
    </div>
</div>

<!-- <div class="grid-x grid-margin-x pt-3 pb-2">
    <div class="cell large-1 large-offset-5">
        <a class="btn-small" onclick="pageChange(-1)" style="float: right;"><i class="fas fa-arrow-left"></i></a>
    </div>
    <div class="cell large-1">
        <a class="btn-small" onclick="pageChange(1)"><i class="fas fa-arrow-right"></i></a>
    </div>
</div> -->


<?php
require("./footer.php");
?>