<?php


define("DB_HOST", "127.0.0.1");
define("DB_NAME","group19_db");
define("DB_PASSWORD", "apexscdb18");
define("DB_USER", "group19_admin");

function db_connect() //to connect database
{

    $connection = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASSWORD.""); 
    return $connection; 

}

?>
