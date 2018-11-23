<?php
require './includes/constants.php';
require './includes/db.php';
require './includes/functions.php';
require './randoms.php';

$conn = db_connect();
foreach(range(0, 1100) as $x) {
    $first_name = $first_names[$x];
    $last_name = $last_names[$x];
    $user_name = strtolower($last_name.substr($first_name, 0, 1));
    $password = hashmd5($user_name);
    // $user_type = $user_types[array_rand($user_types)];
    //$email_address = $user_name.$email_addresss[array_rand($email_addresss)];
    $street_address_1 = $street_address_1s[$x];
    $street_address_2 = $street_address_2s[$x];
    $city = $cities[array_rand($cities)];
    $postal_code = $postalcodes[array_rand($postalcodes)];
    //$enrol_date = date("Y-m-d",time());
    //$last_access = date("Y-m-d",time());
    $primary_phone_number = $primary_phone_numbers[$x];
    $secondry_phone_number = $secondry_phone_numbers[$x];
    $fax_number = $fax_numbers[$x];
    $salutation = $salutations[array_rand($salutations)];
    $province = $provinces[array_rand($provinces)];
    $preferred_contact_method = $p_c_m[array_rand($p_c_m)];

    

    $sql1 = "SELECT * FROM users WHERE user_name = '$user_name' AND primary_phone_number = '$primary_phone_number'";
    $query1 = pg_query($conn, $sql1);
    $row = pg_fetch_assoc($query1);
    $user_id = $row['user_id'];
    // $smit = $first_names[$x];
     echo $user_id."\n";

    $sql2 = "INSERT INTO persons (user_id, preferred_contact_method, province, salutation, first_name, last_name, street_address_1, street_address_2, city, postal_code, primary_phone_number, secondry_phone_number, fax_number) 
    VALUES ('$user_id','$preferred_contact_method', '$province', '$salutation', '$first_name', '$last_name', '$street_address_1','$street_address_2', '$city', '$postal_code', '$primary_phone_number', '$secondry_phone_number', '$fax_number')";
    $query = pg_query($conn, $sql2);
    
}
// echo $password;
?>