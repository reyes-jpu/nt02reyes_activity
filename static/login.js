$(document).ready(function () {

    $('.register-btn').on('click', function () {
        window.location.href = 'register.html';
    });

    $('#loginUsername, #loginPassword').on('input', function () {
        $(this).removeClass('input-error');
        $('#' + $(this).attr('id') + 'Error').text('');
    });

    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        let isValid = true;

        const $username = $('#loginUsername');
        const $password = $('#loginPassword');

        const username = $username.val().trim();
        const password = $password.val();

        $('.error-message').text('');
        $('.input-box input').removeClass('input-error');

        if (username === '') {
            $('#loginUsernameError').text('Username is required.');
            $username.addClass('input-error');
            isValid = false;
        }

        if (password === '') {
            $('#loginPasswordError').text('Password is required.');
            $password.addClass('input-error');
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        const users = JSON.parse(localStorage.getItem('ebrgy_users')) || [];

        const matchedUser = users.find(
            u => u.username === username && u.password === password
        );

        if (matchedUser) {
            localStorage.setItem('currentUser', JSON.stringify(matchedUser));
            window.location.href = 'index.html';
        } else {
            $('#loginPasswordError').text('Invalid username or password. Please register first!');
            $password.addClass('input-error');
        }
    });

});
