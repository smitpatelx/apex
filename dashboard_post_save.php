<?php
 /*************
Author: Smit Patel
Deliverable 1 - dashboard_post_saev.php
October 2, 2018
WEBD3201
**************/ 

    require('./scripts/functions.php');
    $errors = []; // Store all foreseen and unforseen errors here

    $dsh_post_head = trimT('dsh_post_head');
    $dsh_post_location = trimT('dsh_post_location');
    $dsh_post_price = trimT('dsh_post_price');
    $dsh_post_area = trimT('dsh_post_area');
    $dsh_post_contact = trimT('dsh_post_contact');
    $dsh_post_file = trimT('dsh_post_file1');
    if(callPost())
	{
    $conn5 = db_connect();
      
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
                        $errors[] = "<br/>This file extension is not allowed. Please upload a JPEG or PNG file<br/>";
                    }

                    if ($fileSize > 2097152) {
                        $errors[] = "<br/>This file is more than 2MB. Sorry, it has to be less than or equal to 2MB<br/>";
                    }

                    if (empty($errors)) {
                        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                        if ($didUpload) {
                            $sql5 = "insert into listing_demo ( list_heading, img, location, price, sqft, phone) 
                            values ( '$dsh_post_head', '".$uploadDirectory."".$changedName."', '$dsh_post_location', '$dsh_post_price', '$dsh_post_area', '$dsh_post_contact')";

                            $result5 = pg_query($conn5, $sql5);
                            header('Location: dashboard.php');
                            echo "The file " . basename($fileName) . " has been uploaded";
                            ob_flush();
                        } else {
                            echo "<br/>An error occurred somewhere. Try again or contact the admin<br/> Maybe filesize is more than 2 mb.";
                        }
                    } else {
                        echo "These are the errors:<br/>";
                        foreach ($errors as $error) {
                            echo $error . "\n";
                        }
                    }

    }
    

?>