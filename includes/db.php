<?php


define("DB_HOST", "127.0.0.1");
define("DB_NAME","group19_db");
define("DB_PORT", "5432");
define("DB_PASSWORD", "apexscdb18");
define("DB_USER", "group19_admin");



function db_connect() //to connect database
{
$connection = pg_connect(DB_HOST, DB_NAME, DB_PORT, DB_PASSWORD, DB_USER);
return $connection;

}

?>
