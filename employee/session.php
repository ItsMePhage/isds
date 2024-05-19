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
            if ($acc->role != 'employee') {
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

$count_day_helpdesks = $conn->query("SELECT COUNT(*) as count_day FROM helpdesks WHERE DATE(date_requested) = CURDATE() AND requested_by = $acc->id")->fetch_object()->count_day;
$count_month_helpdesks = $conn->query("SELECT COUNT(*) as count_month FROM helpdesks WHERE YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE()) AND requested_by = $acc->id")->fetch_object()->count_month;
$count_year_helpdesks = $conn->query("SELECT COUNT(*) as count_year FROM helpdesks WHERE YEAR(date_requested) = YEAR(CURDATE()) AND requested_by = $acc->id")->fetch_object()->count_year;

$count_day_meetings = $conn->query("SELECT COUNT(*) as count_day FROM meetings WHERE DATE(date_requested) = CURDATE() AND requested_by = $acc->id")->fetch_object()->count_day;
$count_month_meetings = $conn->query("SELECT COUNT(*) as count_month FROM meetings WHERE YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE()) AND requested_by = $acc->id")->fetch_object()->count_month;
$count_year_meetings = $conn->query("SELECT COUNT(*) as count_year FROM meetings WHERE YEAR(date_requested) = YEAR(CURDATE()) AND requested_by = $acc->id")->fetch_object()->count_year;

$count_open = $conn->query("SELECT COUNT(*) as count_open FROM helpdesks WHERE h_statuses_id = 1 AND requested_by = $acc->id")->fetch_object()->count_open;
$count_pending = $conn->query("SELECT COUNT(*) as count_pending FROM helpdesks WHERE h_statuses_id = 3 AND requested_by = $acc->id")->fetch_object()->count_pending;
$count_completed = $conn->query("SELECT COUNT(*) as count_completed FROM helpdesks WHERE h_statuses_id = 5 AND requested_by = $acc->id")->fetch_object()->count_completed;
$count_prerepair = $conn->query("SELECT COUNT(*) as count_prerepair FROM helpdesks WHERE h_statuses_id = 4 AND requested_by = $acc->id")->fetch_object()->count_prerepair;
