<?php
require_once '../includes/conn.php';


session_start();

if ($is_protected == true) {
    if (isset($_SESSION['isds_id'])) {

        $_SESSION['last_activity'] = time();

        $query = "SELECT * FROM users_info";
        $query .= " WHERE id = ? AND is_active = 1";

        $result = $conn->execute_query($query, [$_SESSION['isds_id']]);

        if ($result && $result->num_rows > 0) {
            $acc = $result->fetch_object();
            $_SESSION['role'] = $acc->role;
            $_SESSION['offices_id'] = $acc->offices_id;

            // Check if the user's role is neither 'employee' nor 'VIP'
            if (!in_array($acc->role, ['employee', 'VIP'])) {
                // Redirect to an appropriate page or display an error message
                echo "<script>
            alert('Access denied. You do not have the required permissions.');
            window.location.href = '/home'; // Replace '/home' with the desired fallback URL
          </script>";
                exit; // Ensure script execution stops here
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

$count_day_helpdesks = $conn->query("SELECT COUNT(*) as count_day FROM helpdesks WHERE DATE(date_requested) = CURDATE() AND requested_by = $acc->id")->fetch_object()->count_day;
$count_month_helpdesks = $conn->query("SELECT COUNT(*) as count_month FROM helpdesks WHERE YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE()) AND requested_by = $acc->id")->fetch_object()->count_month;
$count_year_helpdesks = $conn->query("SELECT COUNT(*) as count_year FROM helpdesks WHERE YEAR(date_requested) = YEAR(CURDATE()) AND requested_by = $acc->id")->fetch_object()->count_year;

$count_day_meetings = $conn->query("SELECT COUNT(*) as count_day FROM meetings WHERE DATE(date_requested) = CURDATE() AND requested_by = $acc->id")->fetch_object()->count_day;
$count_month_meetings = $conn->query("SELECT COUNT(*) as count_month FROM meetings WHERE YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE()) AND requested_by = $acc->id")->fetch_object()->count_month;
$count_year_meetings = $conn->query("SELECT COUNT(*) as count_year FROM meetings WHERE YEAR(date_requested) = YEAR(CURDATE()) AND requested_by = $acc->id")->fetch_object()->count_year;

$h_open = $conn->query("SELECT COUNT(*) as h_open FROM helpdesks WHERE h_statuses_id = 1 AND requested_by = $acc->id")->fetch_object()->h_open;
$h_pending = $conn->query("SELECT COUNT(*) as h_pending FROM helpdesks WHERE h_statuses_id = 3 AND requested_by = $acc->id")->fetch_object()->h_pending;
$h_completed = $conn->query("SELECT COUNT(*) as h_completed FROM helpdesks WHERE h_statuses_id = 5 AND requested_by = $acc->id")->fetch_object()->h_completed;
$h_prerepair = $conn->query("SELECT COUNT(*) as h_prerepair FROM helpdesks WHERE h_statuses_id = 4 AND requested_by = $acc->id")->fetch_object()->h_prerepair;

$m_pending = $conn->query("SELECT COUNT(*) as m_pending FROM meetings WHERE m_statuses_id = 1 AND requested_by = $acc->id")->fetch_object()->m_pending;
$m_scheduled = $conn->query("SELECT COUNT(*) as m_scheduled FROM meetings WHERE m_statuses_id = 2 AND requested_by = $acc->id")->fetch_object()->m_scheduled;
$m_unavailable = $conn->query("SELECT COUNT(*) as m_unavailable FROM meetings WHERE m_statuses_id = 3 AND requested_by = $acc->id")->fetch_object()->m_unavailable;
$m_cancelled = $conn->query("SELECT COUNT(*) as m_cancelled FROM meetings WHERE m_statuses_id = 4 AND requested_by = $acc->id")->fetch_object()->m_cancelled;
