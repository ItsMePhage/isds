<?php
require_once '../includes/conn.php';


session_start();

if ($is_protected == true) {
    if (isset($_SESSION['id'])) {

        $_SESSION['last_activity'] = time();

        $query = "SELECT * FROM users_info";
        $query .= " WHERE id = ? AND is_active = 1";

        $result = $conn->execute_query($query, [$_SESSION['id']]);

        if ($result && $result->num_rows > 0) {
            $acc = $result->fetch_object();
            $_SESSION['role'] = $acc->role;
            $_SESSION['offices_id'] = $acc->offices_id;
            if (!in_array($acc->role, ['admin'])) {
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

// Prepare the session variable
$offices_id = intval($_SESSION['offices_id']);
$offices_condition = ($offices_id == 1) ? "" : "AND offices_id = $offices_id";

// Helper function to execute queries
function fetch_count($conn, $query)
{
    return $conn->query($query)->fetch_object()->count;
}

// Queries for helpdesks
$helpdesk_counts = $conn->query("
    SELECT 
        COUNT(*) as count_day,
        SUM(DATE(date_requested) = CURDATE()) as count_day,
        SUM(YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE())) as count_month,
        SUM(YEAR(date_requested) = YEAR(CURDATE())) as count_year,
        SUM(h_statuses_id = 1) as h_open,
        SUM(h_statuses_id = 3) as h_pending,
        SUM(h_statuses_id = 5) as h_completed,
        SUM(h_statuses_id = 4) as h_prerepair
    FROM helpdesks_info 
    WHERE offices_id = $offices_id OR $offices_id = 1
")->fetch_object();

$count_day_helpdesks = $helpdesk_counts->count_day;
$count_month_helpdesks = $helpdesk_counts->count_month;
$count_year_helpdesks = $helpdesk_counts->count_year;
$h_open = $helpdesk_counts->h_open;
$h_pending = $helpdesk_counts->h_pending;
$h_completed = $helpdesk_counts->h_completed;
$h_prerepair = $helpdesk_counts->h_prerepair;

// Queries for meetings
$meeting_counts = $conn->query("
    SELECT 
        COUNT(*) as count_day,
        SUM(DATE(date_requested) = CURDATE()) as count_day,
        SUM(YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE())) as count_month,
        SUM(YEAR(date_requested) = YEAR(CURDATE())) as count_year,
        SUM(m_statuses_id = 1) as m_pending,
        SUM(m_statuses_id = 2) as m_scheduled,
        SUM(m_statuses_id = 3) as m_unavailable,
        SUM(m_statuses_id = 4) as m_cancelled
    FROM meetings_info
    WHERE offices_id = $offices_id OR $offices_id = 1
")->fetch_object();

$count_day_meetings = $meeting_counts->count_day;
$count_month_meetings = $meeting_counts->count_month;
$count_year_meetings = $meeting_counts->count_year;
$m_pending = $meeting_counts->m_pending;
$m_scheduled = $meeting_counts->m_scheduled;
$m_unavailable = $meeting_counts->m_unavailable;
$m_cancelled = $meeting_counts->m_cancelled;

// Queries for users
$user_counts = $conn->query("
    SELECT
        SUM(roles_id = 1) as u_admin,
        SUM(roles_id = 2) as u_vip,
        SUM(roles_id = 3) as u_employee
    FROM users_info
    WHERE offices_id = $offices_id OR $offices_id = 1
")->fetch_object();

$u_admin = $user_counts->u_admin;
$u_vip = $user_counts->u_vip;
$u_employee = $user_counts->u_employee;

// Queries for completed tasks and CSF
$completed_tasks = fetch_count($conn, "SELECT COUNT(*) as count FROM helpdesks WHERE h_statuses_id = 5");
$pending_csf = fetch_count($conn, "SELECT COUNT(*) as count FROM helpdesks h LEFT JOIN csf ON h.id = csf.helpdesks_id WHERE h.h_statuses_id = 5 AND csf.id IS NULL");
$submitted_csf = fetch_count($conn, "SELECT COUNT(*) as count FROM helpdesks h LEFT JOIN csf ON h.id = csf.helpdesks_id WHERE h.h_statuses_id = 5 AND csf.id IS NOT NULL");
