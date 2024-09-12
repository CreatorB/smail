<?php
require '../inc/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $koneksi->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // if ($user && password_verify($password, $user['password'])) {
    if ($user && $password == $user['password']) {
        $_SESSION['account_id'] = $user['id'];
        $_SESSION['account_email'] = $user['email'];
        $_SESSION['account_name'] = $user['name'];
        $_SESSION['account_wa'] = $user['wa'];
        $_SESSION['account_role'] = $user['role'];
        $_SESSION['account_confirmed'] = $user['confirmed'];
        $_SESSION['message'] = "Login successful!";
        header('Location: dashboard');
        exit();
    } else {
        $_SESSION['message'] = "Invalid email or password.";
        header('Location: signin');
        exit();
    }
} else {
    header('Location: signin');
    exit();
}