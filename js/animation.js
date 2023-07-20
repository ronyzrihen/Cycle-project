document.addEventListener('DOMContentLoaded', () => {
    const icons = document.querySelectorAll('.icon-list i');
    icons.forEach((icon, index) => {
        icon.classList.add('move-' + (index + 1));
    });
});