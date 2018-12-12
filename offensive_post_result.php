<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php
ob_start();
require('./includes/constants.php');
require('./includes/db.php');
require("./includes/functions.php");

if (empty($_SESSION['username_s']) || ($_SESSION['user_type_s'] != ADMIN)){
    header('Location: ./405.php');  
    ob_flush();  //Flush output buffer
}
// echo $_SESSION['username_s'];
// echo $_SESSION['user_type_s'];
?>
<div class="scroll-table-y scroll_snap">
<table class="highlight centered responsive-table">
    <thead class='scroll_snap_item'>
        <tr>
            <th>Title</th>
            <th>Location</th>
            <th>Price</th>
            <th>Space</th>
            <th>Contact</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class='transition-1'>
<?php

    $user_id_from_session = $_SESSION['user_id_s'];
    $conn2 = db_connect();
    $search = "trim(LOWER('$_GET[search]%'))";
    $sql22 = "SELECT * FROM listings 
            INNER JOIN
            offensives ON 
            offensives.listing_id=listings.listing_id  AND ( LOWER(listings.address) LIKE $search
            OR LOWER(listings.headline) LIKE $search
            OR listings.price::VARCHAR LIKE $search
            OR listings.area::VARCHAR LIKE $search
            OR LOWER(listings.contact) LIKE $search ) 
            ORDER BY offensives.reported_on DESC ";

    $query22 = pg_query($conn2, $sql22); 

    while($data1 = pg_fetch_assoc($query22)) {

        echo "<tr class='scroll_snap_item' style='border-top:2px solid grey;border-right:2px solid grey;border-left:2px solid grey;'>";
        echo "<td>".$data1["headline"]."</td>";
        echo "<td>".$data1["address"]."</td>";
        echo "<td>$ ".$data1["price"]."</td>";
        echo "<td>".$data1["area"]." sqft </td>";
        echo "<td>".$data1["contact"]."</td>";
        echo $data1["status"];
        echo "<td>".listing_status_symbol($data1["status"])."</td>";
        echo "<td><a class='btn teal lighten-1 white-text mx-1' href='./listing_display.php?listing_id=".$data1["listing_id"]."'>GOTO</a></td>";
        echo "</tr>";

        $user_id = $data1['user_id'];
        $sql="SELECT * FROM users WHERE user_id::VARCHAR=( SELECT user_id FROM offensives 
        WHERE offensives.listing_id=".$data1['listing_id']." AND offensives.user_id::VARCHAR='$user_id')";
        $query=pg_query($conn2, $sql);
        $data=pg_fetch_assoc($query);
        
        echo "<tr class='scroll_snap_item' style='border-bottom:2px solid grey;border-right:2px solid grey;border-left:2px solid grey;'>";
        echo "<td colspan=7><b> Reported By : </b>".$data['salutation']." ".$data['first_name']." ".$data['last_name']."<b class='pl-4 ml-4'> User ID : </b>".$data['user_id']."<span class='pl-4 ml-4'></span>".admin_provided_user_to_blacklist_btn($data['user_id'], $data1["listing_id"])."</td>";
        echo "</tr>";

    }
?>       
    </tbody>
    </table>
</div>