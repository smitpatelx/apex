<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->
<?php 

date_default_timezone_set('America/Toronto');

function displayCopyrightInfo() //to display copyright information in footer file
{
    $output = "";
    $output .=  "<a class='cell large-2 medium-2 small-2 large-offset-5 medium-offset-5 small-offset-5 waves-effect waves-light btn-flat z-depth-5 transition-1 primary cayan-text text-lighten-4 modal-trigger center-align shift-right' href='#modal1'>&copy; Copyright</a>";

    $output .=  "<div id='modal1' class='modal modal-fixed-footer'>
            <div class='row modal-content black-text'>
            <h4 class='col l12 black-text'>&copy; Copyright Info</h4>
            <h5 class='col l12 black-text left-align'>This website must not use for personal or commercial purpose without permission. We believe in strict copyright rules.       
                This project is created as per the requirements mentioned in
                <a href='http://opentech2.durhamcollege.org/pufferd/webd3201/'>Course WEBD3201</a>
            </h5>
            <h5 class='col l6 offset-l3' style='margin-top:200px;'>
                All rights reserved # GROUP-19
            </h5>
            </div>
            <div class='modal-footer row'>
            <a href='#!' class='col l2 offset-l6 right modal-close waves-effect waves-green btn'>Agree</a>
            <a href='404.php' class='col l2 offset-l6 left modal-close waves-effect waves-green btn'>Disagree</a>
            </div>
        </div>";
    echo $output;
}

function callPost() //to reuse POST request method
{
	return $_SERVER["REQUEST_METHOD"] == "POST";
}


function trimT($anyValue)
{
	return trim($_POST["$anyValue"]);
}

function hashmd5($value)
{
    return hash(MD5, $value);
}

function dhashmd5($value)
{
    return hash($value, MD5);
}

function display_phone_number($phonenumber)
{
        // Allow only Digits, remove all other characters.
    $phonenumber = preg_replace("/[^\d]/","",$phonenumber);
    
    // get phonenumber length.
    $length = strlen($phonenumber);
    
    // if phonenumber = 10
    if($length == 10) {
        $phonenumber = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "($1)$2-$3", $phonenumber);
    }
    else if($length > 10) {
        $extra = "";
        $extra = $length - 10;
        $nonextra = substr($phonenumber, 0, 10);
        $phonenumber = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "($1)$2-$3", $nonextra)." ext.".substr($phonenumber, -$extra);
    }

    return $phonenumber;
}

function is_valid_postal_code($value)
{
    //to remove all whitespace in between
    $trimvalue = preg_replace('/\s+/', '', $value);

    //to determine valid canada postal code. validation information from https://en.wikipedia.org/wiki/Postal_codes_in_Canada
    if(preg_match("/^([a-ceghj-npr-tv-z]){1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}$/i", $trimvalue))
    { 
        //postal code is valid
        return true;
    }
    else {
        //postal code is in-valid
        return false;
    }
}

function valid_phone_number($phonenumber) {

    $phonenumber = preg_replace("/[^\d]/","",$phonenumber);

    $areacode = substr($phonenumber, 0, 3);
    $exchange = substr($phonenumber, 3, 3);
    $dial_sequence = substr($phonenumber, 6, 4);
    
    if ( ($areacode < MAX_AREA_CODE && $areacode > MIN_AREA_CODE) 
    && ($exchange < MAX_AREA_CODE && $exchange > MIN_AREA_CODE)
    && ($dial_sequence < MAX_DIAL_SEQUENCE && $dial_sequence > MIN_DIAL_SEQUENCE)) {
        //echo "true => ".$phonenumber." => ".$areacode." => ".$exchange." => ".$dial_sequence;
        return true;
    } else {
        //echo "false";
        return false;
    }
}

?>