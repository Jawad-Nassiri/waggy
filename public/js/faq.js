const faqContainer = document.querySelector('.faq-container');

faqContainer.addEventListener('click', (e) => {
    const faqQuestion = e.target.closest('.faq-question');
    if (!faqQuestion) return;

    const arrowDown = faqQuestion.querySelector('i');
    const faqAnswer = faqQuestion.nextElementSibling;

    faqAnswer.classList.toggle('show');

    faqQuestion.classList.toggle('active')
});
