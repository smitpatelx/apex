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

<div class="slides slides_listing" style="margin-bottom: 70px;">
    <img src="./assets/illustrations/1a.jpg" alt="bg">
    <img src="./assets/illustrations/2a.jpg" alt="bg">
    <img src="./assets/illustrations/3a.jpg" alt="bg">
    <img src="./assets/illustrations/4a.jpg" alt="bg">
    <img src="./assets/illustrations/5a.jpg" alt="bg">
    <img src="./assets/illustrations/6a.jpg" alt="bg">
</div>

<div class="grid-x filters_listing" style="margin-top: 0;">
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
</div>

<div class="grid-x grid-padding-x" style="justify-content: center;">
    <div id="listing-output" class="cell medium-12 large-12 small-12 grid-x grid-margin-x small-up-2 medium-up-2 large-up-4">
    <?php 
        $conn = db_connect();
        $output = "";
        $sql = "SELECT * FROM listing_demo ORDER BY listing_demo.id DESC";

            $result = pg_query($conn, $sql);
            // $records = pg_num_rows($result);

        if (pg_num_rows($result) > 0) {
            // output data of each row
            while($row = pg_fetch_assoc($result)) {
                // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";

            echo  "<div class='card cell medium-3 large-3 small-6 z-depth-4 hoverable'>";
            echo  "<div class='card-image waves-effect waves-block waves-light'>";
            echo  "<img class='activator' src='".$row["img"]."'>";
            echo  "</div>";
            echo  "<div class='card-content'>";
            echo  "<span class='card-title activator grey-text text-darken-4'>".$row["list_heading"]."<i class='fas fa-ellipsis-v right'></i></span>";
            echo  "<p><a href='#' class='btn-flat waves-effect waves-block waves-light z-depth-4'>Know More</a></p>";
            echo  "</div>";
            echo  "<div class='card-reveal'>";
            echo  "<span class='card-title grey-text text-darken-4 '>Information<i class='fas fa-times right'></i></span>";
            echo  "<ul>";
            echo     "<li>Location: ".$row["location"]."</li>";
            echo      "<li>Price: $".$row["price"]."</li>";
            echo      "<li>Space: ".$row["sqft"]." sqft</li>";
            echo      "<li>Contact: ".$row["phone"]."</li>";
            echo    "</ul>";
            echo  "</div>";
            echo"</div>";
        }
        }
    ?>
    </div>
</div>

<div class="grid-x grid-margin-x pt-3 pb-2">
    <div class="cell large-1 large-offset-5">
        <a class="btn-small" onclick="pageChange(-1)" style="float: right;"><i class="fas fa-arrow-left"></i></a>
    </div>
    <div class="cell large-1">
        <a class="btn-small" onclick="pageChange(1)"><i class="fas fa-arrow-right"></i></a>
    </div>
</div>


<?php
require("./footer.php");
?>