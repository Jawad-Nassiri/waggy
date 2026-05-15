// user deletion functionality
const doc = document;
const userTable = doc.querySelector('.users-table');

userTable.addEventListener('click', e => deleteUser(e));

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