document.addEventListener('DOMContentLoaded', function() {
    // Sepete ekle butonlarını seçme
    var addToCartButtons = document.querySelectorAll('.add-to-cart');

    // Sepetimiz
    var cart = [];

    // Her bir sepete ekle butonuna tıklama olayını ekleme
    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Ürün bilgilerini alalım
            var product = {
                name: button.parentNode.querySelector('h2').innerText,
                price: button.parentNode.querySelector('.fiyat').innerText,
            };

            // Sepete ürünü ekle
            cart.push(product);

            // Sepet bilgisini güncelleme
            updateCart();
        });
    });

    // Sepet bilgisini güncelleyen fonksiyon
    function updateCart() {
        var cartItemsElement = document.getElementById('cart-items');
        cartItemsElement.innerHTML = '';

        cart.forEach(function(item) {
            var li = document.createElement('li');
            li.textContent = `${item.name} - ${item.price}`;
            cartItemsElement.appendChild(li);
        });
    }

    // Sepeti temizle butonu işlevselliği
    var clearCartButton = document.getElementById('clear-cart');
    clearCartButton.addEventListener('click', function() {
        cart = [];
        updateCart();
    });

    // Sipariş ver butonu işlevselliği (opsiyonel)
    var checkoutButton = document.getElementById('checkout');
    checkoutButton.addEventListener('click', function() {
        // Sipariş verme işlemi burada gerçekleştirilebilir
        alert('Siparişiniz alınmıştır, keyifli alışverişler dileriz.');
    });
});
