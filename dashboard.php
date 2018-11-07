<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

$title = "Dashboard";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Dashboard";
$desc = "Dashboard Page of QualityLife";
require("./header.php");

if (empty($_SESSION['username_s']) || $_SESSION['user_type_s'] != AGENT){
    header('Location: 405.php');
    ob_flush();  //Flush output buffer
}

?>
    <script type="text/javascript">       
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
    <div class="row">       
        <div class="col l12 m12 s12 center pr-3 dashboard_panel">
            <ul class="">
                <li>
                    <a href="#" class='welcomebtn_dashboard img_c_1'><img class="" src="./assets/list-images/profile.jpg" alt="profile" /></a>
                </li>
                <li>
                    <a href="#" class="postbtn_dashboard"><i class="fas fa-pen mr-3"></i>Posts</a>
                </li>
                <li>
                    <a href="#" class="passbtn_dashboard"><i class="fas fa-user-lock mr-3"></i>Change Password</a>
                </li>
                <li>
                    <a href="#" class="newpostbtn_dashboard"><i class="fas fa-plus mr-3"></i>New Post</a>
                </li>
            </ul>
        </div>
    </div>   
    <div class="grid-x">  
        <div class="cell large-12 medium-12 small-12 p-5">
            <div class="dashboard_loader">
                <div class="dashboard_loader_1"></div>
            </div>
            
            <div class="grid-x welcome_dashboard center cayan-text">
                <div class="cell large-12 medium-12 small-12 grid-x" >
                    <?php
                        
                        $conn3 = db_connect();
                        
                        $query_dash_user = "SELECT * FROM users WHERE users.user_name = '".$_SESSION['username_s']."'";

                        $result4 = pg_query($conn3, $query_dash_user);
                        // $records = pg_num_rows($result);
                        // error_log(implode(pg_fetch_assoc($result4)));
                        if (pg_num_rows($result4) > 0) {
                            // output data of each row
                            while($row4 = pg_fetch_assoc($result4)) {

                            echo "<form class='row cell medium-4 medium-offset-4 dashboard_welcome_cont' action='javascript:void(0);'>\n
                                <h1 class='col m12 dosis'>WELCOME ".$row4["first_name"] ." ". $row4["last_name"]."</h1>\n
                            <h3 class='col m12 dosis red-text'>This is your DASHBOARD !</h3> \n
                            <div class='input-field col m6 toogle_disable'>\n
                                <input disabled type='text' id='first_name' class='validate first_name_dsh' value='".$row4["first_name"]."'/>\n
                                <label for='first_name'>First Name</label>\n
                            </div>\n
                            <div class='input-field col m6 toogle_disable'>\n
                                <input disabled type='text' id='last_name' class='validate last_name_dsh' value='".$row4["last_name"]."'/>\n
                                <label for='last_name'>Last Name</label>\n
                            </div>\n           
                            <div class='input-field col m12 toogle_disable'>\n
                                <input disabled type='text' id='user_name' class='validate user_name_dsh' value='".$row4["user_name"]."'/>\n
                                <label for='user_name'>User Name</label>\n
                            </div>\n
                            <div class='input-field col m12 toogle_disable'>\n
                                <input disabled type='text' id='email_dashboard' class='validate email_dsh'  value='".$row4["email_address"]."'/>\n
                                <label for='email_dashboard'>Email</label>\n
                            </div>\n\n
                        </form>\n";
                            }}
                    ?>
                </div>
                <div class="input-field row cell medium-4 medium-offset-4">
                    <button class="col m5 mx-3 btn btn-submit btn_toogle_disable">CHANGE</button>
                    <button class="col m5 mx-3 btn btn-submit btn_username_save">SAVE</button>
                    <script type="text/javascript">
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
                                    "first_name_dashboard": "%",
                                    "last_name_dashboard": "%",
                                    "user_name_dashboard": "%",
                                    "email_dashboard": "%"
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
                <div class='grid-x center'>
                    <form class='cell medium-5 medium-offset-4 center row' action='dashboard.php'>
                        <h2 class='col s12 m12 l12 center red-text dosis'>Change Password</h2>
                        <div class="input-field col s12 m12 l12 center">
                            <input name="current_password" id="current_password" type="password" class="validate"/>
                            <label for="current_password">Current Password</label>
                        </div>
                        <div class="input-field col s12 m12 l12 center">
                            <input name="new_password" id="new_password" type="password" class="validate"/>
                            <label for="new_password">New Password</label>
                        </div>
                        <div class="input-field col s12 m12 l12 center">
                            <input name="conform_password" id="conform_password" type="password" class="validate"/>
                            <label for="conform_password">Confirm Password</label>
                        </div>
                        <div class='input-field col s12 m12 l12 center'>
                            <button class="btn waves-effect waves-light cayan lighten-1" type="submit" name="action">
                                <i class="fas fa-lock"></i> PROCEED
                            </button>
                        </div>
                    </form>
                </div>
            </div>
                  
            <div class=" create_post_dashboard center dashdoard_container">
                <div class='grid-x'>
                    <h2 class='cell medium-5 medium-offset-4 center red-text dosis'>Create New Post</h2>
                    <form class='cell medium-5 medium-offset-4 center row' action="dashboard_post_save.php" method='post' enctype="multipart/form-data" >
                        <div class="input-field col s12">
                            <input type="text" id='heading' name="dsh_post_head" class="validate"/>
                            <label for="heading">Post Heading</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id='location' name="dsh_post_location" class="validate"/>
                            <label for="location">Location</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id='price' name="dsh_post_price" class="validate"/>
                            <label for="price">Price</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id='total_area' name="dsh_post_area" class="validate"/>
                            <label for="total_area">Total Area</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id='contact' name="dsh_post_contact" class="validate"/>
                            <label for="contact">Contact</label>
                        </div>
                        <h5 class="m-2">Upload one or more files</h5>
                        <div class="file-field input-field col s12">
                            <div class="btn">
                                <span>File</span>
                                <input type="file" name="dsh_post_file1"/>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" id="Upload_one_or_more_files" name="dsh_post_file1"/>                               
                            </div>
                        </div>
                        <div class='input-field col s12 center'>
                            <!-- <input type="submit" class="btn waves-effect waves-light cayan lighten-1" name="submit"> -->
                            <button class="btn waves-effect waves-light cayan lighten-1" name="dsh_post_submit" type="submit">
                                <i class="fas fa-check right"></i> POST
                            </button>
                        </div>
                    </form>                    
                </div>
                
            </div>
            <div class="users_dashboard center dashdoard_container">
                <h2 class='dosis'><i class="fas fa-user prefix"></i> Users</h2>
                <form action="javascript:void(0);">                 
                    <div class="input-field">
                        <i class="fab fa-searchengin fa-2x prefix" style="left:0;"></i>
                        <input type="text" class="validate users_search" id="Search_Any_Fields"/>
                        <label for="Search_Any_Fields">Search Any Fields</label>
                    </div>
                </form>
                <div class='users_result'>

                </div>
                <script type="text/javascript">
                    $(".users_search").on("input", function () {
                        var search = $(".users_search").val();
                        if (search.length > 0) {
                            $.get("dashboard_user_results.php", {
                                "search7": search
                            }, function ($data) {
                                $(".users_result").html($data);
                            })
                        } else if (search.length == 0) {
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
                    <form  action="javascript:void(0);">                 
                        <div class="input-field">
                            <i class="fab fa-searchengin fa-2x prefix" style="left:0;"></i>
                            <input type="text" class="validate posts_search" id="Search_Any_Value" />
                            <label for="Search_Any_Value">Search Any Value</label>
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