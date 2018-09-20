<?php
/*************
Smit Patel
Lab 10: Database/PHP Lab - User Registration
09 April 2018
WEBD2201
**************/
$title = "Listing";
$file = "index.php";
$date = "Sept 14 2018";
$banner = "LISTING";
$desc = "Listing Page of QualityLife";
require("./header.php");
?>

  <div class="slider">
    <ul class="slides">
      <li>
        <img class="bg-blur" src="./assets/illustrations/1a.jpg"> <!-- random image -->
        <div class="caption center-align listing-hero-text">
          <h3>QUALITY LIFE</h3>
          <h5 class="light grey-text text-lighten-3">The Power of Deep Roots</h5>
        </div>
      </li>
      <li>
        <img class="bg-blur" src="./assets/illustrations/2a.jpg"> <!-- random image -->
        <div class="caption left-align listing-hero-text">
          <h3>Move to What Moves You</h3>
          <!-- <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5> -->
        </div>
      </li>
      <li>
        <img class="bg-blur" src="./assets/illustrations/3a.jpg"> <!-- random image -->
        <div class="caption right-align listing-hero-text">
          <h3>Client Focused. Results Driven</h3>
          <!-- <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5> -->
        </div>
      </li>
      <li>
        <img class="bg-blur" src="./assets/illustrations/4a.jpg"> <!-- random image -->
        <div class="caption center-align listing-hero-text">
          <h3>A home changes everything</h3>
          <!-- <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5> -->
        </div>
      </li>
    </ul>
  </div>

  <div class="grid-x grid-padding-x">
  <div class="cell medium-12 large-12 small-12 grid-x grid-margin-x small-up-2 medium-up-2 large-up-4">
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

    echo  "<div class='card cell z-depth-4 hoverable' data-aos='zoom-out'>";
    echo  "<div class='card-image waves-effect waves-block waves-light'>";
    echo  "<img class='activator' src='".$row["img"]."'>";
    echo  "</div>";
    echo  "<div class='card-content'>";
    echo  "<span class='card-title activator grey-text text-darken-4'>".$row["list_heading"]."<i class='material-icons right'>more_vert</i></span>";
    echo  "<p><a href='#' class='btn-flat waves-effect waves-block waves-light z-depth-4'>Know More</a></p>";
    echo  "</div>";
    echo  "<div class='card-reveal'>";
    echo  "<span class='card-title grey-text text-darken-4 '>Information<i class='material-icons right'>close</i></span>";
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

<?php
require("./footer.php");
?>