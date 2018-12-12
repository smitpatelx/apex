<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
 <?php

$title = "Home";
$file = "index.php";
$date = "Sept 14 2018";
$banner = "Welcome";
$desc = "Home Page of QualityLife";
require("./header.php");

if (empty($_SESSION['username_s']) || $_SESSION['user_type_s'] != CLIENT){
    header('Location: 405.php');
    ob_flush();  //Flush output buffer
}
?>
<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>
 <div class="row">
        <div class="col l12 mt-4">
        <div class="card cyan lighten-1 z-depth-4 hoverable">
            <div class="card-content">
            <div class="container home-hero">
                <h6>If you are thinking of buying a home working with a QUALITY LIFE should be your first step. REALTOR.ca can connect you to QUALITY LIFE across Canada and help find the right home for you.<br/>
                    Start your property search with the fully redesigned QUALITY-LIFE.ca app for Android.
                </h6>
            </div>
            </div>
            <div class="card-action center">   
                <a href="listing_search.php" class=" waves-effect waves-light btn blue lighten-4 z-depth-5 cyan-text text-darken-4 transition-1">Listing</a>
            </div>
        </div>
        </div>
</div>
<div class="grid-x welcome_dashboard center cayan-text">

    <?php 

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $results_per_page = 10;
            $number_of_results = 0;

            $user_id_from_session = $_SESSION['user_id_s'];
            $conn = db_connect();
            
            $sql = "SELECT * FROM listings 
            INNER JOIN
            favourites ON 
            favourites.listing_id = listings.listing_id  AND favourites.user_id = '$user_id_from_session'
            ORDER BY listings.created_on DESC";

            $result = pg_query($conn, $sql);

            $number_of_results = pg_num_rows($result);    

            // echo $number_of_results;
            $number_of_pages = ceil($number_of_results/$results_per_page);

            $current_page_number = isset($_GET['page'])?$_GET['page']:$_GET['page']='1';
            echo "<div class='cell small-12 grid-x grid-margin-x p-4 m-4'>";
            echo "<h4 class='cell small-12 center'> Welcome ".$_SESSION['first_name_s']." ".$_SESSION['last_name_s']." !!</h4>";
            echo "<h5 class='cell small-12'><span class='left'>PAGE ".$current_page_number." </span><span class='red-text h6 right'>Number of results: ".$number_of_results."</span></h5>";
            for ($page=1;$page<=$number_of_pages; $page++) {
                
                echo "<div class='cell small-1'>
                            <a class='btn-small waves-effect  waves-light z-depth-4";
                if ($page == $_GET['page']) {
                    echo " red ";
                } else {
                    echo " blue-grey ";
                }
                echo "darken-1 white-text' href='./dashboard.php?page=".$page."'>".$page."</a>
                    </div>";
            }
            echo "</div>";

            if(!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            $this_page_first_result = ($page-1)*$results_per_page;

            $sql2 = "SELECT * FROM listings 
            INNER JOIN
            favourites ON 
            favourites.listing_id = listings.listing_id  AND favourites.user_id = '$user_id_from_session' 
            ORDER BY listings.created_on DESC  LIMIT '$results_per_page' OFFSET '$this_page_first_result'";

            $result = pg_query($conn, $sql2);

            echo "<div class='cell small-12 grid-x grid-padding-x p-3' style='justify-content: center;'> ";

                echo  "<div class='cell small-12 grid-x blue-grey darken-1 white-text p-3'>";
                    echo "<div class='cell small-2 center'><b>Heading</b></div>";
                    echo "<div class='cell small-2 center'><b>Address</b></div>";
                    echo "<div class='cell small-1 center'><b>Price</b></div>";
                    echo "<div class='cell small-2 center'><b>Contact</b></div>";
                    echo "<div class='cell small-2 center'><b>Status</b></div>";
                    echo "<div class='cell small-3 center'><b>Action</b></div>";
                echo"</div>"; 
                echo  "<div class='cell small-12 grid-x p-3'></div>";
                    // <div id='listing-output' class='cell small-12 grid-x grid-margin-x small-up-2 medium-up-2 large-up-4'>
                while($row = pg_fetch_assoc($result)){
                    $image_link = "";
                    $image_link = $row["images_path"];
                    if (true == checkRemoteFile($image_link)) {
                        // $image_link = $row["images_path"];
                        $image_link = $image_link;
                    } else {
                        $image_link = "./images/no_image.svg";
                    }
                    echo  "<div class='cell small-12 z-depth-2 hoverable grid-x p-2'>";
                        // echo  "<div class='card-image col s2 waves-effect waves-block waves-light'>";
                        // echo  "<img class='activator' src='".$image_link."' alt='img_".$row["listing_id"]."' />";
                        // echo  "</div>";
                        echo "<div class='cell small-2'>".$row["headline"]."</div>";
                        echo "<div class='cell small-2'>".$row["address"]."</div>";
                        echo "<div class='cell small-1'>".$row["price"]."</div>";
                        echo "<div class='cell small-2'>".$row["contact"]."</div>";
                        echo "<div class='cell small-2'>".listing_status_symbol($row["status"])."</div>";
                        echo "<div class='cell small-3'>".like_button($_SESSION['user_id_s'], $row["listing_id"])."<a class='mx-1 btn teal lighten-1 white-text' href='./listing_display.php?listing_id=".$row["listing_id"]."'>GOTO</a></div>";
                        // echo "<div class='cell small-2'></div>";
                    echo"</div>";     
                }
            echo " </div>";

            echo "<div class='cell small-12 grid-x grid-margin-x p-4 m-4'>";
            for ($page=1;$page<=$number_of_pages; $page++) {
                
                echo "<div class='cell small-1'>
                            <a class='btn-small waves-effect  waves-light z-depth-4";
                if ($page == $_GET['page']) {
                    echo " red ";
                } else {
                    echo " blue-grey ";
                }
                echo "darken-1 white-text' href='./dashboard.php?page=".$page."'>".$page."</a>
                    </div>";           
            }
            echo "<br/><br/><h5 class='cell small-12 '><span class='left'>PAGE ".$current_page_number." </span><span class='red-text h6 right'>Number of results: ".$number_of_results."</span></h5>";
            echo "</div>";
        }
    ?>
</div>
<?php
require("./footer.php");
?>