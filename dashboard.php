<?php
/*************
Smit Patel
Lab 10: Database/PHP Lab - User Registration
09 April 2018
WEBD2201
**************/
$title = "Dashboard";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Dashboard";
$desc = "Dashboard Page of QualityLife";
require("./header.php");
?>

    <div class="grid-x">       
        <div class="cell large-2 medium-2 small-2 center pr-3">
            <ul id="slide-out" class="admin_nav">
                <li>
                <div class="user-view">
                    <div class="background user-dashboard-img">
                        <img src="./assets/bg/1511.jpg" class="full-width">
                    
                        <a href="#user"><img class="circle" src="./assets/list-images/profile.jpg"></a>
                    </div>
                    
                </div>
                </li>
                <li class="list-block pt-2 py-2"><a href="#" class="welcomebtn_dashboard my-2"><i class="fas fa-user mr-3"></i>John Doe</a></li>
                <li class="list-block pt-2 py-2"><a href="#!" class=" my-2"><i class="fas fa-at mr-3"></i>email</i>jdandturk@gmail.com</a></li>
                <li><div class="divider"></div></li>
                <li class="waves-effect list-block pt-2"><a href="#!" class=" my-2 postbtn_dashboard"><i class="fas fa-pen mr-3"></i>Posts</a></li>
                <li class="waves-effect list-block pt-2"><a href="#!" class=" my-2 passbtn_dashboard"><i class="fas fa-user-lock mr-3"></i>Change Password</a></li>
                <li class="waves-effect list-block pt-2"><a class=" my-2 usersbtn_dashboard" href="#!"><i class="fas fa-users mr-3"></i>Users</a></li>
            </ul>
            <!-- <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons small">menu</i></a> -->
        </div>
         
        
        <div class="cell large-10 medium-10 small-10 p-4">
            <div class="welcome_dashboard center blue-text">
                <h1 class='dosis'>WELCOME SMIT</h1>
            </div>
            <div class="pass_dashboard center">
                <div class='grid-x'>
                    <h2 class='cell medium-5 medium-offset-3 center red-text dosis'>Change Password</h2>
                    <form class='cell medium-5 medium-offset-3 center row' action='dashboard.php'>
                        <div class="input-field col s6">
                            <input placeholder="Current Password" id="current_password" type="password" class="validate">
                            <label for="first_name">Current Password</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="New Password" id="new_password" type="password" class="validate">
                            <label for="last_name">New Password</label>
                        </div>
                        <div class='input-field col s12 center'>
                            <button class="btn waves-effect waves-light blue lighten-1" type="submit" name="action">Sign Up
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="users_dashboard center">
                <h2 class='dosis'>Users</h2>
                <table class="highlight centered responsive-table">
                        <thead>
                          <tr>
                              <th>User ID</th>
                              <th>Email</th>
                              <th>Name</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>00001</td>
                                <td>admin@admin.com</td>
                                <td>Smit Patel</td>
                                <td><a class='btn red' href='#'><i class='fas fa-trash'></i></td>
                            </tr>
                        </tbody>
                </table>
            </div>
            <div class="post_dashboard">
                <div>
                    <form class="">                 
                        <div class="input-field col s6">
                        <i class="fas fa-search-location prefix"></i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Search By Location</label>
                        </div>
                    </form>  
                </div>
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
                        <tbody>
                        <?php
                            $conn = db_connect();
                            $output = "";
                            $sql = "SELECT * FROM listing_demo ORDER BY listing_demo.id DESC";
                
                            $result = pg_query($conn, $sql);
                            // $records = pg_num_rows($result);
                
                            if (pg_num_rows($result) > 0) {
                            // output data of each row
                            while($row = pg_fetch_assoc($result)) {   
                                        
                            echo "<tr>";
                            echo "<td>".$row["list_heading"]."</td>";
                            echo "<td>".$row["location"]."</td>";
                            echo "<td>$ ".$row["price"]."</td>";
                            echo "<td>".$row["sqft"]." sqft </td>";
                            echo "<td>".$row["phone"]."</td>";
                            echo "<td><a class='btn red' href='".$row["id"]."'><i class='fas fa-trash'></i></a></td>";
                            echo "</tr>";
                            }
                            }        
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

<?php
require("./footer.php");
?>