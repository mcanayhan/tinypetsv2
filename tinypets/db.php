<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tinypets"; // Veritabanı adınızı buraya yazın

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

