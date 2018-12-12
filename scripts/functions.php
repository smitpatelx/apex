<?php 

// function db_connect() {

// define("DB_SERVER", "127.0.0.1");
// define("DB_USER", "smit");
// define("DB_PASSWORD", "smitpatelx");
// define("DB_DATABASE", "qualitylife_db");

// $connection = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
// return $connection;

// // Check connection
// 	if ($connection->connect_error) 
//         {
//             die("Connection failed: " . $connection->connect_error);
//         }
//         echo "Connected successfully";
// }

function db_connect() //to connect database
{
$connection = pg_connect("host=127.0.0.1 dbname=group19_db user=group19_admin password=apexscdb18" ); 
return $connection; 


	// Check connection
	if ($connection->connect_error) 
	{
	    die("Connection failed: " . $connection->connect_error);
	}
	echo "Connected successfully";
}


function displayCopyrightInfo() //to display copyright information in footer file
{
	$nextWeek = time() + (7 * 24 * 60 * 60);
	echo "<p style='color:white'>&copy;<b> ".date('Y')."</b> SMIT PATEL</p>";
}

function callPost() //to reuse POST request method
{
	return $_SERVER["REQUEST_METHOD"] == "POST";
}

function userLoginForm($login,$password) //to make login form reusable
{
		$output2=""; //to store output result

		$output2.="<p class='paragraph1' style='text-align: center'>Enter your login ID and password to connect to this system</p>";
		$output2.="<div class='login'>";
	  	$output2.="<div class='login-triangle'></div>";
	  	$output2.="<h2 class='login-header'>Please Login</h2>";
	  	$output2.="<form class='login-container' action='". $_SERVER['PHP_SELF']."' method='post' >";
	    $output2.="<p>ID:<input type='text' name='id_value' value='".$login."'/></p>";
	    $output2.="<p>Password:<input type='password' name='pass_value' value='".$password."'/></p>";
	    $output2.="<p><input type='submit' name='submit_btn' value='Log in'/></p>";
	    $output2.="<p><input type='reset' name='reset_btn' value='Reset' /></p>";
		$output2.="</form>";
		$output2.="</div>";

	echo $output2; //to display output
}


	define('MINIMUM_ID_LENGTH', '5' );
	define('MAXIMUM_ID_LENGTH', '20' );
	define('MINIMUM_PASSWORD_LENGTH', '6' );
	define('MAXIMUM_PASSWORD_LENGTH', '15' );
	define('MAX_FIRST_NAME_LENGTH', '20' );
	define('MAX_LAST_NAME_LENGTH', '30' );
	define('MAXIMUM_EMAIL_LENGTH', '255' );

function trimT($anyValue)
{
	return trim($_POST["$anyValue"]);
}

?>