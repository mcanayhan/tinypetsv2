<?php
session_start();
include('db.php');

// Hata kontrolü
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kullanıcı giriş yapmış mı kontrol et
    if (isset($_SESSION['user_id'])) {
        // Sipariş detaylarını al
        if (isset($_POST['order_details'])) {
            $order_details = $_POST['order_details'];
            $user_id = $_SESSION['user_id'];
            $order_date = date('Y-m-d H:i:s'); // Sipariş tarihi

            // Siparişi veritabanına kaydet
            $query = "INSERT INTO siparisler (user_id, order_details, order_date) VALUES (?, ?, ?)";
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("iss", $user_id, $order_details, $order_date);
                if ($stmt->execute()) {
                    echo 'success'; // Başarı durumu
                } else {
                    echo 'error'; // Veritabanı hatası
                }
                $stmt->close();
            } else {
                echo 'stmt_error'; // Prepared statement hatası
            }
        } else {
            echo 'no_order_details'; // Sipariş detayları eksik
        }
    } else {
        echo 'not_logged_in'; // Kullanıcı giriş yapmamış
    }
}
?>


