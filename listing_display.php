<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

$title = "Listing Display";
$file = "listing-display.php";
$date = "Sept 14 2018";
$banner = "Listing Display";
$desc = "Listing Display Page";

require('header.php');
?>
<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>
<?php 
  $conn = db_connect();
  $output = "";
  $sql = "SELECT * FROM listing_demo WHERE id = 14 ORDER BY listing_demo.id DESC";

	$result = pg_query($conn, $sql);
	// $records = pg_num_rows($result);

 if (pg_num_rows($result) > 0) {
    // output data of each row
    while($row = pg_fetch_assoc($result)) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    echo "<div class='grid-x my-4'>";
        echo "<div class='cell large-6 large-offset-3'>";
            echo  "<div class='card z-depth-4 hoverable' data-aos='zoom-out'>";
                echo  "<div class='card-image waves-effect waves-block waves-light'>";
                echo  "<img class='activator' src='".$row["img"]."' alt='".$row["img"]."' />";
                echo  "</div>";
            echo  "<div class='card-content'>";
        echo  "<h2  class='card-title activator grey-text text-darken-4'>Heading: <span>".$row["list_heading"]."</span> </h2>";
        echo "<span class='card-title grey-text text-darken-4 h3'>Information</span>";
        echo "<ul>";
        echo "<li>Location: ".$row["location"]."</li>";
        echo "<li>Price: $".$row["price"]."</li>";
        echo "<li>Space: ".$row["sqft"]." sqft</li>";
        echo "<li>Contact: ".$row["phone"]."</li>";
        echo "</ul>";
        echo  "</div>";
    echo"</div>";
    echo"</div>";
    echo"</div>";
  }
}
  ?>

<?php
require("./footer.php");
?>