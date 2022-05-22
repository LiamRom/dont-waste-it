<?php


$host = "localhost";
$user = "liamro_user";
$pass = "12345";
$db = "liamro_dont_waste_it";

$connection = mysqli_connect($host, $user, $pass, $db);

mysqli_set_charset($connection,"utf8");


if (!$connection) {
    echo "Connection failed!";
}






?>
