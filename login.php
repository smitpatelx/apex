<?php
/*************
FILE: 						login.php
TITLE:						Apex Listings - User Login Page
AUTHORS:					Blake Phillips, Clayton Galliah-Penhale, Dylan Lopez, Smit Patel
LAST MODIFIED BY: Dylan Lopez
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
**************/

$title = "Login";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Login";
$desc = "Dashboard Page of QualityLife";

require('header.php');
?>

<script>     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>
<?php
  
  if ($_SERVER["REQUEST_METHOD"] == "GET")
  {
    $loginid = "";
    $password= "";
  }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      if (isset($_POST['id']) && isset($_POST['password']))
      {
        $loginid = trim($_POST['id']);
        $password = md5(trim($_POST['password']));
        $last_access = date("Y-m-d",time());

        $dbconn = db_connect();
        // echo $password;

        // Preparing query for execution
        $stmt1 = pg_prepare($dbconn, 'update_last_query', "UPDATE users
                                                SET last_access = '".$last_access."'
                                                WHERE users.user_name = \$1 AND users.password = \$2");
  
        // Execute the prepared query
      $result1 = pg_execute($dbconn, 'update_last_query', array($loginid,$password));
  
      // pg_query($dbconn, $result1);
  
      // Deciding which landing page to be redirected to
          $stmt2 = pg_prepare($dbconn, 'select_user_type_query', "SELECT user_type, user_name 
                                                                FROM users
                                                                WHERE users.user_name = \$1 AND users.password = \$2");
  
          $result2 = pg_execute($dbconn, 'select_user_type_query', array($loginid, $password));
  
          $currentUserType = pg_fetch_array($result2);
          $_SESSION['user_type_s'] = $currentUserType['user_type'];
          $_SESSION['username_s'] = $currentUserType['user_name'];

              if ($_SESSION['user_type_s'] == "s"){
                header("LOCATION: ./admin.php");
             }
             if ($_SESSION['user_type_s'] == "a"){
                header("LOCATION: ./dashboard.php");
             }
             if ($_SESSION['user_type_s'] == "s"){
                header("LOCATION: ./admin.php");
              }
              if ($_SESSION['user_type_s'] == "c"){
                header("LOCATION: ./welcome.php");
             }




      }
    }




  





?>



<div class="grid-x center my-4 ml-4">

      <div id="sign-in" class="col s12 cell large-8 large-offset-2">
        <div class="cell large-4 large-offset-4 row">
        <form class="col s12" method = "post" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="on">
          <div class="row">
            <div class="input-field col s12">
              <input id="id" name="id"  type="text" class="validate">
              <label for="id">User ID</label>
            </div>
          </div>

        <div class="row">
            <div class="input-field col s12">
              <input id="password" name="password" type="password" class="validate">
              <label for="password">Password</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light blue lighten-1" type="submit" name="action">Sign In
                    <i class="material-icons right">lock</i>
                </button>
                <a class="btn waves-effect waves-light blue lighten-1" href="./register.php">Register
                    <i class="fas fa-user-plus ml-1"></i>
                </a>
            </div>
        </div>

        </form>
      </div>
      </div>


</div>

<?php
require("./footer.php");
?>
