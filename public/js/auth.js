const doc = document;
const eyeIcons = doc.querySelectorAll('#eye-icon');


// toggle eye icons 
eyeIcons.forEach(eye => {
    eye.addEventListener('click', () => {
        let input = doc.getElementById(eye.dataset.target);
        input.type = input.type === 'password' ? 'text' : 'password';

        eye.classList.toggle('fa-eye-slash');
        eye.classList.toggle('fa-eye');
    })
});


// sign up error handling
const authForm = doc.querySelector('.auth-form');
const errorNameElem = doc.querySelector('.form-error.name');
const errorEmailElem = doc.querySelector('.form-error.email');
const errorPasswordElem = doc.querySelector('.form-error.password');
const errorConfirmPasswordElem = doc.querySelector('.form-error.confirm-password');

// show error\success messages 
const showMessage = (input, errElem, message, color) => {
    input.style.borderColor = color;
    errElem.style.color = color;
    errElem.textContent = message;
};

// clear message 
const clearMessage = (input, errElem) => {
    input.style.borderColor = "";
    errElem.textContent = "";
};

// input fields validation 
authForm.addEventListener('input', (event) => {
    let input = event.target.closest('input');
    if (!input) return;

    let id = input.id;
    let value = input.value;

    if (id === "name") {
        // validate name length
        if (value.trim() === "") {
            clearMessage(input, errorNameElem);
        } else if (value.trim().length < 3) {
            showMessage(input, errorNameElem, "Name must be at least 3 characters", "#e74c3c");
        } else {
            showMessage(input, errorNameElem, "Name is valid", "#28a745");
        }
    }

    if (id === "email") {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // validate email format
        if (value.trim() === "") {
            clearMessage(input, errorEmailElem);
        } else if (!emailRegex.test(value)) {
            showMessage(input, errorEmailElem, "Invalid email address", "#e74c3c");
        } else {
            showMessage(input, errorEmailElem, "Email is valid", "#28a745");
        }
    }

    if (id === "password") {
        // validate password length
        if (value.trim() === "") {
            clearMessage(input, errorPasswordElem);
        } else if (value.trim().length < 6) {
            showMessage(input, errorPasswordElem, "Password must be at least 6 characters", "#e74c3c");
        } else {
            showMessage(input, errorPasswordElem, "Password is valid", "#28a745");
        }
    }

    if (id === "confirm-password") {
        let passwordValue = doc.querySelector('#password').value;

        // validate password match
        if (value.trim() === "") {
            clearMessage(input, errorConfirmPasswordElem);
        } else if (value.trim() !== passwordValue.trim()) {
            showMessage(input, errorConfirmPasswordElem, "Passwords do not match", "#e74c3c");
        } else {
            showMessage(input, errorConfirmPasswordElem, "Password match", "#28a745");
        }
    }
});

// form validation 
function validateForm() {
    let isValid = true;

    const name = doc.querySelector('#name').value.trim();
    const email = doc.querySelector('#email').value.trim();
    const password = doc.querySelector('#password').value.trim();
    const confirmPassword = doc.querySelector('#confirm-password').value.trim();

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


    if (name.length < 3) isValid = false;
    if (!emailRegex.test(email)) isValid = false;
    if (password.length < 6) isValid = false;
    if (password !== confirmPassword) isValid = false;

    return isValid;
}

// submit form if no error detected 
authForm.addEventListener('submit', (e) => {
    if (!validateForm()) {
        e.preventDefault();
        showToast('error', 'Error', 'Please fill all fields!', 2000);
        return;
    }
});