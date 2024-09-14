<?php
include "../inc/config.php";
include "../inc/auth_session.php";

if ($_SESSION['account_role'] !== 'root') {
    $_SESSION['message'] = "You don't have permission to access this page.";
    header("location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mode_maintenance = isset($_POST['mode_maintenance']) ? 1 : 0;

    $update_query = "UPDATE settings SET setting_value = '$mode_maintenance' WHERE setting_name = 'mode_maintenance'";
    $update_result = $koneksi->query($update_query);

    if ($update_result) {
        $_SESSION['message'] = "Maintenance mode updated successfully.";
    } else {
        $_SESSION['message'] = "Failed to update maintenance mode.";
    }

    header("location: mode_maintenance.php");
    exit();
}

$query = "SELECT setting_value FROM settings WHERE setting_name = 'mode_maintenance'";
$result = $koneksi->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $mode_maintenance = $row['setting_value'];
} else {
    $mode_maintenance = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Mode</title>
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

        .settings {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            max-width: 400px;
        }

        .settings h2 {
            margin-bottom: 20px;
        }

        .settings form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .settings label {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .settings button {
            padding: 10px;
            background: var(--syathiby-color-primary);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="settings">
        <h2>Maintenance Mode</h2>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <form method="POST" action="">
            <label>
                <span>Maintenance Mode:</span>
                <input type="checkbox" name="mode_maintenance" <?php echo $mode_maintenance ? 'checked' : ''; ?>>
            </label>
            <button type="submit">Save</button>
        </form>
    </div>
</body>

</html>