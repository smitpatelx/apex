<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

$title = "Update";
$file = "update.php";
$date = "Oct 30 2018";
$banner = "Update";
$desc = "Dashboard Page of QualityLife";
require("./header.php");

if (empty($_SESSION['username_s'])){
    header('Location: 405.php');
    ob_flush();  //Flush output buffer
}

// print_r( $cookies_message);
?>
<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>

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
                            <h3 class='col m12 dosis red-text'>Update User Info</h3> \n
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
<script type="text/javascript">
            var try_register = setTimeout(try_register, 3000);
            
            function try_register() {
                <?php
                $try_registers = $_SESSION['try_register'];
                // $cookie_message = "<div class='red_alert'>".$cookie_message."</div>";
                echo "M.toast({html: '".$try_registers."', classes:'red'});";
    
                ?>
            };
</script>
<?php
require("./footer.php");
?>