<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

$title = "Admin";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Admin";
$desc = "Dashboard Page of QualityLife";
require("./header.php");

if (empty($_SESSION['username_s']) || $_SESSION['user_type_s'] != ADMIN){
    header('Location: ./405.php');
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
                    <a href="#" class="postbtn_dashboard"><i class="fas fa-pen mr-3"></i>Offensive</a>
                </li>
                <li>
                    <a href="./change-password.php" class=""><i class="fas fa-user-lock mr-3"></i>Change Password</a>
                </li>
                
                <li>
                    <a href="#" class="usersbtn_dashboard"><i class="fas fa-users mr-3"></i>Users</a>
                </li>
                <li>
                    <a href="./listing_create.php" class=""><i class="fas fa-plus mr-3"></i>New Post</a>
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
                <div class="cell small-12" >
                    <div>
                        <h4 class='dosis center cayan-text text-lighten-1'>Agents</h4>
                        <form  action="javascript:void(0);" class='row'>                 
                            <div class="input-field col s8">
                                <i class="fab fa-searchengin fa-2x prefix" style="left:0;"></i>
                                <input type="text" class="validate agent_search" id="Search_Any_Value" />
                                <label for="Search_Any_Value">Search Any Value</label>
                            </div>
                            
                            <div class="input-field col s4">
                                <select name="status" class='agent_status'>
                                <!-- <option value="" disabled selected>Agent Type</option> -->
                                    <option value="p" selected>PENDING</option>
                                    <option value="a">REGULAR</option>
                                    <option value="d">DISABLED</option>
                                    <option value="c">CLIENT</option>
                                </select>
                                <label>Agent Type</label>
                            </div>
                        </form>
                        <div class='agent_result'>

                        </div>
                        
                    </div>     
                </div>           
            </div>
            <div class="pass_dashboard center dashdoard_container">
                
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
            </div>
            <div class="post_dashboard dashdoard_container">
                <h4 class='dosis center red-text'><i class="fas fa-pen prefix"></i> Offensive Posts</h4>
                <form action="javascript:void(0);">                 
                    <div class="input-field">
                        <i class="fab fa-searchengin fa-2x prefix" style="left:0;"></i>
                        <input type="text" class="validate admin_offensive_post_search" id="Search_Any_Fields" value=" "/>
                        <label for="Search_Any_Fields">Search Any Fields</label>
                    </div>
                </form>
                <div class='admin_offensive_post_result'>

                </div>
                <script type="text/javascript">
                    $(".postbtn_dashboard").on("click", function() {
                        $.get("offensive_post_result.php", {
                            "search": "%"
                        }, function ($data) {
                            $(".admin_offensive_post_result").html($data);
                        })
                    });
                    $(".admin_offensive_post_search").on("input", function () {
                        var search = $(".admin_offensive_post_search").val();
                        if (search.length > 0) {
                            $.get("offensive_post_result.php", {
                                "search": search
                            }, function ($data) {
                                $(".admin_offensive_post_result").html($data);
                            })
                        } else if (search.length == 0) {
                            $.get("offensive_post_result.php", {
                                "search": "%"
                            }, function ($data) {
                                $(".admin_offensive_post_result").html($data);
                            })
                        }
                    });
                </script>             
            </div>
        </div>
    </div>

<?php
require("./footer.php");
?>