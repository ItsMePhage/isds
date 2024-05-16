<?php
require_once '../includes/conn.php';


session_start();

if ($is_protected == true) {
    if (isset($_SESSION['id'])) {
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
            session_unset();
            session_destroy();
            header('Location: assets/components/includes/logout.php');
            exit();
        }

        $_SESSION['last_activity'] = time();

        $query = "SELECT u.*, r.role FROM users u";
        $query .= " LEFT JOIN roles r ON u.role_id = r.id";
        $query .= " WHERE u.id = ? AND u.active = 1";

        $result = $conn->execute_query($query, [$_SESSION['id']]);

        if ($result && $result->num_rows > 0) {
            $acc = $result->fetch_object();
            $_SESSION['role'] = $acc->role;
            if ($acc->role != 'employee') {
                ?>
                <script>
                    history.back();
                </script>
                <?php
            }
        } else {
            header('Location: assets/components/includes/logout.php');
            exit();
        }
    } else {
        header('Location: ../login.php');
        exit();
    }
}

if ($is_protected == false) {
    
}
