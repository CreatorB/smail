<?php
include "inc/config.php";
$query = "SELECT setting_value FROM settings WHERE setting_name = 'mode_maintenance'";
$result = $koneksi->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $maintenance_mode = $row['setting_value'];

    if ($maintenance_mode == 1) {
        include "src/maintenance.php";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Syathiby Mail</title>
    <meta name="description" content="Create your mail without phone verification drama.">
    <meta name="keywords"
        content="Syathiby Mail, email registration, no phone verification, create email, Syathiby, webmail">
    <meta property="og:title" content="Syathiby Mail - Create your mail without phone verification drama">
    <meta property="og:description" content="Create your mail without phone verification drama.">
    <meta property="og:image" content="assets/imgs/webs/holo-mail.png">
    <meta property="og:url" content='<?php echo BASE_URL ?>'>
    <meta property="og:type" content="website">
    <link href="<?php echo PATH_ROOT_CSS_CREATORBE; ?>" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/webs/holo-mail.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body,
        ul,
        ol,
        li,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: ;
            font-family: ;
        }

        a {
            text-decoration: none;
            color: #1155CC
        }

        a:hover {
            text-decoration: underline;
        }

        #header_area {
            background: #f1f1f1 none repeat scroll 0 0;
            padding: 15px 40px;
            border-bottom: 1px solid #e5e5e5;
        }

        #header_area:after {
            content: "";
            display: block;
            clear: both;
        }

        #content_area {
            background: #fff;
            flex-grow: 1;
        }

        #content_area:after {
            display: block;
            content: "";
            clear: both;
        }

        .glogo {
            float: left;
            overflow: hidden;
        }

        .glogo img {
            width: 112px;
            height: 36px;
        }

        .singup {
            float: right;
            overflow: hidden;
            margin-top: 5px;
        }

        .signinbutton {
            background: rgba(0, 0, 0, 0) linear-gradient(#4d90fd, #4787ee) repeat scroll 0 0;
            border: 1px solid #2f5bb7;
            border-radius: 2px;
            color: #ffffff;
            font-size: 13px;
            font-weight: 500;
            padding: 4px 10px;
            cursor: pointer;
        }

        .signinbutton:hover {
            background: linear-gradient(#4D90FE, #357AE8)
        }

        .signupbutton {
            background: rgba(0, 0, 0, 0) linear-gradient(#4d90fd, #4787ee) repeat scroll 0 0;
            border: 1px solid #2f5bb7;
            border-radius: 2px;
            color: #ffffff;
            font-size: 13px;
            font-weight: 500;
            padding: 4px 10px;
            cursor: pointer;
            width: auto;
        }

        .signupbutton:hover {
            background: linear-gradient(#4D90FE, #357AE8)
        }

        .center_content {
            margin: 30px auto;
            width: 70%;
        }

        .center_content h1 {
            color: #555;
            font-family: "Open Sans", arial;
            font-size: 38px;
            font-weight: 300;
            margin-bottom: 50px;
            text-align: center;
        }

        .left_content {
            float: left;
            overflow: hidden;
            width: 50%;
            text-align: center;
        }

        .top_div {}

        .top_div h3,
        .buttom_div h3 {
            color: #737373;
            font-family: 'Open Sans', arial;
            font-size: 20px;
            font-weight: 300;
            margin-bottom: 15px;
            text-align: center;
        }

        .top_div p,
        .buttom_div p {
            color: #737373;
            font-family: 'Open Sans', arial;
            font-size: 13px;
            /* margin-bottom: 40px; */
            text-align: center;
        }

        .top_div img,
        .buttom_div img {
            width: 50%;
        }

        .buttom_div {
            margin-top: 10px;
        }

        .right_content {
            float: left;
            overflow: hidden;
            width: 50%;
        }

        .google_sign_up_form {
            float: right;
            overflow: hidden;
            width: 360px;
            margin: auto;
        }

        .google_form {
            background: #f1f1f1 none repeat scroll 0 0;
            padding: 25px;
            margin-bottom: 20px;
        }

        .google_form label {
            color: #222222;
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            width: 100%;
            font-size: 16px;
        }

        .google_form input[type="text"],
        .google_form input[type="number"],
        .google_form input[type="password"] {
            border: 1px solid #d9d9d9;
            margin-bottom: 20px;
            padding: 7px 5px;
        }

        .google_form input[type="text"]:hover,
        .google_form input[type="number"]:hover,
        .google_form input[type="password"]:hover {
            border: 1px solid #B9B9B9;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset;
        }

        .name {
            overflow: hidden;
        }

        .hafname1 {
            display: inline-block;
            float: left;
            overflow: hidden;
            width: 45%;
        }

        .hafname2 {
            float: right;
            overflow: hidden;
            width: 45%;
        }

        .full_width_area {}

        .full {
            display: block;
            width: 96%;
        }

        .birthday {
            overflow: hidden;
        }

        .monty {
            background: #f3f3f3 none repeat scroll 0 0;
            border: 1px solid #d9d9d9;
            padding: 6px 20px;
        }

        .monty:hover {
            box-shadow: 0 0 6px #ddd
        }

        .date {
            width: 45px;
        }

        .year {
            width: 112px;
        }

        .gender_and_other {}

        .gender_select {
            background: #f3f3f3 none repeat scroll 0 0;
            border: 1px solid #d9d9d9;
            margin-bottom: 15px;
            padding: 6px 20px;
            width: 100%;
        }

        #flag {
            background: #fff none repeat scroll 0 0;
            border: 1px solid #ddd;
            padding: 6px 0;
        }

        #flag:hover {
            background: #f1f1f1;
            cursor: pointer;
        }

        .mobile {
            overflow: hidden;
        }

        .phone {
            display: inline-block;
            position: relative;
            right: 5px;
            width: 77%;
        }

        .capchea {
            overflow: hidden;
        }

        #checkboxs,
        #agreebox {
            float: left;
            margin-right: 10px;
            overflow: hidden;
        }

        .google_form .checkbox .checkclass {
            color: #222222;
            font-size: 14px;
            font-weight: normal;
            width: 90%;
        }

        .images_area {
            background: #fff none repeat scroll 0 0;
            border: 1px solid #e5e5e5;
        }

        .images_area img {
            width: 100%;
        }

        .under_hrline {
            background: #e5e5e5 none repeat scroll 0 0;
            border: medium none;
            height: 1px;
            margin-top: -2px;
            width: 100%;
        }

        .images_box {
            padding: 10px;
            padding-bottom: 5px;
        }

        .images_box .logo_box {
            display: inline-block;
        }

        .images_box .logo_box ul {
            list-style: none;
            text-align: right;
        }

        .images_box .logo_box ul li {
            display: inline-block;
        }

        .images_box .logo_box ul li img {
            width: 20px;
            height: 20px;
            display: inline-block;
            cursor: pointer;
        }

        .images_box .logo_box ul li img:hover {}

        #cap {
            width: 70%;
        }

        .locationss {
            margin-top: 15px;
        }

        #location {
            background: #f3f3f3 none repeat scroll 0 0;
            border: 1px solid #ddd;
        }

        #location:hover {
            box-shadow: 0 0 5px #ddd;
        }

        .checkbox {
            margin-top: 22px;
        }

        .nextbutton {
            /* float: right; */
            margin-top: 15px;
        }

        .learn_more {
            color: #999999;
            font-size: 13px;
            text-align: center;
            margin-top: 8px;
        }

        .logo_box {}

        .left_box {
            float: left;
            overflow: hidden;
        }

        .left_box ul {
            list-style: outside none none;
            text-align: left;
        }

        .left_box ul li {
            display: inline-block;
        }

        .left_box ul li a {
            color: #333333;
            display: inline-block;
            font-size: 12px;
            padding: 8px;
        }

        .left_box ul li a:hover {}

        .right_box {
            float: right;
            overflow: hidden;
        }

        .right_box img {
            position: relative;
            top: 5px;
        }

        /* responsive css */

        @media all and (max-width: 1032px) {
            .left_content {
                display: block;
                width: 50%;
                margin-bottom: 20px;
            }

            .right_content {
                float: none;
                margin: auto;
                width: 50%;
            }

            .center_content {
                width: 100%;
            }

            .google_sign_up_form {
                width: 80%;
                margin: auto
            }

            .hafname1 {
                width: 70%;
            }

            .hafname2 {
                width: 70%;
                float: left;
            }
        }

        @media all and (max-width: 570px) {
            .center_content h1 {
                font-size: 30px;
            }

            .google_sign_up_form {
                width: 95%;
                margin: auto
            }

            .left_content {
                display: block;
                width: 100%;
                margin-bottom: 20px;
            }

            .right_content {
                width: 100%;
            }

            .google_sign_up_form {
                width: 100%;
                margin: auto;
            }

            .hafname1 {
                width: 95%;
            }

            .hafname2 {
                width: 95%;
                float: left;
            }

        }

        @media all and (max-width: 370px) {
            .google_sign_up_form {
                width: 80%;
                margin: auto
            }

            .center_content {
                width: 100%;
            }

            .right_content {
                width: 100%;
            }

            .hafname1 {
                width: 95%;
            }

            .hafname2 {
                width: 95%;
                float: left;
            }
        }

        /* Loading spinner styles */
        .loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1000;
        }

        .loading img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
        }
    </style>
    <script type="application/ld+json"> {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "Syathiby Mail",
            "url": "https://smail.syathiby.id",
            "description": "Create your Syathiby Mail without phone verification drama.",
            "image": "https://smail.syathiby.id/path/to/your/image.jpg",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://smail.syathiby.id/search?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="header_area">
        <div class="glogo">
            <img src="assets/imgs/webs/syathiby-mail-logo.webp" alt="">
        </div>
        <div class="singup">
            <button class="signinbutton" onclick="window.location.href='signin.php'">Sign In</button>
        </div>
    </div>
    <div id="content_area">
        <div class="center_content">
            <h1>Create Your Mail Without Phone Verification Drama</h1>
            <!-- begin left sidbar -->
            <div class="left_content">
                <div class="top_div">
                    <h3>Our Mission</h3>
                    <p>Simplify email registration without the hassle of phone verification. Unfortunately, this email
                        service is currently only available for the Mahad Syathiby community.</p>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/39/World_map_clip_art.svg" alt="">
                </div>
                <div class="buttom_div">
                    <h3>Special Thanks</h3>
                    <p>To Allah, walhamdulillah, Who predestined every destiny is beautiful and thank you to all the
                        syathiby 2024 students who experienced this problem so that Allah made it easy to build this
                        solver, it also <a href="https://github.com/syathiby/smail"
                            target="_blank"><b>OPENSOURCE</b></a>.</p>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9c/DiMoT_Demo_Probability.svg" alt="">
                </div>
            </div> <!-- end left side var -->
            <div class="right_content"> <!-- begin right sidebar -->
                <div class="google_sign_up_form">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo '<div class="alert">' . $_SESSION['message'] . '</div>';
                        unset($_SESSION['message']);
                    }
                    ?>
                    <form id="signupForm" action="src/signup_process.php" class="google_form" method="post">
                        <div class="name">
                            <label for="first_name">Name</label>
                            <input type="text" name="first_name" id="first_name" class="hafname1" placeholder="First"
                                required>
                            <input type="text" name="last_name" id="last_name" class="hafname2" placeholder="Last"
                                required>
                        </div>
                        <div class="full_width_area">
                            <label for="email"> Choose your mail </label>
                            <input type="text" name="email" id="email" class="full"
                                placeholder="example@smail.syathiby.id" value="@smail.syathiby.id" required>
                            <div id="email_error" style="color: red;"></div>
                            <label for="password"> Create a password </label>
                            <input type="password" name="password" id="password" class="full" required>
                            <label for="password_confirm"> Confirm your password </label>
                            <input style="margin-bottom: 3px" type="password" name="password_confirm"
                                id="password_confirm" class="full" required>
                            <div>
                                <input type="checkbox" id="showPassword">show password
                            </div>
                            <div id="password_error" style="color: red; margin-bottom: 10px;"></div>
                        </div>
                        <div class="gender_and_other">
                            <label for="role">Account type</label>
                            <select name="role" id="role" class="gender_select">
                                <option value="santri_ikhwan" selected>Santri Ikhwan</option>
                                <option value="santri_akhwat">Santri Akhwat</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                        <div class="gender_and_other">
                            <label for="class">Class</label>
                            <select name="class" id="class" class="gender_select">
                                <?php
                                $startNumber = 7;
                                $endNumber = 12;
                                $repetitions = 2;

                                for ($number = $startNumber; $number <= $endNumber; $number++) {
                                    for ($i = 0; $i < $repetitions; $i++) {
                                        $optionValue = $number . chr(65 + $i);
                                        echo "<option value=\"$optionValue\">$optionValue</option>\n";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mobile">
                            <label for="flag">Whatsapp number (optional)</label>
                            <select name="" id="flag">
                                <option value="+62">+62</option>
                            </select>
                            <input type="number" name="wa" id="wa" class="phone" placeholder="85156081434">
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="agree" id="agreebox" required>
                            <label for="agreebox" class="checkclass"> I agree to the Syathiby <a href="">Terms of
                                    Service</a> and <a href="">Privacy Policy</a> </label>
                        </div>
                        <button type="submit" class="nextbutton signupbutton">Sign Up</button>
                    </form>
                </div>
            </div> <!-- end right sidbar-->
        </div> <!-- end center div-->
    </div> <!-- end content area-->
    <?php include "src/footer.php" ?>
    <!-- Loading spinner -->
    <div class="loading">
        <img src="assets/imgs/webs/syathiby-loading-dualball.gif" alt="Loading...">
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('signupForm');
            const showPasswordCheckbox = document.getElementById('showPassword');
            const passwordInput = document.getElementById('password');
            const passwordConfirmInput = document.getElementById('password_confirm');
            const roleSelect = document.getElementById('role');
            const classSelect = document.getElementById('class').parentElement;

            showPasswordCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    passwordInput.type = 'text';
                    passwordConfirmInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                    passwordConfirmInput.type = 'password';
                }
            });

            function validateEmail() {
                const email = document.getElementById("email").value;
                const emailError = document.getElementById("email_error");
                emailError.textContent = "";

                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if (!email.match(emailPattern)) {
                    emailError.textContent = "Please enter a valid email address.";
                    return false;
                }
                return true;
            }

            function validatePassword() {
                const password = document.getElementById("password").value;
                const passwordConfirm = document.getElementById("password_confirm").value;
                const passwordError = document.getElementById("password_error");

                passwordError.textContent = "";

                var passwordStrength = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{10,}$/;
                if (!password.match(passwordStrength)) {
                    passwordError.textContent = "Password must be at least 10 characters long and contain at least one uppercase letter, one lowercase letter, and one number.";
                    return false;
                }

                if (password !== passwordConfirm) {
                    passwordError.textContent = "Passwords do not match.";
                    return false;
                }

                return true;
            }

            form.addEventListener('submit', function (event) {
                // if (!validateEmail() || !validatePassword()) {
                if (!validateEmail()) {
                    event.preventDefault();
                }
            });

            function toggleClassSelect() {
                if (roleSelect.value === 'staff') {
                    classSelect.style.display = 'none';
                } else {
                    classSelect.style.display = 'block';
                }
            }
            toggleClassSelect();
            roleSelect.addEventListener('change', toggleClassSelect);
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#signupForm').on('submit', function (event) {
                event.preventDefault();

                var password = $('#password').val();
                var passwordConfirm = $('#password_confirm').val();

                if (password !== passwordConfirm) {
                    $('#password_error').text("Passwords do not match.");
                    return;
                } else {
                    $('#password_error').text("");
                }
                $('.loading').show();
                $.ajax({
                    url: 'src/validate_password.php',
                    type: 'POST',
                    data: { password: password },
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.valid) {
                            $('#password_error').text("");
                            $('#signupForm')[0].submit();
                        } else {
                            $('#password_error').text("Password must contain at least one uppercase letter, one lowercase letter, one number and one special character.");
                        }
                    },
                    error: function () {
                        $('#password_error').text("An error occurred while validating the password.");
                    },
                    complete: function () {
                        $('.loading').hide();
                    }
                });
            });
        });
    </script>
</body>

</html>