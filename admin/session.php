<?php
require_once '../includes/conn.php';


session_start();

if ($is_protected == true) {
    if (isset($_SESSION['id'])) {
        // if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        //     session_unset();
        //     session_destroy();
        //     header('Location: ../includes/logout.php');
        //     exit();
        // }

        $_SESSION['last_activity'] = time();

        $query = "SELECT u.*, r.role FROM users u";
        $query .= " LEFT JOIN roles r ON u.roles_id = r.id";
        $query .= " WHERE u.id = ? AND u.is_active = 1";

        $result = $conn->execute_query($query, [$_SESSION['id']]);

        if ($result && $result->num_rows > 0) {
            $acc = $result->fetch_object();
            $_SESSION['role'] = $acc->role;
            if ($acc->role != 'admin') {
                ?>
                <script>
                    history.back();
                </script>
                <?php
            }
        } else {
            header('Location: ../includes/logout.php');
            exit();
        }
    } else {
        header('Location: ../login.php');
        exit();
    }
}

if ($is_protected == false) {
}

$count_day_helpdesks = $conn->query("SELECT COUNT(*) as count_day FROM helpdesks WHERE DATE(date_requested) = CURDATE()")->fetch_object()->count_day;
$count_month_helpdesks = $conn->query("SELECT COUNT(*) as count_month FROM helpdesks WHERE YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE())")->fetch_object()->count_month;
$count_year_helpdesks = $conn->query("SELECT COUNT(*) as count_year FROM helpdesks WHERE YEAR(date_requested) = YEAR(CURDATE())")->fetch_object()->count_year;

$count_day_meetings = $conn->query("SELECT COUNT(*) as count_day FROM meetings WHERE DATE(date_requested) = CURDATE()")->fetch_object()->count_day;
$count_month_meetings = $conn->query("SELECT COUNT(*) as count_month FROM meetings WHERE YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE())")->fetch_object()->count_month;
$count_year_meetings = $conn->query("SELECT COUNT(*) as count_year FROM meetings WHERE YEAR(date_requested) = YEAR(CURDATE())")->fetch_object()->count_year;

$h_open = $conn->query("SELECT COUNT(*) as h_open FROM helpdesks WHERE h_statuses_id = 1")->fetch_object()->h_open;
$h_pending = $conn->query("SELECT COUNT(*) as h_pending FROM helpdesks WHERE h_statuses_id = 3")->fetch_object()->h_pending;
$h_completed = $conn->query("SELECT COUNT(*) as h_completed FROM helpdesks WHERE h_statuses_id = 5")->fetch_object()->h_completed;
$h_prerepair = $conn->query("SELECT COUNT(*) as h_prerepair FROM helpdesks WHERE h_statuses_id = 4")->fetch_object()->h_prerepair;

$m_pending = $conn->query("SELECT COUNT(*) as m_pending FROM meetings WHERE m_statuses_id = 1")->fetch_object()->m_pending;
$m_scheduled = $conn->query("SELECT COUNT(*) as m_scheduled FROM meetings WHERE m_statuses_id = 2")->fetch_object()->m_scheduled;
$m_unavailable = $conn->query("SELECT COUNT(*) as m_unavailable FROM meetings WHERE m_statuses_id = 3")->fetch_object()->m_unavailable;
$m_cancelled = $conn->query("SELECT COUNT(*) as m_cancelled FROM meetings WHERE m_statuses_id = 4")->fetch_object()->m_cancelled;

$u_admin = $conn->query("SELECT COUNT(*) as u_admin FROM users WHERE roles_id = 1")->fetch_object()->u_admin;
$u_staff = $conn->query("SELECT COUNT(*) as u_staff FROM users WHERE roles_id = 2")->fetch_object()->u_staff;
$u_employee = $conn->query("SELECT COUNT(*) as u_employee FROM users WHERE roles_id = 3")->fetch_object()->u_employee;