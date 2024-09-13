<?php
include "../inc/config.php";
include "../inc/auth_session.php";

$admin_role = $_SESSION['account_role'];

$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT * FROM users WHERE 1=1";
if ($admin_role == 'admin_ikhwan') {
    $query .= " AND role = 'santri_ikhwan'";
} elseif ($admin_role == 'admin_akhwat') {
    $query .= " AND role = 'santri_akhwat'";
} elseif ($admin_role == 'root') {
    // No additional condition for root
} else {
    $_SESSION['message'] = "Sorry, you don't have permission to login.";
    header("location: signin");
    exit();
}

if (!empty($search)) {
    $query .= " AND (name LIKE '%$search%' OR email LIKE '%$search%')";
}

$query .= " ORDER BY id DESC LIMIT $start, $limit";

// echo "Query: " . $query . "<br>"; // Debugging: Print the query

$result = $koneksi->query($query);

if (!$result) {
    die("Query failed: " . $koneksi->error);
}

$total_query = "SELECT COUNT(*) AS total FROM users WHERE 1=1";
if ($admin_role == 'admin_ikhwan') {
    $total_query .= " AND role = 'santri_ikhwan'";
} elseif ($admin_role == 'admin_akhwat') {
    $total_query .= " AND role = 'santri_akhwat'";
}

if (!empty($search)) {
    $total_query .= " AND (name LIKE '%$search%' OR email LIKE '%$search%')";
}

$total_result = $koneksi->query($total_query);

if (!$total_result) {
    die("Total query failed: " . $koneksi->error);
}

$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

        .dashboard {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            max-width: 800px;
        }

        .dashboard h2 {
            margin-bottom: 20px;
        }

        .dashboard table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .dashboard th,
        .dashboard td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .dashboard th {
            background: var(--syathiby-color-primary);
            color: white;
        }

        .dashboard button {
            padding: 5px 10px;
            background: var(--syathiby-color-primary);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .dashboard button.confirm {
            background: green;
        }

        .dashboard button.delete {
            background: red;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            padding: 5px 10px;
            margin: 0 5px;
            background: var(--syathiby-color-primary);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a.active {
            background: var(--syathiby-color-secondary);
        }

        .search-form {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            flex: 1;
            padding: 13px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
        }

        .search-form button {
            padding: 10px;
            border: none;
            background: var(--syathiby-color-primary);
            color: white;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        .search-form button svg {
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <h2>Admin Dashboard</h2>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <div style="text-align: right; margin-bottom: 20px;">
            <a href="../logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    style="width: 24px; height: 24px; vertical-align: middle; color: var(--syathiby-color-primary);">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
            </a>
        </div>
        <form method="GET" action="" class="search-form">
            <input type="text" name="search" placeholder="Search by name or email" value="<?php echo $search; ?>">
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Confirmed</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "<td>" . ($row['is_confirmed'] ? 'Yes' : 'No') . "</td>";
                        echo "<td style='display: flex; gap: 10px;'>";
                        if (!$row['is_confirmed']) {
                            echo "<button class='confirm' onclick='confirmUser(" . $row['id'] . ")' style='background: none; border: none; cursor: pointer;'>";
                            echo "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='green' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' style='width: 20px; height: 20px;'>";
                            echo "<polyline points='20 6 9 17 4 12'></polyline>";
                            echo "</svg>";
                            echo "</button>";
                        }
                        echo "<button class='delete' onclick='deleteUser(" . $row['id'] . ")' style='background: none; border: none; cursor: pointer;'>";
                        echo "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='red' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' style='width: 20px; height: 20px;'>";
                        echo "<polyline points='3 6 5 6 21 6'></polyline>";
                        echo "<path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path>";
                        echo "</svg>";
                        echo "</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = ($i == $page) ? 'active' : '';
                echo "<a href='?page=$i&search=$search' class='$active'>$i</a>";
            }
            ?>
        </div>
    </div>

    <script>
        function confirmUser(userId) {
            if (confirm("Are you sure you want to confirm this user?")) {
                window.location.href = "user_confirm.php?id=" + userId;
            }
        }

        function deleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "user_delete.php?id=" + userId;
            }
        }
    </script>
</body>

</html>