$(document).ready(function () {

    // Instead of toggling in place, this button sends the user to register.html
    $('.register-btn').on('click', function () {
        window.location.href = 'register.html';
    });

    // Clear a field's error state as soon as the user starts typing again
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

        // Reset previous error state
        $('.error-message').text('');
        $('.input-box input').removeClass('input-error');

        // Username validation
        if (username === '') {
            $('#loginUsernameError').text('Username is required.');
            $username.addClass('input-error');
            isValid = false;
        }

        // Password validation
        if (password === '') {
            $('#loginPasswordError').text('Password is required.');
            $password.addClass('input-error');
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        // Validation passed — check credentials against localStorage
        const users = JSON.parse(localStorage.getItem('ebrgy_users')) || [];

        const matchedUser = users.find(
            u => u.username === username && u.password === password
        );

        if (matchedUser) {
            localStorage.setItem('currentUser', JSON.stringify(matchedUser));
            window.location.href = 'landingpage.html';
        } else {
            $('#loginPasswordError').text('Invalid username or password. Please register first!');
            $password.addClass('input-error');
        }
    });

});
