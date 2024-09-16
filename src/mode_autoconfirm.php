<?php
include "../inc/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mode_autoconfirm = $_POST['mode_autoconfirm'];

    $query = "UPDATE settings SET setting_value = ? WHERE setting_name = 'mode_autoconfirm'";
    $stmt = $koneksi->prepare($query);

    if ($stmt) {
        $stmt->bind_param('s', $mode_autoconfirm);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}