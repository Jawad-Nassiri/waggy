const userIcon = document.querySelector('#user-icon');
const userData = document.querySelector('#user-data');
const navLinks = document.querySelectorAll('.nav-links li a')

// highlight navbar links 
const pathname = location.pathname.split('/').pop();

navLinks.forEach(link => {
    if (link.textContent.trim().toLowerCase() === pathname) {
        link.style.color = '#dead6f';
    }
});


// toggle the user data box

if (userData) {
    userIcon.addEventListener('click', (e) => {
        e.preventDefault();
        userData.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
        if (
            !userData.contains(e.target) &&
            !userIcon.contains(e.target)
        ) {
            userData.classList.remove('active');
        }
    });
}
