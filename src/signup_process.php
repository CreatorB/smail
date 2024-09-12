<?php
include "../inc/config.php";
$url_signup = "../";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = clean_input($_POST['first_name']) . " " . clean_input($_POST['last_name']);
    $email = clean_input($_POST['email']);
    $password = clean_input($_POST['password']);
    $password_confirm = clean_input($_POST['password_confirm']);
    $role = clean_input($_POST['role']);
    $wa = clean_input($_POST['wa']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format";
        header("Location: $url_signup");
        exit();
    }
    if (!validateEmailDomain($email)) {
        $_SESSION['message'] = "Email domain must be yourname@syathiby.id";
        header("Location: $url_signup");
        exit();
    }

    if ($password !== $password_confirm) {
        $_SESSION['message'] = "Password dan konfirmasi password tidak cocok.";
        header("Location: $url_signup");
        exit();
    }

    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $hashed_password = $password;

    if (empty($role)) {
        $_SESSION['message'] = "Role is required.";
        header("Location: $url_signup");
        exit();
    }
   
    $query = "INSERT INTO users (name, email, password, wa, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);

    if ($stmt) {
        $stmt->bind_param('sssss', $name, $email, $hashed_password, $wa, $role);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Successfully registered, please wait admin approval.";
            header("Location: $url_signup");
            exit();
        } else {
            $_SESSION['message'] = "Failed to register: " . $stmt->error;
            header("Location: $url_signup");
            exit();
        }
    } else {
        $_SESSION['message'] = "Error: " . $koneksi->error;
        header("Location: $url_signup");
        exit();
    }

} else {
    header("Location: $url_signup");
    exit();
}