$(document).ready(function () {

    // Instead of toggling in place, this button sends the user to login.html
    $('.login-btn').on('click', function () {
        window.location.href = 'login.html';
    });

    // Clear a field's error state as soon as the user starts typing again
    $('#registerUsername, #registerEmail, #registerPassword').on('input', function () {
        $(this).removeClass('input-error');
        $('#' + $(this).attr('id') + 'Error').text('');
    });

    // Simple, standard email pattern
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    $('#registerForm').on('submit', function (e) {
        e.preventDefault();

        let isValid = true;

        const $username = $('#registerUsername');
        const $email = $('#registerEmail');
        const $password = $('#registerPassword');

        const username = $username.val().trim();
        const email = $email.val().trim();
        const password = $password.val();

        // Reset previous error state
        $('.error-message').text('');
        $('.input-box input').removeClass('input-error');

        // Username validation
        if (username === '') {
            $('#registerUsernameError').text('Username is required.');
            $username.addClass('input-error');
            isValid = false;
        } else if (username.length < 3) {
            $('#registerUsernameError').text('Username must be at least 3 characters.');
            $username.addClass('input-error');
            isValid = false;
        }

        // Email validation
        if (email === '') {
            $('#registerEmailError').text('Email is required.');
            $email.addClass('input-error');
            isValid = false;
        } else if (!emailPattern.test(email)) {
            $('#registerEmailError').text('Please enter a valid email address.');
            $email.addClass('input-error');
            isValid = false;
        }

        // Password validation
        if (password === '') {
            $('#registerPasswordError').text('Password is required.');
            $password.addClass('input-error');
            isValid = false;
        } else if (password.length < 8) {
            $('#registerPasswordError').text('Password must be at least 8 characters.');
            $password.addClass('input-error');
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        // Validation passed — check for an existing user, then save
        const users = JSON.parse(localStorage.getItem('ebrgy_users')) || [];

        const userExists = users.some(u => u.username === username || u.email === email);

        if (userExists) {
            $('#registerUsernameError').text('Username or email already exists.');
            $username.addClass('input-error');
            return;
        }

        users.push({ username, email, password });
        localStorage.setItem('ebrgy_users', JSON.stringify(users));

        $('#registerForm')[0].reset();
        window.location.href = 'login.html';
    });

});
