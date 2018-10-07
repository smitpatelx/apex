<?php
/*
FILE:                   login.php
TITLE:                  Apex Listings - User Login Page
AUTHORS:                Blake Phillips, Smit Patel, Clayton Galliah-Penhale, Dylan Lopez
LAST MODIFIED:          October 4, 2018
DESCRIPTION:            Allows users to login to their profiles or allows new users to create an account
**/
$title = "Listing";
$file = "index.php";
$date = "Sept 14 2018";
$banner = "LISTING";
$desc = "Listing Page of QualityLife";
require("./header.php");
?>
    <script>       
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
<script>
    var listings;
    var sql = "SELECT * FROM listing_demo ORDER BY listing_demo.id DESC";
    $.get("./includes/functions.php", {
        "sql": sql
    }, function($data) {
        listings = $data;
    }).done(function() {
        listings = JSON.parse(listings);
    });

    var resultsPerPageArr = [8, 16, 32, -1];
    var resultsPerPage = resultsPerPageArr[0];

    var page = 0;
    var offset = page * resultsPerPage;

    $(document).ready(function() {
        resultsPerPageArr.forEach(function(value) {
            var o = new Option((value == -1 ? "Infinite" : value), value);
            $("#results-per-page").append(o);
        });

        $("#results-per-page").change(function() {
            resultsPerPage = $("#results-per-page").val();
            if (resultsPerPage == -1) {
                resultsPerPage = listings.length;
                $(".btn-small").hide();
            } else {
                $(".btn-small").show();
            }
            page = 0;
            console.log("Results per page: " + resultsPerPage);
            offset = page * resultsPerPage;
            PopulateListings();
        });

        $("#listing-output").ready(function() {
            PopulateListings();
        });

    });

    function PopulateListings() {
        if (page >= 0) {
            $("#listing-output").html("");
            for (var i = 0; i < resultsPerPage; i++) {
                i += offset;
                PrintListing($("#listing-output"), i);
                i -= offset;
            }

        }

    }

    function PrintListing(div, i) {
        try {
            var markup = "";
            markup += "<div class='card cell z-depth-4 hoverable'";
                       markup += "data-aos='zoom-out'";
            markup += ">";
            markup += "<div class='card-image waves-effect waves-block waves-light'>";
            markup += "<img class='activator' src='" + listings[i].img + "'>";
            markup += "</div>";
            markup += "<div class='card-content'>";
            markup += "<span class='card-title activator grey-text text-darken-4'>" + listings[i].list_heading + "<i class='material-icons right'>more_vert</i></span>";
            markup += "<p><a href='#' class='btn-flat waves-effect waves-block waves-light z-depth-4'>Know More</a></p>";
            markup += "</div>";
            markup += "<div class='card-reveal'>";
            markup += "<span class='card-title grey-text text-darken-4 '>Information<i class='material-icons right'>close</i></span>";
            markup += "<ul>";
            markup += "<li>Location: " + listings[i].location + "</li>";
            markup += "<li>Price: $" + listings[i].price + "</li>";
            markup += "<li>Space: " + listings[i].sqft + " sqft</li>";
            markup += "<li>Contact: " + listings[i].phone + "</li>";
            markup += "</ul>";
            markup += "</div>";
            markup += "</div>";
            div.append(markup);
        } catch (error) {}

    }

    function pageChange(value) {
        if (value == 1 && (page + 1) * resultsPerPage < listings.length) {
            page ++;
            console.log("Page changed to " + (page + 1) + "...\nDisplaying results " + (page * resultsPerPage) + " to " + ((page + 1) * resultsPerPage));
            offset = page * resultsPerPage;
            PopulateListings();
        }
        if (value == -1 && page > 0) {
            page --;
            console.log("Page changed to " + (page + 1) + "...\nDisplaying results " + (page * resultsPerPage) + " to " + ((page + 1) * resultsPerPage));
            offset = page * resultsPerPage;
            PopulateListings();
        }
    }
</script>

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