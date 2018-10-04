<div class="scroll-table-y scroll_snap">
<table class="highlight centered responsive-table">
    <thead class='scroll_snap_item'>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class='transition-1'>
<?php
    require("./scripts/functions.php");

    $conn7 = db_connect();
    $search7 = "trim(LOWER('$_GET[search7]%'))";
    $sql7 = "SELECT * FROM users WHERE LOWER(id::text) LIKE $search7 
        OR LOWER(first_name) LIKE $search7 
        OR LOWER(last_name) LIKE $search7 
        OR LOWER(username) LIKE $search7 
        OR LOWER(email) LIKE $search7 
        ORDER BY users.id DESC";

    $result7 = pg_query($conn7, $sql7); 

    while($row7 = pg_fetch_assoc($result7)) {
    echo "<tr class='scroll_snap_item'>";
    echo "<td>".$row7["id"]."</td>";
    echo "<td>".$row7["first_name"]."</td>";
    echo "<td>".$row7["last_name"]."</td>";
    echo "<td>".$row7["username"]."</td>";
    echo "<td>".$row7["email"]."</td>";
    echo "<td><a class='btn red' href='".$row7["id"]."'><i class='fas fa-trash'></i></a></td>";
    echo "</tr>";
    }
    ?>       
    </tbody>
    </table>
</div>