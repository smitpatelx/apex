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
        $('.preloader-background').hide();
    });      
</script>

<div class="grid-x my-4">
<?php
    $errors = [];
    // $city_selected = $_GET['city_value'];

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        $search = isset($_COOKIE['search_string'])?$_COOKIE['search_string']:"";
        // $city = isset($_GET['city_value'])?$_GET['city_value']:$_COOKIE['search_city'];
        $bedrooms = isset($_COOKIE['search_bedrooms'])?$_COOKIE['search_bedrooms']:4;
        $min_price = isset($_COOKIE['search_min_price'])?$_COOKIE['search_min_price']:100000;
        $max_price = isset($_COOKIE['search_max_price'])?$_COOKIE['search_max_price']:1600000;

        if (isset($_GET['city'])) {
            $city_select = sum_check_box($_GET['city']);
            setcookie('city_select', $city_select, time() + COOKIES_EXP);
        } else {
            if (isset($_GET['city_value'])) {
                $get_city_value = [];
                $get_city_value_string = $_GET['city_value'];
                // $get_city_value[] = $get_city_value_string;
                // $get_city_value[] = sum_check_box($get_city_value);
                setcookie('city_select', $get_city_value_string, time() + COOKIES_EXP);
            } else {
                $session_message = [];
                $session_message[] = "Please select any city";
                $_SESSION['cookies_message'] = $session_message;
                header("Location: ./listing_city_select.php");
                ob_flush();
            }
        }
             
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $search = strtolower(trimT('search'));
        // $city = strtolower(trimT('city'));
        $bedrooms = trimT('bedrooms');
        $min_price = trimT('min_price');
        $max_price = trimT('max_price');
        $city_select = $_COOKIE['city_select'];

        setcookie('search_string', $search, time() + COOKIES_EXP);
        setcookie('search_bedrooms', $bedrooms, time() + COOKIES_EXP);

        if ($min_price >= $max_price) {
            $errors[] = "Max Price should be greater than Min Price.";
        } else {
        
        setcookie('search_min_price', $min_price, time() + COOKIES_EXP);
        setcookie('search_max_price', $max_price, time() + COOKIES_EXP);

        $conn = db_connect();
        $output = "";
        // $sql = "SELECT * FROM listings 
        //         ORDER BY listings.created_on DESC";
        $sql = "";
        $sql .= "SELECT listings.listing_id FROM listings WHERE
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
            AND status = 'o'
            ORDER BY listings.created_on DESC  LIMIT 200";

    //         SELECT listings.listing_id FROM listings 
	// WHERE 1 = 1 AND (listings.city = 4 OR listings.city = 8 OR listings.city = 64) 
	// AND (listings.bedrooms = 16 OR listings.bedrooms = 32) 
	// AND (listings.property_type = 2 OR listings.property_type = 8 OR listings.property_type = 128) 
	// AND listings.price >= 125000 AND listings.price <= 300000 
	// AND listings.listing_status = 'o'
	// ORDER BY listings.listing_id DESC LIMIT 200
    
        $result = pg_query($conn, $sql);     
        $data = pg_fetch_assoc($result);
        $record = $data;
        $user_id_array = [];
        while($data = pg_fetch_assoc($result)) {
            $user_id_array[] = $data['listing_id'];
        }
            if ($result == true) {

                if (empty($errors)) {
                   
                    if (pg_num_rows($result) > 0) {

                        if (pg_num_rows($result) == 1) {
                            header("Location: ./listing_display.php?listing_id='".$record['listing_id']."'");
                            ob_flush();
                        } else {
                            $_SESSION['search_pg_fetch_assoc'] = $user_id_array;
                            header('Location: ./listing_matches.php');
                            ob_flush();
                        }
                    } else {
                        $errors[] = "No result found. Please expand your search.";            
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
<div class='cell small-12'>
    <div class='card m-4 p-4'>
        <h3> You have selected the following cities: </h3>
        <h6>
        <?php   
            if (isset($city_select)){
                display_selected_checkbox("city", "property" , "value", $city_select);
            } else {
                display_selected_checkbox("city", "property" , "value", $get_city_value_string);
            }
        ?>
        </h6>
        <h5 class="grey-text text-lighten-1">To change your selection <a href='listing_city_select.php' class="red-text text-lighten-1">click here</a>.</h5>
    </div>
</div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" 
    class="cell large-6 large-offset-3 medium-6 medium-offset-3 small-12 p-4 row">

        <h2 class="grey-text text-lighten-1 center">Listing Search</h2>
        <div class="input-field col s12">
            <input id="search" name="search" type="text" class="validate"/>
            <label for="search">Search for anything...</label>
        </div>
        <!-- <div class="input-field col s6">
            <?php //build_dropdown2("city", "property", "value","city", "City", $city); 
            //build_dropdown2($table, $column_1, $value, $name_value, $lable, $sticky) ?>         
        </div> -->
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