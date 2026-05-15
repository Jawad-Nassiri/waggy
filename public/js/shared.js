
// add to cart functionality method
const addToCart = async (event, quantity = 1) => {
    const btn = event.target.closest('.btn-cart');
    if (!btn) return;

    event.preventDefault();

    let productId = btn.dataset.id;

    let obj = {
        productId,
        quantity
    }

    const res = await fetch('/waggy/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(obj)
    });

    let data = await res.json();
    let { status, message, productCount } = data;

    if (status.toLowerCase() === "success") {
        if (!document.querySelector('.toast')) {
            showToast(status.toLowerCase(), status, message, 3000);
        }
        const cartWrap = document.querySelector('.cart-wrap');
        let cartCount = document.querySelector('.cart-count');

        if (!cartCount) {
            cartWrap.insertAdjacentHTML('beforeend', '<span class="cart-count"></span>');
            cartCount = document.querySelector('.cart-count');
        }
        cartCount.textContent = data.cartCount;
    } else if (status.toLowerCase() === "warning") {
        if (!document.querySelector('.toast')) {
            showToast(status.toLowerCase(), status, message, 3000);
        }
    } else {
        showToast(status.toLowerCase(), status, message, 2000);
        setTimeout(() => { location.pathname = '/waggy/auth/login' }, 2000);
    }
}

// show error\success messages 
showMessage = (input, errElem, message, color) => {
    input.style.borderColor = color;
    errElem.style.color = color;
    errElem.textContent = message;
};

// clear message 
clearMessage = (input, errElem) => {
    input.style.borderColor = "";
    errElem.textContent = "";
};