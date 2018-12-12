<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->

<?php

$title = "Listing Update";
$file = "dashboard.php";
$date = "Sept 14 2018";
$banner = "Listing Update";
$desc = "Dashboard Page of QualityLife";
require("./header.php");

if (empty($_SESSION['username_s']) || $_SESSION['user_type_s'] != AGENT){
    $session_message = [];
    $session_message[] = "Unauthorized access blocked.";
    $_SESSION['cookies_message'] = $session_message;   
    header('Location: ./login.php');
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
        
        $current_user_id = $_SESSION['user_id_s'];
        if (isset($_GET['listing_id'])) {
            $display_listing_id = $_GET['listing_id'];
            $_SESSION['update_listing_id'] = $_GET['listing_id'];
            $conn = db_connect();                              
            $sql2 = "SELECT * FROM listings WHERE 
            listings.user_id::VARCHAR = '$current_user_id'
            AND listings.listing_id::VARCHAR = '$display_listing_id'
            ORDER BY listings.created_on DESC";
            $result = pg_query($conn, $sql2);
            
            while($data = pg_fetch_assoc($result))
            {
                $dsh_post_head = $data['headline'];
                $dsh_post_desc = $data['description'];
                $dsh_post_status = $data['status'];
                $dsh_post_images =  $data['images'];
                $dsh_post_city = $data['city'];
                $dsh_post_bedrooms = $data['bedrooms'];
                $dsh_post_bathrooms = $data['bathrooms'];
                $dsh_post_price = $data['price'];
                $dsh_post_area = $data['area'];
                $dsh_post_address = $data['address'];
                $dsh_post_pet_friendly = $data['pets_friendly'];
                $dsh_post_postal_code = $data['postal_code'];
                $dsh_post_contact = $data['contact'];
                $dsh_post_file = $data['images_path'];
                $property_options = $data['property_options'];
            }
        } else {
            $session_message = [];
            $session_message[] = "First select listing.";
            $_SESSION['cookies_message'] = $session_message;   
            header('Location: ./dashboard.php');
            ob_flush();  //Flush output buffer
            // $dsh_post_head = "";
            // $dsh_post_desc = "";
            // $dsh_post_images =  isset($_COOKIE['dsh_post_images'])?$_COOKIE['dsh_post_images']:"2";
            // $dsh_post_city = isset($_COOKIE['dsh_post_city'])?$_COOKIE['dsh_post_city']:"8";
            // $dsh_post_bedrooms =  isset($_COOKIE['dsh_post_bedrooms'])?$_COOKIE['dsh_post_bedrooms']:"3";
            // $dsh_post_bathrooms =  isset($_COOKIE['dsh_post_bathrooms'])?$_COOKIE['dsh_post_bathrooms']:"2";
            // $dsh_post_price = "";
            // $dsh_post_area = "";
            // $dsh_post_address = "";
            // $dsh_post_pet_friendly = isset($_COOKIE['dsh_post_pet_friendly'])?$_COOKIE['dsh_post_pet_friendly']:"2";
            // $dsh_post_postal_code = "";
            // $dsh_post_contact = "";
            // $dsh_post_file = "";
            // $property_options = isset($_COOKIE['property_options'])?$_COOKIE['property_options']:0;  
        }    

    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $current_user_id = $_SESSION['user_id_s'];
        $display_listing_id = $_SESSION['update_listing_id'];
        $dsh_post_head = post('dsh_post_head');
        $dsh_post_status = post('listing_status');
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
        if (isset($_POST['dsh_post_file'])) {
            $dsh_post_file = trim('dsh_post_file');
        }
          
        $property_options = isset($_POST['property_option'])?sum_check_box($_POST['property_option']):0;                  
        
        $conn = db_connect();

        // echo "Sumn of property_options: " . $property_options;
        setcookie('property_options', $property_options, time() + COOKIES_EXP);
        setcookie('dsh_post_images', $dsh_post_images, time() + COOKIES_EXP);
        setcookie('dsh_post_city', $dsh_post_city, time() + COOKIES_EXP);
        setcookie('dsh_post_bedrooms', $dsh_post_bedrooms, time() + COOKIES_EXP);
        setcookie('dsh_post_bathrooms', $dsh_post_bathrooms, time() + COOKIES_EXP);
        setcookie('dsh_post_pet_friendly', $dsh_post_pet_friendly, time() + COOKIES_EXP);

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
            $storage_path = $uploadDirectory . basename($changedName);

            if (!isset($_POST['dsh_post_file']) || $_POST['dsh_post_file'] == "") {
                $storage_path = "./images/no_image.svg";
            } else if (! in_array($fileExtension,$fileExtensions)) {
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

                    // $dsh_post_status = LISTING_STATUS_OPEN;
                    $user_id = $_SESSION['user_id_s'];
                    // $features = json_encode($features);
                    $created_on = date("Y-m-d",time());

                    $sql = "UPDATE listings SET status=\$1 , price=\$2 , headline=\$3 , description=\$4 , postal_code=\$5, 
                    images=\$6, images_path=\$7, city=\$8, property_options=\$9, bedrooms=\$10, bathrooms=\$11, 
                    address=\$12, area=\$13, contact=\$14, pets_friendly=\$15 ,main_image=\$16
                    WHERE listings.user_id::VARCHAR = '$user_id' AND listings.listing_id::VARCHAR = '$display_listing_id' ";
                    echo $sql;
                    $stmt = pg_prepare($conn, 'update_post', $sql);
                    
                 
                    if (false != $stmt) {
                        // $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                        if ($storage_path != "") {
                            $main_image = 0;
                            $result = pg_execute($conn, 'update_post', array($dsh_post_status, $dsh_post_price, $dsh_post_head, $dsh_post_desc, 
                                        $dsh_post_postal_code, $dsh_post_images, $storage_path, $dsh_post_city, $property_options, $dsh_post_bedrooms, $dsh_post_bathrooms, 
                                        $dsh_post_address, $dsh_post_area, $dsh_post_contact, $dsh_post_pet_friendly, $main_image));

                            $session_message[] = "Post updated successfully.";
                            $_SESSION['cookies_message'] = $session_message;
                            user_redirection();                         
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
        <h2 class='cell medium-5 medium-offset-4 center red-text dosis'>Update Post</h2>
        <div class='cell medium-5 medium-offset-4 center p-4'>
            <!-- <input type="submit" class="btn waves-effect waves-light cayan lighten-1" name="submit"> -->
            <a class="btn grey darken-2 waves-effect waves-light z-depth-4 white-text" href="./listing_images.php?listing_id=<?php echo $_GET['listing_id']; ?>">
                <i class="fas fa-image"></i> IMAGES 
            </a>
        </div>
        <form class='cell medium-5 medium-offset-4 center row' action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' enctype="multipart/form-data" >
            <div class="input-field col s12">
                <input type="text" id='heading' name="dsh_post_head" class="validate" value="<?php echo $dsh_post_head; ?>"/>
                <label for="heading">Post Heading</label>
            </div>
            <div class="input-field col s12">
                <textarea id="description" name="dsh_post_description" class="materialize-textarea" ><?php echo $dsh_post_desc; ?></textarea>
                <label for="description">Description</label>
            </div>          
            <div class="input-field col s6">
                <?php build_dropdown("images", "value","images", "Images", "$dsh_post_images"); ?>
            </div>
            <div class="input-field col s6">
                <?php build_dropdown2("city", "property", "value","city", "City", $dsh_post_city); ?>
            </div>
            <div class="input-field col s6">
                <?php build_dropdown2("listing_status", "property", "value","listing_status", "Listing Status", $dsh_post_status); ?>
            </div>
            <div class="input-field col s6">
                <?php build_dropdown("bedrooms", "value","bedrooms", "No of bedrooms", "$dsh_post_bedrooms"); ?>
            </div>
            <div class="input-field col s6">
                <?php build_dropdown("bathrooms", "value","bathrooms", "No of bathrooms", "$dsh_post_bathrooms"); ?>
            </div>                      
            <div class="input-field col s6">
                <input id="area" name="area" type="text" class="validate" value="<?php echo $dsh_post_area; ?>"/>
                <label for="area">Property Area in SQFT</label>
            </div>
            <div class="input-field col s6">
                <input id="postal_code" name="postal_code" type="text" class="validate" value="<?php echo $dsh_post_postal_code; ?>"/>
                <label for="postal_code">Postal Code</label>
            </div>
            <div class="input-field col s12">
                <input type="text" id='address' name="address" class="validate" value="<?php echo $dsh_post_address; ?>"/>
                <label for="address">Address</label>
            </div>
            <div class="input-field col s6">
                <input type="text" id='price' name="dsh_post_price" class="validate" value="<?php echo $dsh_post_price; ?>"/>
                <label for="price">Price</label>
            </div>
            <div class="input-field col s6">
                <input type="text" id='contact' name="dsh_post_contact" class="validate" value="<?php echo $dsh_post_contact; ?>"/>
                <label for="contact">Contact</label>
            </div>
            <div class="file-field input-field col s12">
                <h6  class="grey-text text-lighten-1">Images</h6>
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="dsh_post_file" value="<?php echo $dsh_post_file; ?>"/>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" id="Upload_one_or_more_files" name="dsh_post_file1"/>                               
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field col s12">
                    <h6 class="grey-text text-lighten-1">Pet Friendly</h6>
                    <?php build_radio("pet_friendly", "$dsh_post_pet_friendly"); ?>
                </div>
            </div>
            <div class="row">
                <h6 class="grey-text text-lighten-1">Features</h6>
                <div class="pl-4 ml-4">
                    <?php build_checkbox("property_option", "property", "value" , $property_options); ?>
                </div>
            </div>           
            <div class='input-field col s12 center'>
                <!-- <input type="submit" class="btn waves-effect waves-light cayan lighten-1" name="submit"> -->
                <button class="btn grey darken-2 waves-effect waves-light z-depth-4" name="dsh_post_submit" type="submit">
                    POST <i class="fas fa-check"></i> 
                </button>
            </div>
        </form>                    
    </div>
    


<?php
require("./footer.php");
?>
