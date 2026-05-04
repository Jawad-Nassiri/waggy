const doc = document;
const cartItemsContainer = doc.querySelector('.cart-items');



// calculate products price
const calculatePrice = async (e) => {
    const minusBtn = e.target.closest('.minus');
    const plusBtn = e.target.closest('.plus');
    const control = e.target.closest('.quantity-control')
    const subtotalPrice = doc.querySelector('.subtotal-price')
    const totalPrice = doc.querySelector('.total-price')
    const subtotals = doc.querySelectorAll('.subtotal')

    if (!control) return;

    const input = control.querySelector('input');
    const subtotal = control.nextElementSibling;

    if (!input || !subtotal) return;

    let quantity = Number(input.value);
    let productId = control.dataset.id;
    let price = Number(subtotal.dataset.price);

    if (minusBtn) {
        if (quantity <= 1) return;
        quantity--;
    }

    if (plusBtn) {
        quantity++;
    }

    input.value = quantity;
    subtotal.textContent = `$${(quantity * price).toFixed(2)}`;

    let fullPrice = 0;
    subtotals.forEach(subtotal => {
        fullPrice += Number(subtotal.textContent.replace('$', ''));
    });

    subtotalPrice.textContent = '$' + fullPrice.toFixed(2);
    totalPrice.textContent = '$' + fullPrice.toFixed(2);

    // updata cart 
    if (minusBtn || plusBtn) {

        let res = await fetch('/waggy/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ quantity, productId })
        });

        if (!res.ok) {
            console.error('Request failed');
            return;
        }

        let data = await res.json();
        if (data.status.toLowerCase() === 'success') {
            if (!document.querySelector('.toast')) {
                showToast('success', 'Success', 'Cart updated successfully', 2000);
            }
        }
    }


}

// delete product 
const deleteProduct = async (e) => {
    const deleteBtn = e.target.closest('.delete-btn');
    if (!deleteBtn) return;

    const productRow = deleteBtn.closest('.product-row');
    let productId = deleteBtn.dataset.id;

    const res = await fetch('/waggy/cart/delete', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ productId })
    });

    const data = await res.json();
    let { cartCount, status, message } = data;

    if (status.toLowerCase() === "success") {

        if (!doc.querySelector('.toast')) {
            showToast(status.toLowerCase(), status, message, 3000);
        }

        if (productRow) productRow.remove();

        const subtotals = doc.querySelectorAll('.subtotal');
        let fullPrice = 0;
        subtotals.forEach(s => fullPrice += Number(s.textContent));

        const subtotalPrice = doc.querySelector('.subtotal-price');
        const totalPrice = doc.querySelector('.total-price');
        if (subtotalPrice) subtotalPrice.textContent = '$' + fullPrice.toFixed(2);
        if (totalPrice) totalPrice.textContent = '$' + fullPrice.toFixed(2);

        const cartWrap = doc.querySelector('.cart-wrap');
        let cartCountEl = doc.querySelector('.cart-count');
        const proceedBtn = doc.querySelector('.proceed-btn');

        if (cartCount > 0) {
            if (!cartCountEl) {
                cartWrap.insertAdjacentHTML('beforeend', '<span class="cart-count"></span>');
                cartCountEl = doc.querySelector('.cart-count');
            }

            cartCountEl.textContent = cartCount;

        } else {
            if (proceedBtn) proceedBtn.remove();

            if (totalPrice) totalPrice.textContent = '$0.00';
            if (subtotalPrice) subtotalPrice.textContent = '$0.00';


            if (!doc.querySelector('.empty-cart')) {
                const emptyCart = doc.createElement('div');
                const emptyCartTitle = doc.createElement('h1');

                emptyCart.className = 'empty-cart';
                emptyCartTitle.innerHTML = 'Your cart is empty <i class="fa-regular fa-face-frown"></i>';

                emptyCart.appendChild(emptyCartTitle);
                cartItemsContainer.appendChild(emptyCart);
            }

            if (cartCountEl) cartCountEl.remove();
        }

    } else {
        showToast(status.toLowerCase(), status, message, 3000);
        setTimeout(() => { location.pathname = '/waggy/auth/login' }, 3000);
    }
};

// handle methods 
cartItemsContainer.addEventListener('click', (e) => {
    calculatePrice(e);
    deleteProduct(e);
});

