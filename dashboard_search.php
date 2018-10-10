 <!-- /*
FILE:                   login.php
TITLE:                  Apex Listings - User Login Page
AUTHORS:                Blake Phillips, Smit Patel, Clayton Galliah-Penhale, Dylan Lopez
LAST MODIFIED:          October 4, 2018
DESCRIPTION:            Allows users to login to their profiles or allows new users to create an account
**/  -->
<?php
if (empty($_SESSION['username_s']) || ($_SESSION['user_type_s'] != "a" || $_SESSION['user_type_s'] != "s")){
    header('Location: 405.php');
}
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
            <th>Action</th>
        </tr>
    </thead>
    <tbody class='transition-1'>
<?php
require("./includes/functions.php");


    $conn2 = db_connect();
    $search1 = "trim(LOWER('$_GET[search]%'))";
    $sql2 = "SELECT * FROM listing_demo WHERE LOWER(location) LIKE $search1
    OR LOWER(list_heading) LIKE $search1
    OR LOWER(price) LIKE $search1
    OR LOWER(sqft) LIKE $search1
    OR LOWER(phone) LIKE $search1
    ORDER BY listing_demo.price DESC";

    $result2 = pg_query($conn2, $sql2); 

    while($row2 = pg_fetch_assoc($result2)) {
    echo "<tr class='scroll_snap_item'>";
    echo "<td>".$row2["list_heading"]."</td>";
    echo "<td>".$row2["location"]."</td>";
    echo "<td>$ ".$row2["price"]."</td>";
    echo "<td>".$row2["sqft"]." sqft </td>";
    echo "<td>".$row2["phone"]."</td>";
    echo "<td><a class='btn red' href='".$row2["id"]."'><i class='fas fa-trash'></i></a><a class='btn teal lighten-1 mx-1' href='".$row2["id"]."'><i class='fas fa-pen-square'></i></a></td>";
    echo "</tr>";
    }
    ?>       
    </tbody>
    </table>
</div>