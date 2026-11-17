<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = ''; // Mặc định XAMPP để trống
$db   = 'dtbpetshop';

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Lỗi kết nối CSDL: " . $conn->connect_error);
}
?>