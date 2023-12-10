<?php
// Membuat koneksi
$hostname       = "localhost";
$username       = "root";
$password       = "";
$database       = "sikendaraan";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Tidak dapat terhubung ke Database.<br>Pastikan koneksi internet anda." . $conn->connect_error);
}

// Setting waktu default server
date_default_timezone_set('Asia/Jakarta');
