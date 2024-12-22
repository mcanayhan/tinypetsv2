<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Oturum başlatma
session_start();

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$database = "tinypets";

$conn = new mysqli($servername, $username, $password, $database);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Formdan gelen verileri işle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $sifre = $_POST["sifre"];

    // Kullanıcıyı veritabanında ara
    $sql = "SELECT * FROM kullanıcılar WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Kullanıcı bulundu, şifre kontrolü yap
        $row = $result->fetch_assoc();
        if (password_verify($sifre, $row["sifre"])) {
            // Oturumu başlat ve kullanıcı bilgilerini sakla
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['kullanici_adi'];

            // Ana sayfaya yönlendirme
            header('Location: tinypets.php');
            exit();
        } else {
            echo "<p style='color: red;'>Hatalı şifre!</p>";
        }
    } else {
        echo "<p style='color: red;'>Bu email ile kayıtlı kullanıcı bulunamadı.</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="login.register.css">
</head>
<body>
    <h2>Giriş Yap</h2>
    <form method="POST" action="login.php">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="sifre">Şifre:</label><br>
        <input type="password" id="sifre" name="sifre" required><br><br>

        <button type="submit">Giriş Yap</button>
    </form>
</body>
</html>


