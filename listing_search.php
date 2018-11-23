<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->

<?php

$title = "Listing Search";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Listing Search";
$desc = "Dashboard Page of QualityLife";

require('header.php');
?>
<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>

<div class="grid-x my-4">
<?php
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        $search = isset($_COOKIE['search_string'])?$_COOKIE['search_string']:"";
        $city = isset($_COOKIE['search_city'])?$_COOKIE['search_city']:8;
        $bedrooms = isset($_COOKIE['search_bedrooms'])?$_COOKIE['search_bedrooms']:4;
        $min_price = isset($_COOKIE['search_min_price'])?$_COOKIE['search_min_price']:100000;
        $max_price = isset($_COOKIE['search_max_price'])?$_COOKIE['search_max_price']:1600000;

    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $search = strtolower(trimT('search'));
        $city = strtolower(trimT('city'));
        $bedrooms = trimT('bedrooms');
        $min_price = trimT('min_price');
        $max_price = trimT('max_price');

        setcookie('search_string', $search, time() + (60*60*24*30));
        setcookie('search_city', $city, time() + (60*60*24*30));
        setcookie('search_bedrooms', $bedrooms, time() + (60*60*24*30));

        if ($min_price >= $max_price) {
            $errors[] = "Max Price should be greater than Min Price.";
        } else {
        
        setcookie('search_min_price', $min_price, time() + (60*60*24*30));
        setcookie('search_max_price', $max_price, time() + (60*60*24*30));

        $conn = db_connect();
        $output = "";
        // $sql = "SELECT * FROM listings 
        //         ORDER BY listings.created_on DESC";

        $sql = "SELECT * FROM listings WHERE ( LOWER(headline) LIKE '%$search%' 
            OR LOWER(description) LIKE '%$search%' )
            AND bedrooms = '$bedrooms'
            AND (price >= $min_price 
            AND price <= $max_price )
            ORDER BY listings.created_on DESC";
    
        $result = pg_query($conn, $sql);     

            if ($result == true) {

                if (empty($errors)) {
                   
                    if (pg_num_rows($result) > 0) {
                         print_r($errors);
                        // output data of each row
                        $_SESSION['search_pg_fetch_assoc'] = pg_fetch_assoc($result);
                        
                        header('Location: listing_search_result.php');
                        ob_flush();
                    } else {
                        $errors[] = "No result found";            
                    }

                } else {
                    $errors[] = "Something bad occur. Try again.";               
                }
            } else {
                $errors[] = "Search error, please try again";            
            }
        }
        
    }

    
    if (!empty($errors)) 
    {
        echo "<div class='cell small-12'>";
        echo "<div class='card m-4 p-4'>";
        foreach($errors as $error)
        {
        echo "<p class='red-text'>".$error."</p><br/>";
        }
        echo "</div>";
        echo "</div>";
    }
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" 
    class="cell large-6 large-offset-3 medium-6 medium-offset-3 small-12 p-4 row">

        <h2 class="grey-text text-lighten-1 center">Listing Search</h2>
        <div class="input-field col s12">
            <input id="search" name="search" type="text" class="validate"/>
            <label for="search">Search for anything...</label>
        </div>
        <div class="input-field col s6">
            <?php build_dropdown2("city", "property", "value","city", "City", $city); 
            //build_dropdown2($table, $column_1, $value, $name_value, $lable, $sticky) ?>         
        </div>
        <div class="input-field col s6">
            <?php build_dropdown("bedrooms", "value","bedrooms", "No of bedrooms", $bedrooms); ?>
        </div>
        <div class="input-field col s6">
            <?php build_dropdown2("search_price", "property_v", "property","min_price", "Minimum Price", $min_price); ?>
        </div>
        <div class="input-field col s6">
            <?php build_dropdown2("search_price", "property_v", "property","max_price", "Maximum Price", $max_price); ?>
        </div>
        <div class="input-field col s12 center">
            <button class="btn grey darken-2 waves-effect waves-light z-depth-4" type="submit" name="search_btn">Search
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
</div>

<?php

require("./footer.php");

?>