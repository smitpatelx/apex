<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php
require('./includes/constants.php');
require('./includes/db.php');
require("./includes/functions.php");

if (empty($_SESSION['username_s']) || (($_SESSION['user_type_s'] != AGENT) && ($_SESSION['user_type_s'] != ADMIN))){
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
    $search1 = "trim(LOWER('$_GET[search]%'))";
    $sql2 = "SELECT * FROM listings WHERE ( LOWER(address) LIKE $search1
    OR LOWER(headline) LIKE $search1
    OR price::VARCHAR LIKE $search1
    OR area::VARCHAR LIKE $search1
    OR LOWER(contact) LIKE $search1 )
    AND listings.user_id::VARCHAR = '$user_id_from_session'
    ORDER BY listings.created_on DESC ";

    $result2 = pg_query($conn2, $sql2); 

    while($row2 = pg_fetch_assoc($result2)) {
    echo "<tr class='scroll_snap_item'>";
    echo "<td>".$row2["headline"]."</td>";
    echo "<td>".$row2["address"]."</td>";
    echo "<td>$ ".$row2["price"]."</td>";
    echo "<td>".$row2["area"]." sqft </td>";
    echo "<td>".$row2["contact"]."</td>";
    echo "<td>".listing_status_symbol($row2["status"])."</td>";
    echo "<td><a class='btn teal lighten-1 mx-1' href='./listing_update.php?listing_id=".$row2["listing_id"]."'><i class='fas fa-pen-square'></i></a></td>";
    echo "</tr>";
    }
    ?>       
    </tbody>
    </table>
</div>