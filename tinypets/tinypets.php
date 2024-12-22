<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="tinypets.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TİNY PETS SHOP</title>
    <script>
    const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
</script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('img/arkaplan.jpg') no-repeat center center fixed;
        background-size: cover;
            background-color: #f0f0f0;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8); /* Beyaz arka plan ve şeffaflık */
        border-radius: 10px;
        }
        h1 {
            text-align: center;
        }
        .urunler {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .urun {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            text-align: center;
            width: 200px;
            margin: 0 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .urun .fiyat {
            font-weight: bold;
            color: green;
            margin-top: 10px;
        }
        .urun select {
            margin-top: 10px;
            padding: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        .urun button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #ff6347;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .urun button:hover {
            background-color: #050505;
        }
        .cart {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 200px;
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart h3 {
            margin-top: 0;
        }
        .cart ul {
            list-style-type: none;
            padding: 0;
        }
        .cart ul li {
            margin-bottom: 10px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1>TİNY PETS SHOP</h1>

        <?php if (isset($_SESSION['username'])): ?>
            <!-- Kullanıcı giriş yapmışsa -->
            <p class="welcome-message">Hoşgeldin, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            <button onclick="window.location.href='logout.php';">Çıkış Yap</button> <!-- Çıkış butonu ekledik -->
        <?php else: ?>
            <!-- Kullanıcı giriş yapmamışsa -->
            <button onclick="window.location.href='http://localhost/tinypets/register.php';">Kayıt Ol</button>
            <button onclick="window.location.href='http://localhost/tinypets/login.php';">Giriş Yap</button>
        <?php endif; ?>

        <!-- Mevcut içerik -->
        <div class="urunler">
            <!-- Ürünler buradan devam ediyor -->
        </div>
        
        <div class="urunler">
            <div class="urun">
                <h2>Köpek Mamaları</h2>
                <img src="img/köpekmama.jpg" alt="Köpek Maması Resmi">
                <p>Köpeklerinizin beslenme ihtiyaçlarını tam ve dengeli bir biçimde sağlar. Tatlandırıcı ve koruyucu içermez.</p>
                <p class="fiyat">₺489.99</p>
                <select>
                    <option value="tavuklu">Tavuklu</option>
                    <option value="balıklı">Balıklı</option>
                    <option value="sığıretli">Sığır Etli</option>
                </select>
                <button data-product="Köpek Maması">Sepete Ekle</button>
            </div>
            <div class="urun">
                <h2>Kedi Mamaları</h2>
                <img src="img/kedimama.jpg" alt="Kedi Maması Resmi">
                <p>Kedilerinizin beslenme ihtiyaçlarını tam ve dengeli bir biçimde sağlar. Tatlandırıcı ve koruyucu içermez.</p>
                <p class="fiyat">₺489.99</p>
                <select>
                    <option value="tavuklu">Tavuklu</option>
                    <option value="balıklı">Balıklı</option>
                    <option value="sığıretli">Sığır Etli</option>
                </select>
                <button data-product="Kedi Maması">Sepete Ekle</button>
            </div>
            <div class="urun">
                <h2>Hamster Yemleri</h2>
                <img src="img/hamsteryemi.jpg" alt="Hamster Yemi Resmi">
                <p>Hamsterlarınız için değerli proteinli yemler.İçerdiği çeşitli vitamin ve minerallerle gelişim eksikliklerini önler, canlılık kazandırır .</p>
                <p class="fiyat">₺489.99</p>
                <select>
                    <option value="musli">Müsli</option>
                    <option value="yoncasebze">Yonca Sebze Karışımı</option>
                    <option value="meyveli">Meyveli</option>
                </select>
                <button data-product="Hamster Yemi">Sepete Ekle</button>
            </div>
            <div class="urun">
                <h2>Kuş Yemleri</h2>
                <img src="img/kusyemi.jpg" alt="Kuş Yemi Resmi">
                <p>Kuşlarınızın ihtiyaç duyduğu tüm tahıl ve elementlerin tespiti yapılarak hazırlanmıştır. Vitamin ve mineral açısından desteklenmiştir.</p>
                <p class="fiyat">₺489.99</p>
                <select>
                    <option value="vitaminli">Vitaminli</option>
                    <option value="tohumlu">Tohumlu</option>
                    <option value="kuruyemisli">Kuruyemişli</option>
                </select>
                <button data-product="Kuş Yemi">Sepete Ekle</button>
            </div>
        </div>
        <div id="cart" class="cart">
            <h3>Sepet</h3>
            <ul id="cart-items"></ul>
            <button id="clear-cart">Sepeti Temizle</button> <!-- Sepeti Temizle butonu eklendi -->
            <button id="checkout">Sipariş Ver</button> <!-- Sipariş Ver butonu -->
    </div>
    <div id="message" class="message"></div> <!-- Sipariş mesajı -->
    <a href="evlervekafesler.html"><button>Kafesler ve Evler</button></a>
    <script src="tinypets.js"></script> <!-- JavaScript dosyasını burada dahil ediyoruz -->
    </div>
</body>
</html>
