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

if (empty($_SESSION['username_s']) || ($_SESSION['user_type_s'] != ADMIN)){
    header('Location: 405.php');  
    ob_flush();  //Flush output buffer
}

?>
<div class="scroll-table-y scroll_snap">
<table class="highlight centered responsive-table">
    <thead class='scroll_snap_item'>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class='transition-1'>

<?php

    function user_type_btn($user_id, $user_type){
        $output = "";
        if($user_type == AGENT) {
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=p'>PENDING</a>";
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=d'>DISABLED</a>";
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=c'>CLIENT</a>";
        } else if($user_type == PENDING) {
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=a'>AGENT</a>";
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=d'>DISABLED</a>";
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=c'>CLIENT</a>";
        } else if($user_type == DISABLED) {
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=a'>AGENT</a>";
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=c'>CLIENT</a>";
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=p'>PENDING</a>";
        } else if($user_type == CLIENT) {
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=a'>AGENT</a>";
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=d'>DISABLED</a>";
            $output .= "<a class='btn mx-1 red white-text' href='./change_user_type.php?user_id=".$user_id."&user_type=p'>PENDING</a>";
        }
        return $output;
    }

    $conn2 = db_connect();
    $search1 = "trim(LOWER('$_GET[search]%'))";
    $status = "'$_GET[status]'";
    $sql2 = "SELECT * FROM users WHERE ( LOWER(user_name) LIKE $search1
    OR LOWER(user_id) LIKE $search1
    OR LOWER(first_name) LIKE $search1
    OR LOWER(last_name) LIKE $search1
    OR LOWER(primary_phone_number) LIKE $search1 ) AND user_type::VARCHAR=$status
    ORDER BY enrol_date DESC";

    $result2 = pg_query($conn2, $sql2); 

    while($row2 = pg_fetch_assoc($result2)) {
    echo "<tr class='scroll_snap_item'>";
    echo "<td>".$row2["user_id"]."</td>";
    echo "<td>".$row2["user_name"]."</td>";
    echo "<td>".$row2["salutation"]." ".$row2["first_name"]."</td>";
    echo "<td>".$row2["last_name"]."</td>";
    echo "<td>".$row2["primary_phone_number"]."</td>";
    echo "<td>".user_type_btn($row2["user_id"], $row2["user_type"])."</td>";
    echo "</tr>";
    }
?>       
    </tbody>
    </table>
</div>
