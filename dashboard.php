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
                    <a href="#" class="postbtn_dashboard"><i class="fas fa-pen mr-3"></i>Posts</a>
                </li>
                <li>
                    <a href="./change-password.php" class=""><i class="fas fa-user-lock mr-3"></i>Change Password</a>
                </li>
                <li>
                    <a href="./listing_create.php" class=""><i class="fas fa-plus mr-3"></i>New Post</a>
                </li>
            </ul>
        </div>
    </div>   
    <div class="grid-x">  
        <div class="cell large-12 medium-12 small-12">
            <div class="dashboard_loader">
                <div class="dashboard_loader_1"></div>
            </div>
            
            <div class="grid-x welcome_dashboard center cayan-text">
                    
                        <?php 

                            if ($_SERVER["REQUEST_METHOD"] == "GET") {

                                $results_per_page = 10;
                                $number_of_results = 0;

                                $user_id_from_session = $_SESSION['user_id_s'];
                                $conn = db_connect();
                                
                                $sql = "SELECT * FROM listings WHERE 
                                listings.user_id::VARCHAR = '$user_id_from_session'
                                ORDER BY listings.created_on DESC";

                                $result = pg_query($conn, $sql);

                                $number_of_results = pg_num_rows($result);    

                                // echo $number_of_results;
                                $number_of_pages = ceil($number_of_results/$results_per_page);

                                $current_page_number = isset($_GET['page'])?$_GET['page']:$_GET['page']='1';
                                echo "<div class='cell small-12 grid-x grid-margin-x p-4 m-4'>";
                                echo "<h4 class='cell small-12 center'> Welcome ".$_SESSION['first_name_s']." ".$_SESSION['last_name_s']." !!</h4>";
                                echo "<h5 class='cell small-12'><span class='left'>PAGE ".$current_page_number." </span><span class='red-text h6 right'>Number of results: ".$number_of_results."</span></h5>";
                                for ($page=1;$page<=$number_of_pages; $page++) {
                                    
                                    echo "<div class='cell small-1'>
                                                <a class='btn-small waves-effect  waves-light z-depth-4";
                                    if ($page == $_GET['page']) {
                                        echo " red ";
                                    } else {
                                        echo " blue-grey ";
                                    }
                                    echo "darken-1 white-text' href='./dashboard.php?page=".$page."'>".$page."</a>
                                        </div>";
                                }
                                echo "</div>";

                                if(!isset($_GET['page'])) {
                                    $page = 1;
                                } else {
                                    $page = $_GET['page'];
                                }

                                $this_page_first_result = ($page-1)*$results_per_page;

                                $sql2 = "SELECT * FROM listings WHERE 
                                listings.user_id::VARCHAR = '$user_id_from_session'
                                ORDER BY listings.created_on DESC  LIMIT '$results_per_page' OFFSET '$this_page_first_result'";

                                $result = pg_query($conn, $sql2);

                                echo "<div class='cell small-12 grid-x grid-padding-x p-3' style='justify-content: center;'> ";

                                    echo  "<div class='cell small-12 grid-x blue-grey darken-1 white-text p-3'>";
                                        echo "<div class='cell small-2 center'><b>Heading</b></div>";
                                        echo "<div class='cell small-2 center'><b>Address</b></div>";
                                        echo "<div class='cell small-2 center'><b>Price</b></div>";
                                        echo "<div class='cell small-2 center'><b>Contact</b></div>";
                                        echo "<div class='cell small-2 center'><b>Status</b></div>";
                                        echo "<div class='cell small-2 center'><b>Action</b></div>";
                                    echo"</div>"; 
                                    echo  "<div class='cell small-12 grid-x p-3'></div>";
                                        // <div id='listing-output' class='cell small-12 grid-x grid-margin-x small-up-2 medium-up-2 large-up-4'>
                                    while($row = pg_fetch_assoc($result)){
                                        $image_link = "";
                                        $image_link = $row["images_path"];
                                        if (true == checkRemoteFile($image_link)) {
                                            // $image_link = $row["images_path"];
                                            $image_link = $image_link;
                                        } else {
                                            $image_link = "./images/no_image.svg";
                                        }
                                        echo  "<div class='cell small-12 z-depth-2 hoverable grid-x p-2'>";
                                            // echo  "<div class='card-image col s2 waves-effect waves-block waves-light'>";
                                            // echo  "<img class='activator' src='".$image_link."' alt='img_".$row["listing_id"]."' />";
                                            // echo  "</div>";
                                            echo "<div class='cell small-2'>".$row["headline"]."</div>";
                                            echo "<div class='cell small-2'>".$row["address"]."</div>";
                                            echo "<div class='cell small-2'>".$row["price"]."</div>";
                                            echo "<div class='cell small-2'>".$row["contact"]."</div>";
                                            echo "<div class='cell small-2'>".listing_status_symbol($row["status"])."</div>";
                                            //<a class='btn red' href='./".$row["user_id"]."'><i class='fas fa-trash'></i></a>
                                            echo "<div class='cell small-2'><a class='btn teal lighten-1 mx-1' href='./listing_update.php?listing_id=".$row["listing_id"]."'><i class='fas fa-pen-square'></i></a></div>";
                                        echo"</div>";     
                                    }
                                echo " </div>";

                                echo "<div class='cell small-12 grid-x grid-margin-x p-4 m-4'>";
                                for ($page=1;$page<=$number_of_pages; $page++) {
                                    
                                    echo "<div class='cell small-1'>
                                                <a class='btn-small waves-effect  waves-light z-depth-4";
                                    if ($page == $_GET['page']) {
                                        echo " red ";
                                    } else {
                                        echo " blue-grey ";
                                    }
                                    echo "darken-1 white-text' href='./dashboard.php?page=".$page."'>".$page."</a>
                                        </div>";           
                                }
                                echo "<br/><br/><h5 class='cell small-12 '><span class='left'>PAGE ".$current_page_number." </span><span class='red-text h6 right'>Number of results: ".$number_of_results."</span></h5>";
                                echo "</div>";
                            }
                        ?>
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