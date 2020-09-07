<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "belajar-php";

$connect = new mysqli($host, $username, $password, $database);

if ($connect->connect_error) {
   die('connection error ' . $connect->connect_error);
}

?>