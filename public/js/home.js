
// home banner slider

const slidersElem = document.querySelectorAll('.slide');
const dotsBtn = document.querySelectorAll('.dot');
const sliderDotsContainer = document.querySelector('.slider-dots');

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



