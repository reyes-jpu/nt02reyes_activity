// Login button -> go back to the login page.
document.addEventListener('DOMContentLoaded', function () {
    var loginBtn = document.querySelector('.login-btn');
    if (loginBtn) {
        loginBtn.addEventListener('click', function () {
            window.location.href = 'login.php';
        });
    }
});
