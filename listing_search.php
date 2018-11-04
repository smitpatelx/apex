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
    <form action="listing_search_result.php" method="post" 
    class="cell large-6 large-offset-3 medium-6 medium-offset-3 small-12 p-4 col">
        <div class="row">
            <div class="input-field col s12">
                <input id="search" name="search" value="<?php echo ""; ?>" type="text" class="validate"/>
                <label for="search">Search for anything...</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
              <select name="location">
                <!-- <option value=" " disabled selected>Choose User Type</option> -->
                <option value="on">Ontario</option>
                <option value="qc">Quebec</option>
                <option value="bc">British Columbia</option>
                <option value="ab">Albetra</option>
                <option value="ns">Nova Scotia</option>
                <option value="mb">Manitoba</option>
                <option value="sk">Saskatchewan</option>
                <option value="nb">New Brunswick</option>
                <option value="nl">Newfoundland and Labrador</option>
                <option value="pe">Prince Edward Island</option>
              </select>
              <label>Choose Location</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
              <select name="min_price" id="min_price" >
                <option value="100000">100000</option>
                <option value="200000">200000</option>
                <option value="300000">300000</option>
                <option value="400000">400000</option>
                <option value="500000">500000</option>
                <option value="600000">600000</option>
                <option value="700000">700000</option>
                <option value="800000">800000</option>
                <option value="900000">900000</option>
                <option value="1000000">1000000</option>
              </select>
              <label for="min_price">Min Price</label>
                </div>

            <div class="input-field col s6">
              <select name="max_price" id="max_price">
                <option value="100000">100000</option>
                <option value="200000">200000</option>
                <option value="300000">300000</option>
                <option value="400000">400000</option>
                <option value="500000">500000</option>
                <option value="600000">600000</option>
                <option value="700000">700000</option>
                <option value="800000">800000</option>
                <option value="900000">900000</option>
                <option value="1000000">1000000</option>
                <option value="1100000">1100000</option>
              </select>
              <label for="max_price">Max Price</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 center">
                <button class="btn waves-effect waves-light blue lighten-1" type="submit" name="search_btn">Search
                    <i class="fas fa-search"></i>
                </button>
            </div>
          </div>
    </form>
</div>

<?php

require("./footer.php");

?>