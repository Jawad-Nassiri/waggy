
// home banner slider

const slidersElem = document.querySelectorAll('.slide');
const dotsBtn = document.querySelectorAll('.dot');
const sliderDotsContainer = document.querySelector('.slider-dots');
const productSlider = document.querySelector('.products-slider');
const productsContainer = document.querySelector('.product-container');

let current = 0;

const goToSlide = (index) => {

    slidersElem[current].classList.remove('active');
    dotsBtn[current].classList.remove('active');

    current = index;

    slidersElem[current].classList.add('active');
    dotsBtn[current].classList.add('active');

}


sliderDotsContainer.addEventListener('click', (event) => {
    let targetBtn = event.target;

    if (!targetBtn.classList.contains('dot')) return;
    let index = [...dotsBtn].indexOf(targetBtn);
    goToSlide(index);
});


setInterval(() => {
    goToSlide((current + 1) % slidersElem.length);
}, 3000)


// hoodies slider

const sliderElem = document.querySelector('.products-slider');
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');
const productCards = document.querySelectorAll('.hoodie .product-card');


let productCardWidth = document.querySelector('.product-card').offsetWidth + 20;
let totalItems = productCards.length;
let visibleItems = Math.round(sliderElem.offsetWidth / productCardWidth);
let maxIndex = totalItems - visibleItems;
let currentIndex = 0;

window.addEventListener('resize', function () {
    productCardWidth = document.querySelector('.product-card').offsetWidth + 20;
    visibleItems = Math.round(sliderElem.offsetWidth / productCardWidth);
    maxIndex = totalItems - visibleItems;
});


nextBtn.addEventListener('click', () => {
    currentIndex++; 

    if (currentIndex > maxIndex) {
        currentIndex = 0;
        sliderElem.scrollLeft = 0;
    } else {
        sliderElem.scrollLeft = productCardWidth * currentIndex;
    }
});

prevBtn.addEventListener('click', () => {
    currentIndex--;

    if (currentIndex < 0) {
        currentIndex = maxIndex;
        sliderElem.scrollLeft = productCardWidth * maxIndex;
    } else {
        sliderElem.scrollLeft = productCardWidth * currentIndex;
    }
});

sliderElem.addEventListener('scroll', () => {
    currentIndex = Math.round(sliderElem.scrollLeft / productCardWidth);
});


// add to cart functionality 
productSlider.addEventListener('click', e => addToCart(e));
productsContainer.addEventListener('click', e => addToCart(e));