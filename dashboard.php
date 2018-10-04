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

    <div class="row">       
        <div class="col l12 m12 s12 center pr-3 dashboard_panel">
            <ul class="">
                <li>
                    <a href="#" class='welcomebtn_dashboard img_c_1'><img class="" src="./assets/list-images/profile.jpg"></a>
                </li>
                <li>
                    <a href="#" class="postbtn_dashboard"><i class="fas fa-pen mr-3"></i><p class='hide-on-med-and-down'>Posts</p></li></a>
                </li>
                <li>
                    <a href="#" class="passbtn_dashboard"><i class="fas fa-user-lock mr-3"></i><p class='hide-on-med-and-down'>Change Password</p></a>
                </li>
                <li>
                    <a href="#" class="usersbtn_dashboard"><i class="fas fa-users mr-3"></i><p class='hide-on-med-and-down'>Users</p></a>
                </li>
            </ul>
            <!-- <ul id="slide-out" class="admin_nav">
                <li>
                <div class="user-view hide-on-med-and-down">
                    <div class="background user-dashboard-img">
                        <img src="./assets/bg/1511.jpg" class="full-width">
                    
                        <a href="#user" class='welcomebtn_dashboard'><img class="circle" src="./assets/list-images/profile.jpg"></a>
                    </div>
                    
                </div>
                </li>
                <a href="#" class="welcomebtn_dashboard my-2"><li class=" py-2"><i class="fas fa-user mr-3"></i><p class='hide-on-med-and-down'>Smit Patel</p></li></a>
                <a href="#" class="welcomebtn_dashboard my-2"><li class=" py-2"><i class="fas fa-at mr-3"></i><p class='hide-on-med-and-down'>admin@netdevv.com</p></li></a>
                <li><div class="divider black"></div></li>
                <a href="#" class=" my-2 postbtn_dashboard"><li class="waves-effect list-block pt-2"><i class="fas fa-pen mr-3"></i><p class='hide-on-med-and-down'>Posts</p></li></a>
                <a href="#" class=" my-2 passbtn_dashboard"><li class="waves-effect list-block pt-2"><i class="fas fa-user-lock mr-3"></i><p class='hide-on-med-and-down'>Change Password</p></li></a>
                <a class=" my-2 usersbtn_dashboard" href="#!"><li class="waves-effect list-block pt-2"><i class="fas fa-users mr-3"></i><p class='hide-on-med-and-down'>Users</p></li></a>
            </ul> -->
            <!-- <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons small">menu</i></a> -->
        </div>
    </div>   
    <div class="grid-x">  
        <div class="cell large-12 medium-12 small-12 p-5">
            
            <div class="grid-x welcome_dashboard center cayan-text">
                <div class="cell large-12 medium-12 small-12 grid-x  id='reloadContent_dsh'" >
                    <?php
                        
                        $conn4 = db_connect();
                        
                        $sql4 = "SELECT * FROM users WHERE id = 1";

                        $result4 = pg_query($conn4, $sql4);
                        // $records = pg_num_rows($result);

                        if (pg_num_rows($result4) > 0) {
                            // output data of each row
                            while($row = pg_fetch_assoc($result4)) {

                            echo "<form class='row cell medium-4 medium-offset-4 dashboard_welcome_cont'>\n
                                <h1 class='col m12 dosis'>WELCOME ".$row["first_name"] ." ". $row["last_name"]."</h1>\n
                            <h3 class='col m12 dosis red-text'>This is your DASHBOARD !</h3> \n
                            <div class='input-field col m6 toogle_disable'>\n
                                <input disabled type='text' class='validate first_name_dsh' placeholder='First Name' value='".$row["first_name"]."'>\n
                                <label for='username_dashboard'>First Name</label>\n
                            </div>\n
                            <div class='input-field col m6 toogle_disable'>\n
                                <input disabled type='text' class='validate last_name_dsh' placeholder='Last Name' value='".$row["last_name"]."'>\n
                                <label for='username_dashboard'>Last Name</label>\n
                            </div>\n           
                            <div class='input-field col m12 toogle_disable'>\n
                                <input disabled type='text' class='validate user_name_dsh' placeholder='User Name' value='".$row["username"]."'>\n
                                <label for='username_dashboard'>User Name</label>\n
                            </div>\n
                            <div class='input-field col m12 toogle_disable'>\n
                                <input disabled type='tel' class='validate email_dsh'  placeholder='xyz@email.com' value='".$row["email"]."'>\n
                                <label for='email_dashboard'>Email</label>\n
                            </div>\n\n
                        </form>\n";
                            }}
                    ?>
                </div>
                <div class="input-field row cell medium-4 medium-offset-4">
                    <button class="col m5 mx-3 btn btn-submit btn_toogle_disable">CHANGE</button>
                    <button class="col m5 mx-3 btn btn-submit btn_username_save">SAVE</button>
                    <script>
                        $('.btn_username_save').on("click", function () {
                            
                            $first_name_dashboard = $(".first_name_dsh").val();
                            $last_name_dashboard = $(".last_name_dsh").val();
                            $user_name_dashboard = $(".user_name_dsh").val();
                            $email_dashboard = $(".email_dsh").val();

                            if ($first_name_dashboard.length > 0 || 
                                $last_name_dashboard.length > 0 ||
                                $user_name_dashboard.length > 0 ||
                                $email_dashboard.length > 0 ) {
                                $.get("dashboard_user_fetch.php", {
                                    "first_name_dashboard": $first_name_dashboard,
                                    "last_name_dashboard": $last_name_dashboard,
                                    "user_name_dashboard": $user_name_dashboard,
                                    "email_dashboard": $email_dashboard
                                }, function ($data) {
                                    // $(".result").html($data);
                                    console.log($data);
                                    location.reload();
                                    // $(document).load(location.href+" #reloadContent_dsh>*","");
                                })
                            } else if ($first_name_dashboard.length == 0 || 
                                $last_name_dashboard.length == 0 ||
                                $user_name_dashboard.length == 0 ||
                                $email_dashboard.length == 0 ) {
                                $.get("dashboard_user_fetch.php", {
                                    "search": "%"
                                }, function ($data) {
                                    // $(".result").html($data);
                                    console.log($data);
                                })
                            }
                            else {
                                console.log('Dashboard update form JS error !!');
                            }

                        });
                    </script>
                </div>
            </div>        
            <div class="pass_dashboard center dashdoard_container">
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
                            <button class="btn waves-effect waves-light cayan lighten-1" type="submit" name="action">
                                <i class="material-icons right">lock</i> PROCEED
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="users_dashboard center dashdoard_container">
                <h2 class='dosis'><i class="fas fa-user prefix"></i> Users</h2>
                <form>                 
                    <div class="input-field">
                    <input id="icon_prefix" type="text" class="validate users_search">
                    <label for="icon_prefix">Search Any Fields</label>
                    </div>
                </form>
                <div class='users_result'>

                </div>
                <script>
                    $(".users_search").on("input", function () {
                        $search6 = $(".users_search").val();
                        if ($search6.length > 0) {
                            $.get("dashboard_user_results.php", {
                                "search7": $search6
                            }, function ($data) {
                                $(".users_result").html($data);
                            })
                        } else if ($search6.length == 0) {
                            $.get("dashboard_user_results.php", {
                                "search7": "%"
                            }, function ($data) {
                                $(".users_result").html($data);
                            })
                        }
                    });
                </script>
                <!-- <table class="highlight centered responsive-table">
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
                                <td><a class='btn red' href='#'><i class='fas fa-trash'></i></a></td>
                            </tr>
                        </tbody>
                </table> -->
            </div>
            <div class="post_dashboard dashdoard_container">
                <div>
                    <h4 class='dosis center cayan-text text-lighten-1'>LIVE SEARCH</h4>
                    <form>                 
                        <div class="input-field">
                        <i class="fas fa-search-location prefix"></i>
                        <input id="icon_prefix" type="text" class="validate posts_search">
                        <label for="icon_prefix">Search Any Value</label>
                        </div>
                    </form>
                    <div class='result'>

                    </div>
                      
                </div>               
            </div>
        </div>
    </div>
    

<?php
require("./footer.php");
?>