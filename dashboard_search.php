<div class="scroll-table-y">
<table class="highlight centered responsive-table">
    <thead>
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
require("./scripts/functions.php");
    // $conn2 = db_connect();
    // $sql2 = "SELECT * FROM listing_demo WHERE location LIKE '$_GET[search]%'";

    // $result2 = pg_query($conn2, $sql2);

  

    // while($row2 = pg_fetch_assoc($result2)) {   
                
    // echo "<h5 class='black-text waves-effect list-block'>".$row2["location"]."</h5><br>";
    // }
    $conn2 = db_connect();
    $search1 = "trim(LOWER('$_GET[search]%'))";
    $sql2 = "SELECT * FROM listing_demo WHERE LOWER(location) LIKE $search1
    OR LOWER(list_heading) LIKE $search1
    OR LOWER(price) LIKE $search1
    OR LOWER(sqft) LIKE $search1
    OR LOWER(phone) LIKE $search1
    ORDER BY listing_demo.price DESC";

    function delRow($table,$delValue){
    $conn2 = db_connect();
    $sql_del2 = "DELETE FROM $table WHERE id = $delValue";
    $delResult2 = pg_query($conn2, $sql_del2);

    //delRow("listing_demo",$row2["id"])
    }
// delRow('listing_demo',$row2["id"])
    $result2 = pg_query($conn2, $sql2); 

    while($row2 = pg_fetch_assoc($result2)) {
    echo "<tr>";
    echo "<td>".$row2["list_heading"]."</td>";
    echo "<td>".$row2["location"]."</td>";
    echo "<td>$ ".$row2["price"]."</td>";
    echo "<td>".$row2["sqft"]." sqft </td>";
    echo "<td>".$row2["phone"]."</td>";
    echo "<td><a class='btn red' href='".$row2["id"]."'><i class='fas fa-trash'></i></a></td>";
    echo "</tr>";
    }
    ?>       
    </tbody>
    </table>
</div>