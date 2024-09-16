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
    $class = clean_input($_POST['class']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format";
        header("Location: $url_signup");
        exit();
    }
    if (!validateEmailDomain($email)) {
        $_SESSION['message'] = "Email domain must be yourname@smail.syathiby.id";
        header("Location: $url_signup");
        exit();
    }

    if ($password !== $password_confirm) {
        $_SESSION['message'] = "Password dan konfirmasi password tidak cocok.";
        header("Location: $url_signup");
        exit();
    }

    if (!validatePasswordWithCpanel($password)) {
        $_SESSION['message'] = "Password is not strong enough.";
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

    if (empty($class)) {
        $_SESSION['message'] = "Class is required.";
        header("Location: $url_signup");
        exit();
    }

    $query = "INSERT INTO users (name, email, password, wa, class, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);

    if ($stmt) {
        $stmt->bind_param('ssssss', $name, $email, $hashed_password, $wa, $class, $role);

        if ($stmt->execute()) {
            $userId = $koneksi->insert_id;

            $query = "SELECT setting_value FROM settings WHERE setting_name = 'mode_autoconfirm'";
            $result = $koneksi->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $maintenance_mode = $row['setting_value'];
                if ($maintenance_mode == 1) {
                    header("Location: user_confirm.php?id=" . $userId . "&redirect=../");
                } else {
                    $_SESSION['message'] = "Successfully registered, please wait admin approval.";
                    header("Location: $url_signup");
                    exit();
                }
            }
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