// Cart 
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cart-btn').forEach(button => { // Event - button to add Cart (by classname)
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            addToCart(productId);
        });
    });

    document.getElementById('cart-btn').addEventListener('click', function() { // load cart-content and open modal cart (by Id)
        loadCart();
        openModal('cartModal');
    });

    document.getElementById('checkoutButton').addEventListener('click', function() { // checkout button event (by Id)
        checkout();
    });

    function addToCart(productId) {
        fetch('vendor/add_to_cart.php', { // query 
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}`
        })
        .then(response => response.json()) // json reply
        .then(data => {
            if (data.success) {
                alert(data.message);
            } else {
                alert(data.message);
            }
        });
    }

    function loadCart() {
        fetch('vendor/getCart.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const cartContent = document.getElementById('cart-content');
                cartContent.innerHTML = '';
                let totalSum = 0;

                data.cartItems.forEach(item => {
                    const itemHTML = `
                         <div class="cart-item">
                            <div class="cart-item-info">
                                <div class="cart-item-title">${item.title}</div>
                                <div class="cart-item-price">${item.price} ₽</div>
                            </div>
                            <div class="cart-item-quantity">${item.quantity} шт.</div>
                            <div class="cart-item-actions">
                                <button class="remove-from-cart-btn" data-product-id="${item.id}">Удалить</button>
                            </div>
                        </div>
                    `;
                    cartContent.insertAdjacentHTML('beforeend', itemHTML);
                    totalSum += item.quantity * item.price;
                });

                document.getElementById('cart-total').textContent = totalSum;

                document.querySelectorAll('.remove-from-cart-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.getAttribute('data-product-id');
                        removeFromCart(productId);
                    });
                });
            } else {
                alert(data.message);
            }
        });
    }

    function removeFromCart(productId) {
        fetch('vendor/remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                loadCart(); 
            } else {
                alert(data.message);
            }
        });
    }

    function checkout() {
        fetch('vendor/checkout.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                loadCart(); 
            } else {
                alert(data.message);
            }
        });
    }

    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    document.querySelectorAll('.close-modal').forEach(closeBtn => {
        closeBtn.addEventListener('click', function() {
            closeModal('cartModal');
        });
    });

    window.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal')) {
            closeModal('cartModal');
        }
    });
});