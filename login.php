<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EBRGY | Login</title>

    <link rel="stylesheet" href="static/login.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.22.1/jquery.validate.min.js" integrity="sha512-qu7dMuIm2f0KcKZ3BOoP4c+Hn+r4E8PbD2Ro4rmKsOyheCxcwhzQpf6SojA76dn+owqfANzfTFUTkGA+HpHjOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <div class="container" id="container">

        <div class="form-box login">
            <form id="loginForm">
                <h1>Login</h1>

                <div class="input-box">
                    <input type="text" id="loginUsername" name="loginUsername" placeholder="Username">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="input-box">
                    <input type="password" id="loginPassword" name="loginPassword" placeholder="Password">
                    <i class="fa-solid fa-lock"></i>
                </div>

                <div class="forgot-link">
                    <a href="#" id="forgotPassword">Forgot Password?</a>
                </div>

                <button type="submit" class="btn">Login</button>

                <p>or login with social platforms</p>

                <div class="social-icons">
                    <a href="#" aria-label="Google"><i class="fa-brands fa-google"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </form>
        </div>

        <div class="toggle-box">

            <div class="toggle-panel toggle-left">

                <h1>Hello, Welcome!</h1>

                <p>Don't have an account?</p>

                <button type="button" class="btn register-btn">
                    Register
                </button>

            </div>

        </div>

    </div>

    <script>
        $(document).ready(function(){

            $("#loginForm").validate({
                rules: {
                    loginUsername: {
                        required: true,
                        minlength: 8
                    },
                    loginPassword: {
                        required: true,
                        minlength: 8
                    }
                },
                messages: {
                    loginUsername: {
                        required: "Please enter your username.",
                        minlength: "Username must be at least 8 characters long."
                    },
                    loginPassword: {
                        required: "Please enter your password.",
                        minlength: "Password must be at least 8 characters long."
                    }
                }
            });

        });
    </script>

    <script src="static/login.js"></script>

</body>
</html>