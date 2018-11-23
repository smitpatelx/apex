<?php

    $test = [];

    $test[] = "sadsa";
    $test[] = "date";

    $test1 = json_encode($test);
    echo $test1;
    $test2 = json_decode($test1);
    print_r($test2);
?>