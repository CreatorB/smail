<?php
include "../inc/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $userId = $_GET['id'];

    $stmt = $koneksi->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $email = $user['email'];

        $stmt = $koneksi->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            list($username, $domain) = explode('@', $email);

            // UAPI endpoint to delete email account
            $url = "https://$cpanel_host:$cpanel_port/execute/Email/delete_pop";
            $post_data = array(
                'domain' => $domain,
                'email' => $username
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
                    $_SESSION['message'] = "User and email account deleted successfully: $email";
                } else {
                    $error_message = isset($result['errors'][0]) ? $result['errors'][0] : "Unknown error";
                    $_SESSION['message'] = "Failed to delete email account: $error_message";
                }
            } else {
                $_SESSION['message'] = "Failed to contact cPanel server.";
            }
        } else {
            $_SESSION['message'] = "Failed to delete user.";
        }
    } else {
        $_SESSION['message'] = "User not found.";
    }

    header('Location: dashboard.php');
    exit();
} else {
    header('Location: dashboard.php');
    exit();
}