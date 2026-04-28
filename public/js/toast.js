// Toast Notification System

if (!document.querySelector('#toast-container')) {
    const container = document.createElement('div');
    container.id = 'toast-container';
    document.body.appendChild(container);
}

const icons = {
    success: '<i class="fa-solid fa-circle-check" style="color:#28a745"></i>',
    warning: '<i class="fa-solid fa-triangle-exclamation" style="color:#e4a400"></i>',
    info: '<i class="fa-solid fa-circle-info" style="color:#17a2b8"></i>',
    error: '<i class="fa-solid fa-circle-exclamation" style="color:#e74c3c"></i>',
};

function showToast(type = 'info', title = '', message = '', duration = 3000) {
    const container = document.querySelector('#toast-container');

    const toast = document.createElement('div');
    toast.classList.add('toast', type);

    toast.innerHTML = `
        <div class="toast-icon">${icons[type]}</div>
            <div class="toast-body">
                <div class="toast-title">${title}</div>
                <div class="toast-message">${message}</div>
            </div>
        <button class="toast-close">✕</button>
    `;

    container.appendChild(toast);

    toast.querySelector('.toast-close').addEventListener('click', () => dismissToast(toast));

    setTimeout(() => dismissToast(toast), duration);
}

function dismissToast(toast) {
    toast.classList.add('hide');
    setTimeout(() => toast.remove(), 500);
}

if (window.toastData) {

    let { type, message } = window.toastData;

    if (!document.querySelector('.toast')) {
        showToast(type, type.toUpperCase(), message, 2000);
    }

}