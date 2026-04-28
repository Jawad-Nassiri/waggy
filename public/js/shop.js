// send request to fetch data
const categoryListElem = document.querySelector('.category-list');
const priceListElem = document.querySelector('.price-list');
const paginationContainerElem = document.querySelector('#pagination');
const productsContainer = document.querySelector('.shop-grid#products-container');
const resultsCountElem = document.querySelector('.results-count');
const paginationLinks = document.querySelectorAll('.pagination-link.num');
const arrowRight = document.querySelector('.arrow-right');
const arrowLeft = document.querySelector('.arrow-left');
const categoryFilterLinks = categoryListElem.querySelectorAll('a');
const priceFilterLinks = priceListElem.querySelectorAll('a');


let categoryId = null;
let price = null;
let currentPage = 1;

function handleFilterClick(event, type) {

    event.preventDefault();
    const target = event.target.closest('a');
    if (!target) return;

    productsContainer.innerHTML = '';
    resultsCountElem.innerHTML = '';

    const value = target.dataset[type];

    if (type === 'category') {
        categoryId = value || null;
        currentPage = 1;
    }

    if (type === 'price') {
        price = value || null;
        currentPage = 1;
    }

    if (type === 'page') {
        currentPage = parseInt(value);
    }

    fetchProducts();
}

const highlightClickedElem = (arr) => {
    arr.forEach(a => {
        a.addEventListener('click', () => {
            arr.forEach(el => el.classList.remove('active'));
            a.classList.add('active');
        });
    });
};

async function fetchProducts() {

    const res = await fetch(`/waggy/shop/filter?category=${categoryId ?? ''}&price=${price ?? ''}&page=${currentPage}`)

    const data = await res.json();
    const products = data.products;
    const totalProducts = data.totalProducts;
    const totalPages = data.totalPages;

    paginationContainerElem.innerHTML = '';
    renderPagination(totalPages);


    resultsCountElem.textContent = `Showing ${products.length} out of ${totalProducts}`;

    products.forEach(product => {
        let { id, image, name, price } = product;
        let star = '';
        let randomNum = Math.floor(Math.random() * 4) + 2;

        for (let i = 1; i <= randomNum; i++) {
            star += '★';
        }

        productsContainer.insertAdjacentHTML('beforeend',
            `
            <a class="product-card-link" href="/waggy/product/index/${id}">
                <div class="product-card">
                    <div class="product-image">
                        <img src="/waggy/public/images/${image}" alt="${name}">
                    </div>
                    <h3>${name}</h3>
                    <div class="product-stars">
                        ${star} ${randomNum}.0
                    </div>
                    <p class="product-price">$${parseFloat(price).toFixed(2)}</p>
                    <button class="btn-cart" data-id=${id}>ADD TO CART</button>
                </div>
                </a>
            `
        )
    })

};

function renderPagination(totalPages) {
    if (totalPages <= 1) return;

    if (currentPage > 1) {
        paginationContainerElem.insertAdjacentHTML('beforeend',
            `<a href="#" class="pagination-link arrow-left" data-page="${currentPage - 1}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>`
        );
    }

    for (let i = 1; i <= totalPages; i++) {
        paginationContainerElem.insertAdjacentHTML('beforeend',
            `<a href="#" class="pagination-link num ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</a>`
        );
    }

    if (currentPage < totalPages) {
        paginationContainerElem.insertAdjacentHTML('beforeend',
            `<a href="#" class="pagination-link arrow-right" data-page="${currentPage + 1}">
                <i class="fa-solid fa-arrow-right"></i>
            </a>`
        );
    }
}

highlightClickedElem(categoryFilterLinks);
highlightClickedElem(priceFilterLinks);


categoryListElem.addEventListener('click', (e) => handleFilterClick(e, 'category'));
priceListElem.addEventListener('click', (e) => handleFilterClick(e, 'price'));
paginationContainerElem.addEventListener('click', (e) => handleFilterClick(e, 'page'));

// add to cart functionality
const addToCart = async (event) => {
    const btn = event.target.closest('.btn-cart');
    if (!btn) return;

    event.preventDefault();

    let productId = btn.dataset.id;
    let obj = {
        productId,
        quantity: 1
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
        showToast(status.toLowerCase(), status, message, 3000);
        const cartWrap = document.querySelector('.cart-wrap');
        let cartCount = document.querySelector('.cart-count');

        if (!cartCount) {
            cartWrap.insertAdjacentHTML('beforeend', '<span class="cart-count"></span>');
            cartCount = document.querySelector('.cart-count');
        }
        cartCount.textContent = data.cartCount;
    } else if (status.toLowerCase() === "warning") {
        showToast(status.toLowerCase(), status, message, 3000);
    } else {
        showToast(status.toLowerCase(), status, message, 2000);
        setTimeout(() => { location.pathname = '/waggy/auth/login' }, 2000);
    }
}

productsContainer.addEventListener('click', e => addToCart(e));