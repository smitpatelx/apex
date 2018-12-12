<!--
FILE: 						<?php echo basename(__FILE__, $_SERVER['PHP_SELF'])."\n"; ?>
TITLE:						Apex Listings - User Login Page
AUTHORS:					Smit Patel
LAST MODIFIED:		October 4, 2018
DESCRIPTION:			Allows users to login to their profiles or allows new users to create an account
-->

<?php

$title = "Image Upload";
$file = "listing_images.php";
$date = "Sept 14 2018";
$banner = "Image Upload";
$desc = "Dashboard Page of QualityLife";
require("./header.php");

if (empty($_SESSION['username_s'])){
    $session_message = [];
    $session_message[] = "Unauthorized access blocked.";
    $_SESSION['cookies_message'] = $session_message;   
    header('Location: ./login.php');
    ob_flush();  //Flush output buffer
} else if ( $_SESSION['user_type_s'] == CLIENT) {
    header('Location: ./welcome.php');
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
    $user_id = $_SESSION['user_id_s'];

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        

        if(isset($_GET["listing_id"])) {
            $listing_id = $_GET["listing_id"];
            $_SESSION['listing_id'] = $listing_id;
            
            $conn = db_connect();
            $sql = "SELECT * FROM listings WHERE listing_id=$listing_id AND user_id='$user_id'";
            $query = pg_query($conn, $sql);

            if (pg_num_rows($query) > 0) {
                $row = pg_fetch_assoc($query);

                $main_image =  !empty($row['main_image'])?$row['main_image']:0;

                echo "<h2 class=' center red-text dosis'>Images Upload</h2>";
                echo "<div class='slides slides_image_upload' style='margin-bottom: 70px;'>";
                $json_decode = json_decode($row['images_path']);
                if (!empty($json_decode)) {
                    for ( $i=0 ; $i < count($json_decode) ; $i++){         
                        echo "<img src='".$json_decode[$i]."' alt='bg' />";           
                    }
                }
                echo "</div>";
                $sticky = 0;
                
            } else {
                $session_message[] = "You doesn't own this listing";
                $_SESSION['cookies_message'] = $session_message;   
                user_redirection();
            }
        } else {
            $session_message[] = "Please select any listing";
            $_SESSION['cookies_message'] = $session_message;   
            user_redirection();
        }
        
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

        $main_image = isset($_POST['main_image'])?post('main_image'):0;
        setcookie('main_image', $main_image, time() + COOKIES_EXP);

        if(!empty(array_filter($_FILES['files']['name']))){

        $currentDir = getcwd();
        $today = "day_".date("m_d_Y");
        $listing_id = $_SESSION["listing_id"];
        $uploadDirectory = "./images/img/";
        
        // echo "<pre>";
        // print_r($_FILES['files']['name']);
        // echo "</pre>";

        $array_upload = [];

        for ( $i=0 ; $i < count($_FILES['files']['name']) ; $i++){

            if (!file_exists($uploadDirectory)) //if file dont exist
            {
                mkdir($uploadDirectory);
                $_SERVER['PHP_SELF']; //call file again after creating directory
            }    

            $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

            $fileName = $_FILES['files']['name'][$i];
            $fileSize = $_FILES['files']['size'][$i];
            $fileTmpName  = $_FILES['files']['tmp_name'][$i];
            $fileType = $_FILES['files']['type'][$i];
            $explode = explode('.',$fileName);
            $end = end($explode);
            $strtolower = strtolower($end);
            $fileExtension = $strtolower;

            $changedName = $listing_id."_".$i.".".basename($fileType);
            
            $uploadPath = $currentDir . $uploadDirectory . basename($changedName); 
            // echo $uploadPath."<br/>";
            $storage_path = $uploadDirectory.$changedName;

            if (! in_array($fileExtension,$fileExtensions)) {
                $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file.";
            }

            if ($fileSize > MAX_FILE) {
                $errors[] = "This file is more than 100kb. Sorry, it has to be less than or equal to 2MB.";
            }

            if (empty($errors)) {
                $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                $array_upload[] = $storage_path;
            } else { 
                $errors[] = "Something unusual occour, Try again !";
            }
              
        } //end of for loop

        if (empty($errors)) {
            $json_encode = json_encode($array_upload);
            $json_decode = json_decode($json_encode);
                // print_r($json_encode);
                // print_r($json_decode);
            $conn = db_connect();
            $sql = "UPDATE listings SET images_path=\$1 , images=\$2 , main_image=\$3 
            WHERE listings.user_id::VARCHAR = '$user_id' AND listings.listing_id::VARCHAR = '$listing_id' ";
            // echo $sql;
            $stmt = pg_prepare($conn, 'upload_image', $sql);

            if (false != $stmt) {
                // $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                
                if (!empty($json_encode)) {
                    $result = pg_execute($conn, 'upload_image', array($json_encode, count($json_encode), $main_image ));

                    $session_message[] = "Images Successfully upload.";
                    $_SESSION['cookies_message'] = $session_message;
                    // user_redirection();

                } else {
                    $error[] = "Image upload unsuccessful. Maybe filesize is more than 2 mb.";
                }
            }
        }
        
        // $json_decode = json_decode($json_encode);

        // echo "<pre>";
        // print_r($json_encode);
        // print_r($json_decode);
        // echo "</pre>";
        
    } else {
        $errors[] = "Please select images to upload.";
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

<?php
    $listing_id = $_SESSION["listing_id"];

    $conn = db_connect();
    $sql = "SELECT * FROM listings WHERE listing_id=$listing_id AND user_id='$user_id'";
    $query = pg_query($conn, $sql);

    if (pg_num_rows($query) > 0) {
        $row = pg_fetch_assoc($query);
        
        $json_decode = json_decode($row['images_path']);

        if( count($json_decode) <= MAX_UPLOAD_IMAGE) {
            echo "<div class='grid-x py-4'> <form class='cell medium-5 medium-offset-4 center row' action='";
            echo $_SERVER['PHP_SELF'];
            echo "' method='post' enctype='multipart/form-data' >";
            build_radio_for_images($json_decode, $main_image);
            echo "<div class='file-field input-field col s12'>
                        <h6  class='grey-text text-lighten-1'>Images</h6>
                        <div class='btn'>
                            <span>File</span>
                            <input type='file' name='files[]' multiple/>
                        </div>
                        <div class='file-path-wrapper'>
                            <input class='file-path validate' type='text' id='Upload_one_or_more_files' name='dsh_post_file1' />                               
                        </div>
                    </div>
                    <div class='input-field col s12 center'>
                        <!-- <input type='submit' class='btn waves-effect waves-light cayan lighten-1' name='submit'> -->
                        <button class='btn grey darken-2 waves-effect waves-light z-depth-4' name='dsh_post_submit' type='submit'>
                            UPLOAD <i class='fas fa-check'></i> 
                        </button>
                    </div>
                </form>
            </div>";
        }
    }
?>

<?php
require("./footer.php");
?>