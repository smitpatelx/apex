<!--
FILE: 						<?php echo  basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php

	//Form
	define('MAX_USERNAME_LENGTH', '20' );
	define('MIN_USERNAME_LENGTH', '6' );

	define('MAX_PASSWORD_LENGTH', '8' );
	define('MIN_PASSWORD_LENGTH', '16' );

	define('MAX_FIRST_NAME_LENGTH', '20' );
	define('MIN_FIRST_NAME_LENGTH', '3' );

	define('MAX_LAST_NAME_LENGTH', '30' );
	define('MIN_LAST_NAME_LENGTH', '3' );

  	define('MAX_EMAIL_LENGTH', '30' );
	define('MIN_EMAIL_LENGTH', '5' );
	  
  	define('MAX_ADDRESS_LENGTH', '30' );
	define('MIN_ADDRESS_LENGTH', '6' );
	  
	define('POSTAL_CODE_LENGTH', '6' );
	  
	define('MAX_PHONE_LENGTH', '15' );
	define('MIN_PHONE_LENGTH', '10' );
	  
  	define('MAX_CITY_LENGTH', '17' );
	define('MIN_CITY_LENGTH', '3' );

	define('MAX_FAX_LENGTH', '15' );
	define('MIN_FAX_LENGTH', '6' );

	define('MAX_AREA_CODE', '999' );
	define('MIN_AREA_CODE', '200' );

	define('MAX_DIAL_SEQUENCE', '9999' );
	define('MIN_DIAL_SEQUENCE', '0000' );
	//form constants @ends

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

	define("EMAIL", "");
	define("PHONE", "");
	define("POSTED_EMAIL", "");

	define("LISTING_STATUS_OPEN", "status_open");
	define("LISTING_STATUS_CLOSE", "status_close");
	define("LISTING_STATUS_SOLD", "status_sold");

?>
