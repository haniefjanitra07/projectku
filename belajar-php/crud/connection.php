<?php

// Menyembunyikan Pesan Error Dari PHP
error_reporting(0);

// Deklarasi Konfigurasi Koneksi Ke MySQL
$hostname = "localhost";
$username = "root";
$password = "";
$database = "mq";

// Koneksi Ke MySQL
$connect = new mysqli($hostname, $username, $password, $database);

// Cek Apakah Koneksi Gagal
if ($connect->connect_error) {
	exit("Gagal Melakukan Koneksi Ke Server MySQL!");
}