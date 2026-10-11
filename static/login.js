// Register button -> go to the registration page.
document.addEventListener('DOMContentLoaded', function () {
    var registerBtn = document.querySelector('.register-btn');
    if (registerBtn) {
        registerBtn.addEventListener('click', function () {
            window.location.href = 'register.php';
        });
    }
});
