<?php
// Veritabanı bağlantısını yap
$servername = "localhost";
$username = "root";
$password = "";
$database = "tinypets";

$conn = new mysqli($servername, $username, $password, $database);

// Bağlantı hatasını kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Formdan gelen verileri işle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = $_POST["kullanici_adi"];
    $email = $_POST["email"];
    $sifre = password_hash($_POST["sifre"], PASSWORD_BCRYPT);

    // SQL sorgusu ile veriyi ekle
    $sql = "INSERT INTO kullanıcılar (kullanici_adi, email, sifre) VALUES ('$kullanici_adi', '$email', '$sifre')";
    
    if ($conn->query($sql) === TRUE) {
        // Kayıt başarılıysa login.php'ye yönlendir
        header("Location: login.php");
        exit(); // Header sonrası kodun çalışmasını durdur
    } else {
        echo "<p style='color: red;'>Hata: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="login.register.css">
</head>
<body>
    <h2>Kayıt Ol</h2>
    <form method="POST" action="register.php">
        <label for="kullanici_adi">Kullanıcı Adı:</label><br>
        <input type="text" id="kullanici_adi" name="kullanici_adi" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="sifre">Şifre:</label><br>
        <input type="password" id="sifre" name="sifre" required><br><br>

        <button type="submit">Kayıt Ol</button>
    </form>

    <p>Zaten hesabınız var mı? <a href="login.php">Giriş Yap</a></p>
</body>
</html>


