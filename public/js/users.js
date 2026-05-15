// user deletion functionality
const doc = document;
const userTable = doc.querySelector('.users-table');
const addUserForm = doc.querySelector('#add-user-form');
const errorNameElem = doc.querySelector('.form-error.name');
const errorEmailElem = doc.querySelector('.form-error.email');
const errorPasswordElem = doc.querySelector('.form-error.password');
const eyeIcon = doc.querySelector('#eye-icon')


if (eyeIcon) {
    eyeIcon.addEventListener('click', () => {
        let input = doc.getElementById(eyeIcon.dataset.target);
        input.type = input.type === 'password' ? 'text' : 'password';

        eyeIcon.classList.toggle('fa-eye-slash');
        eyeIcon.classList.toggle('fa-eye');
    });
}


if (userTable) userTable.addEventListener('click', e => deleteUser(e));

const deleteUser = async (e) => {
    let deleteBtn = e.target.closest('.delete-btn');
    if (!deleteBtn) return;

    let userId = deleteBtn.dataset.id;

    let res = await fetch('/waggy/admin/users/deleteUser', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ userId })
    })

    let data = await res.json();
    let { status, message } = data;

    if (status.toLowerCase() === 'success') {
        let parentEl = deleteBtn.closest('.table-row');
        parentEl.remove();
        if (!document.querySelector('.toast')) {
            showToast(status.toLowerCase(), status, message, 3000);
        }
    } else {
        if (!document.querySelector('.toast')) {
            showToast(status.toLowerCase(), status, message, 3000);
        }
    }

}

if (window.toastData) {

    let { type, title, message } = window.toastData;

    if (!document.querySelector('.toast')) {
        showToast(type, title, message);
    }

}

if (addUserForm) {
    addUserForm.addEventListener('input', (event) => {
        let input = event.target.closest('input, select');
        if (!input) return;

        let id = input.id || input.name;
        let value = input.value;

        if (id === "name") {
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

            if (value.trim() === "") {
                clearMessage(input, errorEmailElem);
            } else if (!emailRegex.test(value)) {
                showMessage(input, errorEmailElem, "Invalid email address", "#e74c3c");
            } else {
                showMessage(input, errorEmailElem, "Email is valid", "#28a745");
            }
        }

        if (id === "password") {
            if (value.trim() === "") {
                clearMessage(input, errorPasswordElem);
            } else if (value.trim().length < 6) {
                showMessage(input, errorPasswordElem, "Password must be at least 6 characters", "#e74c3c");
            } else {
                showMessage(input, errorPasswordElem, "Password is valid", "#28a745");
            }
        }
    });
}