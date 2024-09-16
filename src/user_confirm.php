<?php
include "../inc/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $redirect = $_GET['redirect'] ?? 'dashboard.php';

    $stmt = $koneksi->prepare("SELECT email, password FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $email = $user['email'];
        $password = $user['password'];

        $mailQuota = 1; // Set default quota to 1 MB
        if ($user['role'] == 'staff') {
           $mailQuota = 100; 
        }

        // if (password_verify($password, $hashed_password)) {
        if ($password == $user['password']) {
            $stmt = $koneksi->prepare("UPDATE users SET is_confirmed = 1 WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                list($username, $domain) = explode('@', $email);

                $url = "https://$cpanel_host:$cpanel_port/execute/Email/add_pop";
                $post_data = array(
                    'domain' => $domain,
                    'email' => $username,
                    'password' => $password,
                    'quota' => $mailQuota
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_USERPWD, "$cpanel_username:$cpanel_password");
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                $response = curl_exec($ch);
                $result = json_decode($response, true);
                curl_close($ch);

                if ($response) {
                    if ($result['status'] == 1) {
                        $_SESSION['message'] = "Email account created successfully: $email";
                    } else {
                        $error_message = isset($result['errors'][0]) ? $result['errors'][0] : "Unknown error";
                        $_SESSION['message'] = "Failed to create email account: $error_message";
                    }
                } else {
                    $_SESSION['message'] = "Failed to contact cPanel server.";
                }
            } else {
                $_SESSION['message'] = "Failed to confirm user.";
            }
        } else {
            $_SESSION['message'] = "Password verification failed.";
        }
    } else {
        $_SESSION['message'] = "User not found.";
    }

    header('Location: ' . $redirect);
    exit();
} else {
    header('Location: ' . $redirect);
    exit();
}