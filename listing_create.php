<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->

<?php

$title = "Listing Create";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Listing Create";
$desc = "Dashboard Page of QualityLife";
require('header.php');

if (!isset($_SESSION['username_s']) || $_SESSION['user_type_s'] != AGENT){
    header('Location: login.php');
    ob_flush();  //Flush output buffer
}
?>

<script type="text/javascript">     
    $(window).on('load', function () {
        $('.preloader-background').hide();
    });      
</script>

<?php
    $session_message = [];
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
        $features = [];
        $ac = "";   
        $garage = "";    
        $pool = "";    
        $acreage = "";    
        $waterfront = "";
        

    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $dsh_post_head = post('dsh_post_head');
        $dsh_post_desc = post('dsh_post_description');
        $dsh_post_images = trimT('images');
        $dsh_post_city = post('city');
        $dsh_post_bedrooms = trimT('bedrooms');
        $dsh_post_bathrooms = trimT('bathrooms');
        $dsh_post_price = trimT('dsh_post_price');
        $dsh_post_area = trimT('area');
        $dsh_post_address = post('address');
        $dsh_post_pet_friendly = trimT('pet_friendly');
        $dsh_post_postal_code = trimT('postal_code');
        $dsh_post_contact = trimT('dsh_post_contact');
        $dsh_post_file = trim('dsh_post_file');                    
        
        $conn = db_connect();
        
        if(isset($_POST['ac'])){
            $ac = post('ac'); 
            $features[] = $ac;
        }
        if(isset($_POST['garage'])){
            $garage = post('garage');
            $features[] = $garage;
        }
        if(isset($_POST['pool'])){
            $pool = post('pool');
            $features[] = $pool;
        }
        if(isset($_POST['acreage'])){
            $acreage = post('acreage');
            $features[] = $acreage;
        }
        if(isset($_POST['waterfront'])){
            $waterfront = post('waterfront');
            $features[] = $waterfront;
        }

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

            $fileName = $_FILES['dsh_post_file']['name'];
            $fileSize = $_FILES['dsh_post_file']['size'];
            $fileTmpName  = $_FILES['dsh_post_file']['tmp_name'];
            $fileType = $_FILES['dsh_post_file']['type'];
            $explode = explode('.',$fileName);
            $end = end($explode);
            $strtolower = strtolower($end);
            $fileExtension = $strtolower;

            $changedName = $time.$fileName;
            $uploadPath = $currentDir . $uploadDirectory . basename($changedName); 

            if (! in_array($fileExtension,$fileExtensions)) {
                $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file.";
            }

            if ($fileSize > MAX_FILE) {
                $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB.";
            }

            if (!isset($dsh_post_head) || $dsh_post_head == "") {
                $errors[] = "Heading field is empty";
                $dsh_post_head = "";
            } else if(strlen($dsh_post_head) >= MAX_HEADING && strlen($dsh_post_head) <= MIN_HEADING) {
                $errors[] = "Heading should be between 60 to 6 characters";
                $dsh_post_head = "";
            }

            if (!isset($dsh_post_desc) || $dsh_post_desc == "") {
                $errors[] = "Description field is empty";
                $dsh_post_desc = "";
            } else if(strlen($dsh_post_desc) >= MAX_DESC && strlen($dsh_post_desc) <= MIN_DESC) {
                $errors[] = "Description should be between 1000 to 60 characters";
                $dsh_post_desc = "";
            }
            
            if (!isset($dsh_post_address) || $dsh_post_address == "") {
                $errors[] = "Address field is empty";
                $dsh_post_address = "";
            } else if(strlen($dsh_post_address) >= MAX_ADDRESS && strlen($dsh_post_address) <= MIN_ADDRESS) {
                $errors[] = "Address should be between 40 to 6 characters";
                $dsh_post_address = "";
            }

            if (!isset($dsh_post_area) || $dsh_post_area == "") {
                $errors[] = "Area field is empty";
                $dsh_post_area = "";
            } else if(strlen($dsh_post_area) >= MAX_AREA && strlen($dsh_post_area) <= MIN_AREA) {
                $errors[] = "Area should be between 10 to 4 characters";
                $dsh_post_area = "";
            }

            if (!isset($dsh_post_contact) || $dsh_post_contact == "") {
                $errors[] = "Contact field is empty";
                $dsh_post_contact = "";
            } else if(strlen($dsh_post_contact) >= MAX_CONTACT && strlen($dsh_post_contact) <= MIN_CONTACT) {
                $errors[] = "Contact should be between 15 to 10 characters";
                $dsh_post_contact = "";
            } else if (valid_phone_number($dsh_post_contact) == false) {
                $errors[] = "Invalid Primary Phone Number."; 
                $dsh_post_contact = "";
            }

            if (!isset($dsh_post_postal_code) || $dsh_post_postal_code == "") {
                $errors[] = "Postal code field is empty";
                $dsh_post_postal_code = "";
            } else if(strlen($dsh_post_postal_code) != POSTAL_CODE_LENGTH) {
                $errors[] = "Postal code should be 6 characters";
                $dsh_post_postal_code = "";
            } else if (is_valid_postal_code($dsh_post_postal_code) == false) {
                $errors[] = "This canadian postal code is invalid"; 
                $dsh_post_postal_code = "";
            }
                
            if (empty($errors)) {          

                    $dsh_post_status = LISTING_STATUS_OPEN;
                    $user_id = $_SESSION['user_id_s'];
                    $features = json_encode($features);

                    $sql = "INSERT INTO listings ( status, price, headline, description, postal_code, images, images_path, city, property_options, bedrooms, bathrooms, address, area, contact, pets_friendly, user_id) 
                    VALUES ( \$1, \$2, \$3, \$4, \$5, \$6, \$7, \$8, \$9, \$10, \$11, \$12, \$13, \$14, \$15 ,\$16)";

                    $stmt = pg_prepare($conn, 'create_post', $sql);
                    $result = pg_execute($conn, 'create_post', array($dsh_post_status, $dsh_post_price, $dsh_post_head, $dsh_post_desc, 
                                        $dsh_post_postal_code, $dsh_post_images, $changedName, $dsh_post_city, $features, $dsh_post_bedrooms, $dsh_post_bathrooms, 
                                        $dsh_post_address, $dsh_post_area, $dsh_post_contact, $dsh_post_pet_friendly, $user_id));

                    if (false != $result) {
                        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                        if ($didUpload) {
                            $session_message[] = "Post created successfully.";
                            $_SESSION['cookies_message'] = $session_message;
                            user_redirection();
                            ob_flush();  //Flush output buffer                           
                        } else {
                            $error[] = "Image upload unsuccessful. Maybe filesize is more than 2 mb.";
                        }
                    }
                                   
            } else {
                $errors[] =  "An error occurred somewhere. Try again or contact the admin.";
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
    <div class='grid-x py-4'>
        <h2 class='cell medium-5 medium-offset-4 center red-text dosis'>Create New Post</h2>
        <form class='cell medium-5 medium-offset-4 center row' action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' enctype="multipart/form-data" >
            <div class="input-field col s12">
                <input type="text" id='heading' name="dsh_post_head" class="validate"/>
                <label for="heading">Post Heading</label>
            </div>
            <div class="input-field col s12">
                <textarea id="description" name="dsh_post_description" class="materialize-textarea"></textarea>
                <label for="description">Description</label>
            </div>          
            <div class="input-field col s6">
                <?php build_dropdown("images", "value","images", "Images", "2"); ?>
            </div>
            <div class="input-field col s6">
                <?php build_dropdown2("city", "property", "value","city", "City", "oshawa"); ?>
            </div>
            <div class="input-field col s6">
                <?php build_dropdown("bedrooms", "value","bedrooms", "No of bedrooms", "3"); ?>
            </div>
            <div class="input-field col s6">
                <?php build_dropdown("bathrooms", "value","bathrooms", "No of bathrooms", "2"); ?>
            </div>                      
            <div class="input-field col s6">
                <input id="area" name="area" type="text" class="validate" />
                <label for="area">Property Area</label>
            </div>
            <div class="input-field col s6">
                <input id="postal_code" name="postal_code" type="text" class="validate" />
                <label for="postal_code">Postal Code</label>
            </div>
            <div class="input-field col s12">
                <input type="text" id='address' name="address" class="validate"/>
                <label for="address">Address</label>
            </div>
            <div class="input-field col s6">
                <input type="text" id='price' name="dsh_post_price" class="validate"/>
                <label for="price">Price</label>
            </div>
            <div class="input-field col s6">
                <input type="text" id='contact' name="dsh_post_contact" class="validate"/>
                <label for="contact">Contact</label>
            </div>
            <div class="file-field input-field col s12">
                <h6  class="grey-text text-lighten-1">Images</h6>
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="dsh_post_file"/>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" id="Upload_one_or_more_files" name="dsh_post_file1"/>                               
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field col s12">
                    <h6 class="grey-text text-lighten-1">Pet Friendly</h6>
                    <?php build_radio("pet_friendly", "no"); ?>
                </div>
            </div>
            <div class="row">
                <h6 class="grey-text text-lighten-1">Features</h6>
                <div class="pl-4 ml-4">
                    <?php build_checkbox("property_option", "property" , "AC"); ?>
                </div>
            </div>           
            <div class='input-field col s12 center'>
                <!-- <input type="submit" class="btn waves-effect waves-light cayan lighten-1" name="submit"> -->
                <button class="btn waves-effect waves-light cayan lighten-1" name="dsh_post_submit" type="submit">
                    POST <i class="fas fa-check"></i> 
                </button>
            </div>
        </form>                    
    </div>

<?php
require("./footer.php");
?>
