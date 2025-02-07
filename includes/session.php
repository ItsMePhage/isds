<?php
require_once 'assets/components/includes/conn.php';


session_start();

if ($protected == true) {
    if (isset($_SESSION['isds_id'])) {
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
            session_unset();
            session_destroy();
            header('Location: assets/components/includes/logout.php');
            exit();
        }

        $_SESSION['last_activity'] = time();

        $query = "SELECT * FROM users_info";
        $query .= " WHERE id = ? AND is_active = 1";

        $result = $conn->execute_query($query, [$_SESSION['isds_id']]);

        if ($result && $result->num_rows > 0) {
            $acc = $result->fetch_object();
            $_SESSION['role'] = $acc->role;
            $_SESSION['offices_id'] = $acc->offices_id;
        } else {
            header('Location: assets/components/includes/logout.php');
            exit();
        }
    } else {
        header('Location: login.php');
        exit();
    }
}

if ($protected == false) {
    if (isset($_SESSION['isds_id'])) {
        header('Location: dashboard.php');
        exit();
    }
}
