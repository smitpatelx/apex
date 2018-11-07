<?php 
require 'includes/constants.php';
require 'includes/db.php';
require 'includes/functions.php';
require_once 'vendor/autoload.php';

$faker = Faker\Factory::create();
$faker->addProvider(new Faker\Provider\en_CA\Address($faker));
// $faker->addProvider(new Faker\Provider\en_CA\PhoneNumber($faker));
$conn = db_connect();
foreach(range(1, 1000) as $x) {
    
    $user_name = $faker->userName;
    $password = $faker->password;
    $password = hashmd5($password);
    $user_type = $faker->randomElement($array = array (AGENT,ADMIN,CLIENT,PENDING,DISABLED));
    $first_name = $faker->firstName($gender = 'male'|'female', $asText = true);
    $last_name = $faker->lastName;
    $email_address = $faker->freeEmail;
    $street_address_1 = $faker->streetAddress;
    $street_address_2 = $faker->streetAddress;
    $city = $faker->randomElement($array = array (
        "ajax",
        "brooklin",
        "bowmanville",
        "oshawa",
        "pickering",
        "port perry",
        "whitby",
        "clarington",
        "scugog",
        "brampton",
        "toronto",
        "bowmanville",
        "courtice"
    ));
    $postal_code = $faker->randomElement($array = array (
        "E8N2G5",
        "G6G1V1",
        "R2C2Z6",
        "N3B1E7",
        "H9H1Y6",
        "E6L3W8",
        "E4X0W6",
        "T7S0X3",
        "N4K0W5",
        "B1C2T5",
        "H9P2C5",
        "R6W1H8",
        "H5A0L7",
        "H7Y1S8",
        "B3T1P4",
        "J5T1V1",
        "E4B2T0",
        "N3W1R3",
        "J6N2X0",
        "E8L0X6",
        "L9N1L3",
        "N3L0G1",
        "G0H3R0",
        "K9A1E7",
        "L4A3X0",
        "E4K1J2",
        "G4A0J1",
        "T4G0X7",
        "T9V1C1",
        "B2S1H0",
        "G6X3A3",
        "V0L0B0",
        "J0H3B3",
        "X0C1S5",
        "E8R3V0",
        "E1W2W6",
        "X1A3W4",
        "B3V0L5",
        "B2R2X1",
        "K4R3E8"
    ));
    $primary_phone_number = convert_phone(trim_between(clean($faker->tollFreePhoneNumber)));
    $secondry_phone_number = convert_phone(trim_between(clean($faker->tollFreePhoneNumber)));
    $fax_number = convert_phone(trim_between(clean($faker->tollFreePhoneNumber)));
    $enrol_date = $faker->iso8601($max = 'now');
    $last_access = $faker->iso8601($max = 'now');

    $sql2 = "INSERT INTO users (user_name, password, user_type, first_name, last_name, email_address, street_address_1, street_address_2, city, postal_code, primary_phone_number, secondry_phone_number, fax_number, enrol_date, last_access) 
    VALUES ('$user_name','$password','$user_type', '$first_name', '$last_name', '$email_address', '$street_address_1','$street_address_2', '$city', '$postal_code', '$primary_phone_number', '$secondry_phone_number', '$fax_number', '$enrol_date'::date, '$last_access'::date)";
    $query = pg_query($conn, $sql2);
}

?>
<pre>
    <?php 
    //echo $sql2;
    ?>
</pre>