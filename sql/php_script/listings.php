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
    $city = $cityss[array_rand($cityss)];
    $postal_code = $postalcodes[array_rand($postalcodes)];
    //$enrol_date = date("Y-m-d",time());
    //$last_access = date("Y-m-d",time());
    $primary_phone_number = $primary_phone_numbers[$x];
    $secondry_phone_number = $secondry_phone_numbers[$x];
    $fax_number = $fax_numbers[$x];
    $salutation = $salutations[array_rand($salutations)];
    $province = $provinces[array_rand($provinces)];
    $preferred_contact_method = $p_c_m[array_rand($p_c_m)];
    $status = $statuss[array_rand($statuss)];
    $price = rand(200000, 1500000);
    $headline = $user_name;
    $description = $headline.$headline.$headline;
    $images = rand(1, 6);
    $property_options = $property_optionss[array_rand($property_optionss)];
    $bedrooms = rand(4, 12);
    $bathrooms = rand(2, 4);
    $area = rand(3000, 10000);
    $pets_friendly = $pets_friendlys[array_rand($pets_friendlys)];
    $created_on = date("Y-m-d",time());

    $sql1 = "SELECT * FROM users WHERE user_name = '$user_name' AND primary_phone_number = '$primary_phone_number'";
    $query1 = pg_query($conn, $sql1);
    $row = pg_fetch_assoc($query1);
    $user_id = $row['user_id'];
    // $smit = $first_names[$x];
     echo $user_id."\n";
    

    $sql2 = "INSERT INTO listings (user_id ,status ,price ,headline ,description ,postal_code ,images ,city ,property_options ,bedrooms ,bathrooms ,address ,area ,contact ,pets_friendly ,created_on) 
    VALUES ('$user_id', '$status', '$price', '$headline', '$description', '$postal_code' , '$images', '$city', '$property_options', '$bedrooms', '$bathrooms', '$street_address_1', '$area', '$primary_phone_number', '$pets_friendly', '$created_on' )";
    $query = pg_query($conn, $sql2);
    
}
// echo $password;
?>