<?php
session_start();

if (isset($_SESSION['account_role']) && ($_SESSION['account_role'] == 'admin_ikhwan' || $_SESSION['account_role'] == 'admin_akhwat' || $_SESSION['account_role'] == 'root')) {
    header('Location: ../src/dashboard.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/creatorbe.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(360deg, var(--syathiby-color-primary) 0%, var(--syathiby-color-secondary) 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <h2>Admin Login</h2>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <form id="loginForm" style="margin-top: 10px;" action="signin_process.php" method="post">
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button style="margin-top: 20px" type="submit">Sign In</button>
        </form>
        <p style="text-align: center;">Don't have an account? <span><a href="../"
                    style="text-decoration: none; color: var(--syathiby-color-green-main)"><b>Sign Up</b></a></span>
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                // You can add additional validation here if needed
                form.submit(); // Manually submit the form
            });
        });
    </script>
</body>

</html>