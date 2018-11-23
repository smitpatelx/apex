<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->

<?php

    require('./includes/functions.php');

    if (empty($_SESSION['username_s']) || (($_SESSION['user_type_s'] != AGENT) && ($_SESSION['user_type_s'] != ADMIN))){
        header('Location: 405.php');  
        ob_flush();  //Flush output buffer
    }

    $errors = []; // Store all foreseen and unforseen errors here

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $dsh_post_head = "";
        $dsh_post_desc = "";
        $dsh_post_images = "";
        $dsh_post_city = "";
        $dsh_post_bedrooms = "";
        $dsh_post_bathrooms = "";
        $dsh_post_price = "";
        $dsh_post_area = "";
        $dsh_post_address = "";
        $dsh_post_pet_friendly = "";
        $dsh_post_postal_code = "";
        $dsh_post_contact = "";
        $dsh_post_file = "";

    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $dsh_post_head = trimT('dsh_post_head');
        $dsh_post_desc = trimT('dsh_post_description');
        $dsh_post_images = trimT('images');
        $dsh_post_city = trimT('city');
        $dsh_post_bedrooms = trimT('bedrooms');
        $dsh_post_bathrooms = trimT('bathrooms');
        $dsh_post_price = trimT('dsh_post_price');
        $dsh_post_area = trimT('area');
        $dsh_post_address = trimT('address');
        $dsh_post_pet_friendly = trimT('pet_friendly');
        $dsh_post_postal_code = trimT('postal_code');
        $dsh_post_contact = trimT('dsh_post_contact');
        $dsh_post_file = trimT('dsh_post_file1');
    
        if(callPost())
        {
            $conn = db_connect();
            
            $currentDir = getcwd();
            $today = "day_".date("m_d_Y");
            $time = "time_".date("g_i_s_a");
            $uploadDirectory = "./images/".$today."/";
        // mkdir("./images/".$today);
        //echo $uploadDirectory."<br/>";

        if (!file_exists($uploadDirectory)) //if file dont exist
        {
            mkdir("./images/".$today);
            $_SERVER['PHP_SELF']; //call file again after creating directory
        }    
            $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

            $fileName = $_FILES['dsh_post_file1']['name'];
            $fileSize = $_FILES['dsh_post_file1']['size'];
            $fileTmpName  = $_FILES['dsh_post_file1']['tmp_name'];
            $fileType = $_FILES['dsh_post_file1']['type'];
            $explode = explode('.',$fileName);
            $end = end($explode);
            $strtolower = strtolower($end);
            $fileExtension = $strtolower;

            $changedName = $time.$fileName;
            $uploadPath = $currentDir . $uploadDirectory . basename($changedName); 

            if (! in_array($fileExtension,$fileExtensions)) {
                $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file.<br/>";
            }

            if ($fileSize > MAX_FILE) {
                $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB.<br/>";
            }

            if(strlen($dsh_post_head) >= MAX_HEADING && strlen($dsh_post_head) <= MIN_HEADING) {
                $errors[] = "Heading should be between 60 to 6 characters";
                $dsh_post_head = "";
            }

            if(strlen($dsh_post_desc) >= MAX_DESC && strlen($dsh_post_desc) <= MIN_DESC) {
                $errors[] = "Description should be between 1000 to 60 characters";
                $dsh_post_desc = "";
            }
            
            if(strlen($dsh_post_address) >= MAX_ADDRESS && strlen($dsh_post_address) <= MIN_ADDRESS) {
                $errors[] = "Address should be between 40 to 6 characters";
                $dsh_post_address = "";
            }

            if(strlen($dsh_post_area) >= MAX_AREA && strlen($dsh_post_area) <= MIN_AREA) {
                $errors[] = "Area should be between 10 to 4 characters";
                $dsh_post_area = "";
            }

            if(strlen($dsh_post_contact) >= MAX_CONTACT && strlen($dsh_post_contact) <= MIN_CONTACT) {
                $errors[] = "Contact should be between 15 to 10 characters";
                $dsh_post_contact = "";
            } else if (valid_phone_number($dsh_post_contact) == false) {
                $errors[] = "Invalid Primary Phone Number."; 
                $dsh_post_contact = "";
            }

            if(strlen($dsh_post_postal_code) != POSTAL_CODE_LENGTH) {
                $errors[] = "Contact should be between 15 to 10 characters";
                $dsh_post_postal_code = "";
            } else if (is_valid_postal_code($dsh_post_postal_code) == false) {
                $errors[] = "This canadian postal code is invalid"; 
                $dsh_post_postal_code = "";
            }
                
            if (empty($errors)) {
                $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                if ($didUpload) {
                    $sql5 = "insert into listing_demo ( list_heading, img, location, price, sqft, phone) 
                    values ( '$dsh_post_head', '".$uploadDirectory."".$changedName."', '$dsh_post_location', '$dsh_post_price', '$dsh_post_area', '$dsh_post_contact')";

                    $result5 = pg_query($conn, $sql5);
                    user_redirection();
                    ob_flush();  //Flush output buffer
                    echo "The file " . basename($fileName) . " has been uploaded";
                    ob_flush();  //Flush output buffer
                } else {
                    echo "<br/>An error occurred somewhere. Try again or contact the admin<br/> Maybe filesize is more than 2 mb.";
                }
            }
        }
    }

    if (!empty($errors))
    {
        echo "<div class='card m-4 p-4'>";
        foreach($errors as $error)
        {
        echo "<p class='red-text'>".$error."</p><br/>";
        }
        echo "</div>";
    }
    
?>