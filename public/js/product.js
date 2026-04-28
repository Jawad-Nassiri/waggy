// toggle tabs 
const doc = document;
const tabButtons = doc.querySelectorAll('.tab-btn');
const tabPanels = doc.querySelectorAll('.tab-panel');
const minusBtn = doc.querySelector('#qty-minus')
const input = doc.querySelector('#qty-input')
const plusBtn = doc.querySelector('#qty-plus')
const addToCartBtn = doc.querySelector('.btn-add-to-cart')


tabButtons.forEach(tabBtn => {
    tabBtn.addEventListener('click', () => {
        tabButtons.forEach(b => b.classList.remove('active'));
        tabPanels.forEach(p => p.classList.remove('active'));

        tabBtn.classList.add('active');
        document.getElementById(tabBtn.dataset.tab).classList.add('active');
    })
});

// handle minus and plus btn
minusBtn.addEventListener('click', () => {
    let value = Number(input.value);
    if (value <= 1) return
    input.value -= 1;
});

plusBtn.addEventListener('click', () => {
    input.value = Number(input.value) + 1;
})

// add to cart functionality using method add to cart from shared.js
addToCartBtn.addEventListener('click', e => {
    let quantity = input.value;
    addToCart(e, quantity)

    input.value = 1
});

