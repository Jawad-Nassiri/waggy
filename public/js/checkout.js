const stripe = Stripe(stripeKey);
const elements = stripe.elements();

const cardElement = elements.create('card', {
    hidePostalCode: true,
    style: {
        base: {
            fontSize: '16px',
            color: '#333',
            '::placeholder': { color: '#aaa' }
        },
        invalid: { color: '#e74c3c' }
    }
});

cardElement.mount('#card-element');

cardElement.on('change', (e) => {
    const errorDiv = document.querySelector('#card-errors');
    errorDiv.textContent = e.error ? e.error.message : '';
});

document.querySelector('#place-order-btn').addEventListener('click', async () => {
    const firstName = document.querySelector('#first-name').value.trim();
    const lastName = document.querySelector('#last-name').value.trim();
    const address = document.querySelector('#address').value.trim();
    const city = document.querySelector('#city').value.trim();
    const zip = document.querySelector('#zip').value.trim();
    const phone = document.querySelector('#phone').value.trim();
    const email = document.querySelector('#email').value.trim();

    if (!firstName || !lastName || !address || !city || !zip || !phone || !email) {
        showToast('error', 'Error', 'Please fill in all fields', 3000);
        return;
    }

    const res = await fetch('/waggy/cart/payment', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ firstName, lastName, address, city, zip, phone, email })
    });

    const data = await res.json();

    if (data.error) {
        if (!document.querySelector('.toast')) {
            showToast('error', 'Error', data.error, 3000);
        }
        return;
    }

    const { error, paymentIntent } = await stripe.confirmCardPayment(data.clientSecret, {
        payment_method: {
            card: cardElement,
            billing_details: {
                name: firstName + ' ' + lastName,
                email: email,
                address: { line1: address, city: city }
            }
        }
    });

    if (error) {
        if (!document.querySelector('.toast')) {
            showToast('error', 'Error', error.message, 3000);
        }
        document.querySelector('#card-errors').textContent = error.message;
    } else if (paymentIntent.status === 'succeeded') {
        if (!document.querySelector('.toast')) {
            showToast('success', 'Success', 'Payment successfully !', 3000);
        }
        const cartCountEl = document.querySelector('.cart-count');
        if (cartCountEl) cartCountEl.remove();
        setTimeout(() => { location.href = '/waggy/cart/success'; }, 3000);
    }
});