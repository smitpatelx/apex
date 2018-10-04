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
<script>
    var listings;
    var sql = "SELECT * FROM listing_demo ORDER BY listing_demo.id DESC";
    $.get("./scripts/functions.php", {
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
            markup += "<div class='card cell z-depth-4 hoverable' data-aos='zoom-out'>";
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
        } catch (error) {

        }

    }

    function pageChange(value) {

        if (page != -1) {
            page += value;
            if (page == -1) {
                page = 0;
            } else if (page * resultsPerPage > listings.length) {

            } else {
                console.log("page changed to " + page);
                offset = page * resultsPerPage;
                PopulateListings();
            }
        }
    }
</script>

<div class="slides slides_listing">
    <img src="./assets/illustrations/1a.jpg" alt="bg">
    <img src="./assets/illustrations/2a.jpg" alt="bg">
    <img src="./assets/illustrations/3a.jpg" alt="bg">
    <img src="./assets/illustrations/4a.jpg" alt="bg">
    <img src="./assets/illustrations/5a.jpg" alt="bg">
    <img src="./assets/illustrations/6a.jpg" alt="bg">
</div>


<script>

</script>

<div class="grid-x grid-margin-x filters_listing">
    <div class="cell medium-2 large-2 small-2">
        <label>Results per page</label>
        <select id="results-per-page">
        </select>
    </div>
</div>
<div class="grid-x grid-margin-x pb-2">
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

<div class="grid-x grid-margin-x pb-2">
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