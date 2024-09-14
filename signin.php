<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Smail</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #3d3d3d;
        }

        .container {
            width: 100%;
            display: flex;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            width: 375px;
            height: 450px;
            margin: auto;
            position: relative;
            padding: 40px;
            border: 1px solid #dadce0;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 1px 1px 13px 1px #b7b7b7;
        }

        .form-group {
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 12px 10px;
            box-sizing: border-box;
            border-radius: 4px;
            border: 1px solid #d0d0d0;
            background-color: transparent;
            font-size: 16px;
        }

        .form-group label {
            position: absolute;
            left: 10px;
            top: 9px;
            color: #a5a5a5;
            font-size: 16px;
            padding: 0px 4px;
            background-color: white;
            transition-property: transform;
            transition-duration: 500ms;
            z-index: -1;
        }

        .form-link {
            padding: 4px 0px;
        }

        .form-link a {
            color: #1a73e8;
            font-weight: 500;
        }

        .form-link label {
            color: #5f6368;
            font-size: 14px;
        }

        #email:focus+label {
            transform: translate3d(0, -100%, 0);
            z-index: 1;
            color: #1a73e8;
        }

        #password:focus+label {
            transform: translate3d(0, -100%, 0);
            z-index: 1;
            color: #1a73e8;
        }

        .password-fixed {
            transform: translate3d(0, -100%, 0);
            z-index: 1 !important;
            color: #1a73e8;
        }

        .form-header {
            text-align: center;
        }

        .form-header h2 {
            margin: 0;
            font-weight: 600;
        }

        .form-header h4 {
            margin: 10px 0px 15px;
            font-weight: 600;
        }

        #logo {
            width: 30%;
            margin: 0 auto;
        }

        .btn {
            float: right;
            color: white;
            background: #1a73e8;
            border: 0;
            padding: 8px 22px;
            border-radius: 4px;
        }

        #eye-icon {
            position: absolute;
            right: 12px;
            top: 10px;
            font-size: 22px;
            cursor: pointer;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form id="login-form" action="https://smail.syathiby.id:2096/login" method="POST">
                <div id="email-box">
                    <div class="form-header">
                        <img id="logo" src="assets/imgs/webs/syathiby-mail-login.webp" alt="">
                        <h2></h2>
                        <h4 style="margin-top: 20px;">Welcome to syathiby mail</h4>
                    </div>
                    <div class="form-group">
                        <input type="text" id="email" name="user">
                        <label class="form-control-placeholder" for="name">Email</label>
                    </div>
                    <div class="form-link">
                        <label><a href="">Forgot Email?</a></label>
                    </div>
                    <br />
                    <br />
                    <div class="form-link">
                        <label>Not your computer? Use Guest mode to sign in privately.</label>
                        <label><a href="">Learn More</a></label>
                    </div>
                    <br />
                    <br />
                    <div class="form-link">
                        <label><a href="">Create Account</a></label>
                        <button type="button" class="btn" onclick="showPasswordBox()">Next</button>
                    </div>
                </div>

                <div id="password-box">
                    <div class="form-header">
                        <img id="logo" src="assets/imgs/webs/syathiby-mail-login.webp" alt="">
                        <h3></h3>
                        <h4>Continue with <span id='entered-email'></span></h4>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="pass" onfocus="this.value = this.value;" onfocusout="onPasswordFocus()">
                        <label class="form-control-placeholder" id="password-label" for="name">Enter Your Password</label>
                        <svg id="eye-icon" onclick="onEyeClick()" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        </svg>
                    </div>
                    <br />
                    <br />
                    <div class="form-link">
                        <label><a>Forgot password?</a></label>
                        <button type="submit" class="btn">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('password-box').style.display = 'none';

        function showPasswordBox() {
            var email = document.getElementById('email').value;
            document.getElementById('email-box').style.display = 'none';
            document.getElementById('password-box').style.display = 'block';
            document.getElementById('entered-email').innerHTML = email;
        }

        function onEyeClick() {
            let eyeIcon = document.getElementById('eye-icon');
            let password = document.getElementById('password');

            if (password.value.length > 0) {
                password.focus();
                if (eyeIcon.classList.contains('feather-eye-off')) {
                    eyeIcon.classList.remove('feather-eye-off');
                    eyeIcon.classList.add('feather-eye');
                    password.setAttribute('type', 'text');
                } else {
                    eyeIcon.classList.remove('feather-eye');
                    eyeIcon.classList.add('feather-eye-off');
                    password.setAttribute('type', 'password');
                }
            }
        }

        function onPasswordFocus() {
            let password = document.getElementById('password');
            if (password.value.length > 0) {
                document.getElementById('password-label').classList.add('password-fixed');
            } else {
                document.getElementById('password-label').classList.remove('password-fixed');
            }
        }
    </script>
</body>

</html>