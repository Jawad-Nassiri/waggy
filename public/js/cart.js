const doc = document;
const cartItemsContainer = doc.querySelector('.cart-items');


cartItemsContainer.addEventListener('click', (e) => {
    const minusBtn = e.target.closest('.minus');
    const plusBtn = e.target.closest('.plus');
    const control = e.target.closest('.quantity-control')
    const subtotalPrice = document.querySelector('.subtotal-price')
    const totalPrice = document.querySelector('.total-price')
    const subtotals = document.querySelectorAll('.subtotal')

    if (!control) return;

    const input = control.querySelector('input');
    const subtotal = control.nextElementSibling;

    if (!input || !subtotal) return;

    let quantity = Number(input.value);
    let price = Number(subtotal.dataset.price);

    if (minusBtn) {
        if (quantity <= 1) return;
        quantity--;
    }

    if (plusBtn) {
        quantity++;
    }

    input.value = quantity;
    subtotal.textContent = (quantity * price).toFixed(2);

    let fullPrice = 0;
    subtotals.forEach(subtotal => {
        fullPrice += Number(subtotal.textContent);
    })

    subtotalPrice.textContent = '$' + fullPrice.toFixed(2)
    totalPrice.textContent = '$' + fullPrice.toFixed(2)

});

