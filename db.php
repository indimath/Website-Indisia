<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bajuadat";

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
