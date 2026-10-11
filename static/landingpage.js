document.addEventListener('DOMContentLoaded', () => {

    // Mobile sidebar toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');

    const closeSidebar = () => {
        if (!sidebar) return;
        sidebar.classList.remove('show');
        if (sidebarBackdrop) sidebarBackdrop.classList.remove('show');
        if (menuToggle) menuToggle.setAttribute('aria-expanded', 'false');
    };

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            const open = sidebar.classList.toggle('show');
            if (sidebarBackdrop) sidebarBackdrop.classList.toggle('show', open);
            menuToggle.setAttribute('aria-expanded', String(open));
        });

        if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', closeSidebar);

        // Close the menu after tapping a link (mobile)
        sidebar.querySelectorAll('.side-nav .nav-link').forEach(link => {
            link.addEventListener('click', closeSidebar);
        });
    }

    // Account card -> confirm, then PHP logout.php destroys the session
    const accountCard = document.getElementById('accountCard');
    if (accountCard) {
        accountCard.addEventListener('click', () => {
            if (confirm('Do you want to log out?')) {
                window.location.href = 'logout.php';
            }
        });
    }
});
