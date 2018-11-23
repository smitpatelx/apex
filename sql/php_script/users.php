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
    $user_type = $user_types[array_rand($user_types)];
    $email_address = $user_name.$email_addresss[array_rand($email_addresss)];
    $street_address_1 = $street_address_1s[$x];
    $street_address_2 = $street_address_2s[$x];
    $city = $cities[array_rand($cities)];
    $postal_code = $postalcodes[array_rand($postalcodes)];
    $enrol_date = date("Y-m-d",time());
    $last_access = date("Y-m-d",time());
    $primary_phone_number = $primary_phone_numbers[$x];
    $secondry_phone_number = $secondry_phone_numbers[$x];
    $fax_number = $fax_numbers[$x];
    $salutation = $salutations[array_rand($salutations)];
    $province = $provinces[array_rand($provinces)];
    $preferred_contact_method = $p_c_m[array_rand($p_c_m)];
    // $smit = $first_names[$x];
    // echo $x.$street_address_2."\n";
    $sql_u = "SELECT * FROM users WHERE user_name='$user_name'";
    $sql_e = "SELECT * FROM users WHERE email_address='$email_address'";
    $res_u = pg_query($conn, $sql_u);
    $res_e = pg_query($conn, $sql_e);

    
    echo $x."\n";
    // if (pg_num_rows($res_u) > 0 || pg_num_rows($res_e) > 0) {	
    //     echo "noWay\n";
    //     $user_name = substr($user_name, 0, 4).rand(0,999);  	
    //     $email_address = $user_name.$email_addresss[array_rand($email_addresss)];
    // }

    $sql2 = "INSERT INTO users (preferred_contact_method, province, user_name, password, user_type, salutation, first_name, last_name, email_address, street_address_1, street_address_2, city, postal_code, primary_phone_number, secondry_phone_number, fax_number, enrol_date, last_access) 
    VALUES ('$preferred_contact_method', '$province','$user_name','$password','$user_type', '$salutation', '$first_name', '$last_name', '$email_address', '$street_address_1','$street_address_2', '$city', '$postal_code', '$primary_phone_number', '$secondry_phone_number', '$fax_number', '$enrol_date'::date, '$last_access'::date)";
    $query = pg_query($conn, $sql2);
    
}
// echo $password;
?>