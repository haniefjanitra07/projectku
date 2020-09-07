<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "belajar-php";

$conn = new mysqli($host, $username, $password, $database);

if($conn->connect_error){
    die("connection Failed! " . $conn->connect->error);
}
?>