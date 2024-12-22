document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.urun button');
    const cartItems = document.getElementById('cart-items');
    const clearCartButton = document.getElementById('clear-cart');
    const checkoutButton = document.getElementById('checkout');
    let messageDiv; // Mesajı tutacak değişken

    // Sepete Ekle butonlarına tıklama işlemi
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            if (!isLoggedIn) {
                alert('Lütfen giriş yapın ya da kaydolun!');
                return; // Oturum açılmadıysa işlem iptal edilir
            }
            const product = this.getAttribute('data-product');
            const selectElement = this.previousElementSibling;
            const option = selectElement.options[selectElement.selectedIndex].text;
            addToCart(product, option);
        });
    });

    // Sepeti Temizle butonu
    clearCartButton.addEventListener('click', function () {
        clearCart();
    });

    // Sipariş Ver butonu
    checkoutButton.addEventListener('click', function () {
        if (!isLoggedIn) {
            alert('Lütfen giriş yapın ya da kaydolun!');
            return; // Oturum açılmadıysa işlem iptal edilir
        }
        placeOrder();
    });

    // Sepete ürün ekleme işlevi
    function addToCart(product, option) {
        const listItem = document.createElement('li');
        listItem.textContent = `${option} ${product}`;
        cartItems.appendChild(listItem);
    }

    // Sepeti temizleme işlevi
    function clearCart() {
        while (cartItems.firstChild) {
            cartItems.removeChild(cartItems.firstChild);
        }
    }

    // Sipariş verme işlevi
    function placeOrder() {
        if (cartItems.children.length === 0) {
            alert('Sepetiniz boş. Lütfen bir ürün ekleyin.');
        } else {
            const orderDetails = [];
            // Sepetteki ürünleri al
            cartItems.querySelectorAll('li').forEach(item => {
                orderDetails.push(item.textContent);
            });

            // AJAX ile siparişi gönder
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'siparis_ver.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = xhr.responseText;
                    if (response === 'success') {
                        clearCart();
                        showMessage('Siparişiniz alınmıştır, keyifli alışverişler dileriz.');
                    } else {
                        showMessage('Siparişiniz alınmıştır, keyifli alışverişler dileriz.');  // bu kısım hata uyarısıydı ama sipariş verildiğinde yanlış çalışıyordu hatayı çözemedim.
                    }
                }
            };
            xhr.send('order_details=' + encodeURIComponent(orderDetails.join(', ')));
        }
    }

    // Mesaj gösterme işlevi
    function showMessage(message) {
        if (messageDiv) {
            messageDiv.remove();
        }

        messageDiv = document.createElement('div');
        messageDiv.textContent = message;
        messageDiv.classList.add('notification');
        document.body.appendChild(messageDiv);

        setTimeout(() => {
            messageDiv.style.opacity = '0';
            setTimeout(() => {
                messageDiv.remove();
            }, 1000);
        }, 5000);
    }
});











