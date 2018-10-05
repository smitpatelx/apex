<?php
/*************
Author: Smit Patel
Deliverable 1 - db.php
October 2, 2018
WEBD3201
**************/

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
$connection = pg_connect("host=127.0.0.1 dbname=group19_db user=group19_admin password=apexscdb18"); 
return $connection; 

}

?>