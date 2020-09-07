<?php 

// Menyembunyikan Pesan Error Dari PHP
error_reporting(0);

$hostname = "localhost";
$user = "root";
$pass = "";
$db = "proyek";

// Koneksi ke SQL
$conn = new mysqli($hostname, $user, $pass, $db);

if ($conn->connect_error) {
	exit("Gagal Melakukan Koneksi Ke Server MySQL!");
}