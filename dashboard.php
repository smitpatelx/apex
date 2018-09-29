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
            <div class="dashdoard_container scroll_bar_hide">
            <div class="welcome_dashboard center cayan-text dashdoard_container scroll_snap_item" >
                <h1 class='dosis'>WELCOME SMIT</h1>
                <div>
                    <h3 class='dosis red-text'>This is your DASH-board !</h3>
                    <h5 class='dosis'><i class="fas fa-user mr-3"></i>Smit Patel</h5>
                    <h5 class='dosis'><i class="fas fa-at mr-3"></i>admin@netdevv.com</h5>
                </div>
            </div>
            <div class="pass_dashboard center dashdoard_container scroll_snap_item">
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
            <div class="users_dashboard center dashdoard_container scroll_snap_item">
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
            <div class="post_dashboard dashdoard_container scroll_snap_item">
                <div>
                    <h4 class='dosis center cayan-text text-lighten-1'>LIVE SEARCH</h4>
                    <form>                 
                        <div class="input-field col s6">
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