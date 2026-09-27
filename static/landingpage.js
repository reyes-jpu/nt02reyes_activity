document.addEventListener('DOMContentLoaded', () => {
    const currentUserData = localStorage.getItem('currentUser');

    if (!currentUserData) {
        alert('Please login first to access the dashboard.');
        window.location.href = 'auth.html';
        return;
    }

    const currentUser = JSON.parse(currentUserData);

    const placeholderNames = document.querySelectorAll('.placeholder-name, .account-name');
    placeholderNames.forEach(el => {
        el.textContent = currentUser.username;
    });

    const topbarDate = document.getElementById('topbarDate');
    if (topbarDate) {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        topbarDate.textContent = new Date().toLocaleDateString('en-US', options);
    }

    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            if (sidebarBackdrop) sidebarBackdrop.classList.toggle('show');
        });

        if (sidebarBackdrop) {
            sidebarBackdrop.addEventListener('click', () => {
                sidebar.classList.remove('show');
                sidebarBackdrop.classList.remove('show');
            });
        }
    }

    const accountCard = document.querySelector('.account-card');
    if (accountCard) {
        accountCard.addEventListener('click', () => {
            const confirmLogout = confirm('Do you want to log out?');
            if (confirmLogout) {
                localStorage.removeItem('currentUser');
                window.location.href = 'auth.html';
            }
        });
    }
});