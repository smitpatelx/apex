<!--
FILE: 						<?php echo  basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

	//Form
	define('MINIMUM_ID_LENGTH', '5' );
	define('MAXIMUM_ID_LENGTH', '20' );
	define('MINIMUM_PASSWORD_LENGTH', '6' );
	define('MAXIMUM_PASSWORD_LENGTH', '15' );
	define('MAX_FIRST_NAME_LENGTH', '20' );
	define('MAX_LAST_NAME_LENGTH', '30' );
  	define('MAXIMUM_EMAIL_LENGTH', '255' );

	// User Type Constants
	define('ADMIN', 's');
	define('AGENT', 'a');
	define('CLIENT', 'c');
	define('PENDING', 'p');
	define('DISABLED', 'd');

	//Database Constants
	define("DB_HOST", "127.0.0.1");
	define("DB_NAME","group19_db");
	define("DB_PASSWORD", "apexscdb18");
	define("DB_USER", "group19_admin");

	//MD5
	define("MD5", "md5");

?>
