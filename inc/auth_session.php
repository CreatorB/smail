<?php
$logout_redirect_url = "../logout.php";
$timeout = TIMEOUT * 60;

if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Session timed out, please login again'); window.location = '$logout_redirect_url'</script>";
    }
} else {
    $_SESSION['start_time'] = time();
}

if (!isset($_SESSION['account_id']) || !isset($_SESSION['account_role'])) {
    header("location: $logout_redirect_url");
    exit();
}