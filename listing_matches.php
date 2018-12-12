<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php
$title = "Listing Matches";
$file = "listing_matchexs.php";
$date = "Sept 14 2018";
$banner = "LISTING";
$desc = "Listing Page of QualityLife";
require("./header.php");

if (!isset($_SESSION['username_s'])){
    $session_message = [];
    $session_message[] = "Unauthorized access blocked.";
    $_SESSION['cookies_message'] = $session_message;   
    header('Location: ./login.php');
    ob_flush();  //Flush output buffer
}
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

    <?php 

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        if (!isset($_COOKIE['city_select']) || !isset($_COOKIE['search_bedrooms']) || 
        !isset($_COOKIE['search_min_price']) || !isset($_COOKIE['search_max_price'])) {
            
            $session_message = [];
            $session_message[] = "Please select search paramaters.";
            $_SESSION['cookies_message'] = $session_message;
            header("Location: ./listing_city_select.php");
            ob_flush();
        }

        $search = isset($_COOKIE['search_string'])?$_COOKIE['search_string']:"";
        $bedrooms = $_COOKIE['search_bedrooms'];
        $min_price = $_COOKIE['search_min_price'];
        $max_price = $_COOKIE['search_max_price'];
        $city_select = $_COOKIE['city_select'];

        $results_per_page = 10;
        $number_of_results = 0;

        $conn = db_connect();

        $sql = "";
        $sql .= "SELECT * FROM listings WHERE
            1 = 1 AND ( LOWER(headline) LIKE '%$search%' 
            OR LOWER(description) LIKE '%$search%' )
            AND (";
        $txt = get_checkbox_value("city", "property" , "value", $city_select);
        $str = preg_replace('/\W\w+\s*(\W*)$/', '$1', $txt);
        // echo $str;
        $sql .= $str;
        $sql .= ") AND bedrooms = '$bedrooms'
            AND ( price >= $min_price 
            AND price <= $max_price )
            AND ( status ='o' OR status ='s' )
            ORDER BY listings.created_on DESC ";

        $result = pg_query($conn, $sql);

        $number_of_results = pg_num_rows($result);    

        // echo $number_of_results;
        $number_of_pages = ceil($number_of_results/$results_per_page);

        $current_page_number = isset($_GET['page'])?$_GET['page']:$_GET['page']='1';
        $_SESSION['listing_matches.php'] = isset($_GET['page'])?$_GET['page']:$_GET['page']='1';
        
        echo "<div class='grid-x grid-margin-x p-4 m-4'>";
        echo "<a class='cell small-2 small-offset-5 btn waves-effect waves-block waves-light z-depth-4 blue-grey lighten-2 white-text btn-rounded' href='./listing_city_select.php'><i class='fas fa-chevron-left'></i> BACK</a>";
        echo "<h5 class='cell small-12 '><span class='left'>PAGE ".$current_page_number." </span><span class='red-text h6 right'>Number of results: ".$number_of_results."</span></h5>";
        for ($page=1;$page<=$number_of_pages; $page++) {
            
            echo "<div class='cell small-1'>
                        <a class='btn-small waves-effect  waves-light z-depth-4";
            if ($page == $_GET['page']) {
                echo " red ";
            } else {
                echo " blue-grey ";
            }
            echo "darken-1 white-text' href='./listing_matches.php?page=".$page."'>".$page."</a>
                </div>";
        }
        echo "</div>";

        if(!isset($_GET['page'])) {
             $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $this_page_first_result = ($page-1)*$results_per_page;

        $sql2 = "";
        $sql2 .= "SELECT * FROM listings WHERE
            1 = 1 AND ( LOWER(headline) LIKE '%$search%' 
            OR LOWER(description) LIKE '%$search%' )
            AND (";
        $txt = get_checkbox_value("city", "property" , "value", $city_select);
        $str = preg_replace('/\W\w+\s*(\W*)$/', '$1', $txt);
        // echo $str;
        $sql2 .= $str;
        $sql2 .= ") AND bedrooms = '$bedrooms'
            AND ( price >= $min_price 
            AND price <= $max_price )
            AND ( status ='o' OR status ='s' )
            ORDER BY listings.created_on DESC LIMIT '$results_per_page' OFFSET '$this_page_first_result'";

        $result = pg_query($conn, $sql2);

        echo "<div class='grid-x grid-padding-x' style='justify-content: center;'>
                <div id='listing-output' class='cell medium-12 large-12 small-12 grid-x grid-margin-x small-up-2 medium-up-2 large-up-4'>";
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
            echo  "<p><a href='./listing_display.php?listing_id=".$row["listing_id"]."' class='btn waves-effect waves-block waves-light z-depth-4 blue-grey darken-1 white-text position-fixed-bottom'>Know More</a></p>";
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
        echo "</div> </div>";

        echo "<div class='grid-x grid-margin-x p-4 m-4'>";
        for ($page=1;$page<=$number_of_pages; $page++) {
            
            echo "<div class='cell small-1'>
                        <a class='btn-small waves-effect  waves-light z-depth-4";
            if ($page == $_GET['page']) {
                echo " red ";
            } else {
                echo " blue-grey ";
            }
            echo "darken-1 white-text' href='./listing_matches.php?page=".$page."'>".$page."</a>
                </div>";           
        }
        echo "<br/><br/><h5 class='cell small-12 '><span class='left'>PAGE ".$current_page_number." </span><span class='red-text h6 right'>Number of results: ".$number_of_results."</span></h5>";
        echo "</div>";
    }
?>

<?php
require("./footer.php");
?>