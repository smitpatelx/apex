
<?php 
/*************
Author: Smit Patel
Deliverable 1 - functions.php
October 2, 2018
WEBD3201
**************/

date_default_timezone_set('America/Toronto');

require('db.php');
require('constants.php');

function displayCopyrightInfo() //to display copyright information in footer file
{
	$nextWeek = time() + (7 * 24 * 60 * 60);
	echo "<p style='color:white'>&copy;<b> ".date('Y')."</b> SMIT PATEL</p>";
}

function callPost() //to reuse POST request method
{
	return $_SERVER["REQUEST_METHOD"] == "POST";
}


function trimT($anyValue)
{
	return trim($_POST["$anyValue"]);
}


if(isset($_GET['sql'])){
    $sql = $_GET['sql'];
    $conn = db_connect();
    $result = pg_query($conn, $sql);
    $arr = pg_fetch_all($result);
    
    echo json_encode($arr);
}

?>