<?php

// get connection
require_once 'conn.php';

session_start();

$response = array();

if (isset($_GET['select_data'])) {
    switch ($_GET['select_data']) {
        case 'offices_id':
        case 'upd_offices_id':
            $query = "SELECT `id`, `office` as `name` FROM offices";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'roles_id':
        case 'upd_roles_id':
            $query = "SELECT `id`, `role` as `name` FROM roles";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'divisions_id':
        case 'upd_divisions_id':
            $query = "SELECT `id`, `division` as `name` FROM divisions";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'client_types_id':
        case 'upd_client_types_id':
            $query = "SELECT `id`, `client_type` as `name` FROM client_types";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case "requested_by":
        case "upd_requested_by":
            $query = "SELECT `id`, CONCAT(first_name,' ',last_name) as `name` FROM users";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'h_statuses_id':
        case 'upd_h_statuses_id':
            $query = "SELECT `id`, `status` as `name` FROM h_statuses";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;

        case 'priority_levels_id':
        case 'upd_priority_levels_id':
            $query = "SELECT `id`, `priority_level` as `name` FROM priority_levels";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'repair_types_id':
        case 'upd_repair_types_id':
            $query = "SELECT `id`, `repair_type` as `name` FROM repair_types";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'repair_classes_id':
        case 'upd_repair_classes_id':
            $query = "SELECT `id`, `repair_class` as `name` FROM repair_classes";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'mediums_id':
        case 'upd_mediums_id':
            $query = "SELECT `id`, `medium` as `name` FROM mediums";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'request_types_id':
        case 'upd_request_types_id':
            $query = "SELECT `id`, `request_type` as `name` FROM request_types";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'hosts_id':
        case 'upd_hosts_id':
            $query = "SELECT `id`, `host` as `name` FROM hosts";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'm_statuses_id':
        case 'upd_m_statuses_id':
            $query = "SELECT `id`, `status` as `name` FROM m_statuses";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'categories_id':
        case 'upd_categories_id':
            $query = "SELECT `id`, `category` as `name` FROM categories WHERE request_types_id = " . $_GET['request_types_id'];
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
        case 'sub_categories_id':
        case 'upd_sub_categories_id':
            $query = "SELECT `id`, `sub_category` as `name` FROM sub_categories WHERE categories_id = " . $_GET['categories_id'];
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $response[] = $row;
            }

            break;
    }
}

if (isset($_GET['meetings'])) {
    $query = "SELECT * FROM meetings WHERE requested_by = " . $_SESSION['isds_id'];
    $result = $conn->execute_query($query);

    while ($row = $result->fetch_object()) {
        $row->title = $row->topic;
        $row->start = $row->date_scheduled . "T" . $row->time_start;
        $row->end = $row->date_scheduled . "T" . $row->time_end;
        $response[] = $row;
    }
}

if (isset($_GET['allmeetings'])) {
    $query = "SELECT m.*, ms.status_hex FROM meetings m LEFT JOIN m_statuses ms ON m.m_statuses_id = ms.id";
    $result = $conn->execute_query($query);

    while ($row = $result->fetch_object()) {
        $row->title = $row->topic;
        $row->start = $row->date_scheduled . "T" . $row->time_start;
        $row->end = $row->date_scheduled . "T" . $row->time_end;
        $row->color = $row->status_hex;
        $response[] = $row;
    }
}

if (isset($_GET["view_helpdesks"])) {

    $helpdesks_id = $_GET['helpdesks_id'];
    $query = "SELECT * FROM helpdesks_info WHERE id = ?";
    $result = $conn->execute_query($query, [$helpdesks_id]);

    $response = $result->fetch_object();
}

if (isset($_GET["upd_helpdesks"])) {

    $helpdesks_id = $_GET['helpdesks_id'];
    $query = "SELECT * FROM helpdesks WHERE id = ?";
    $result = $conn->execute_query($query, [$helpdesks_id]);

    $response = $result->fetch_object();
}

if (isset($_GET["upd_meetings"])) {

    $meetings_id = $_GET['meetings_id'];
    $query = "SELECT * FROM meetings WHERE id = ?";
    $result = $conn->execute_query($query, [$meetings_id]);

    $response = $result->fetch_object();


}

if (isset($_GET["upd_users"])) {

    $users_id = $_GET['users_id'];
    $query = "SELECT * FROM users WHERE id = ?";
    $result = $conn->execute_query($query, [$users_id]);

    $response = $result->fetch_object();


}

if (isset($_GET["chart_category"])) {
    $query = "";
    $query .= "SELECT c.category, IFNULL(h.count_per_category, 0) AS count_per_category ";
    $query .= "FROM categories c ";
    $query .= "LEFT JOIN (SELECT categories_id, COUNT(id) AS count_per_category FROM helpdesks WHERE YEAR(CURRENT_DATE) = YEAR(date_requested) AND offices_id = ? GROUP BY categories_id) h ON c.id = h.categories_id ";
    $query .= "ORDER BY h.count_per_category DESC";


    $result = $conn->execute_query($query, [$_SESSION['offices_id']]);

    $response = [
        'series' => [],
        'labels' => []
    ];

    while ($row = $result->fetch_object()) {
        $response['series'][] = $row->count_per_category;
        $response['labels'][] = $row->category;
    }
}

if (isset($_GET["chart_division"])) {
    $query = "";
    $query .= "SELECT d.division, IFNULL(hd.count_per_division, 0) AS count_per_division ";
    $query .= "FROM divisions d ";
    $query .= "LEFT JOIN (SELECT u.divisions_id, COUNT(h.id) AS count_per_division FROM helpdesks h INNER JOIN users u ON h.requested_by = u.id WHERE YEAR(h.date_requested) = YEAR(CURRENT_DATE) AND h.offices_id = ? GROUP BY u.divisions_id) hd ON d.id = hd.divisions_id ";

    $result = $conn->execute_query($query, [$_SESSION["offices_id"]]);

    $response = [
        'series' => [],
        'labels' => ['ORD', 'CPD', 'FAD', 'BDD', 'COA', 'IDD', 'DTI AKL', 'DTI ANT', 'DTI CAP', 'DTI GUI', 'DTI ILO', 'DTI NEG']
    ];

    while ($row = $result->fetch_object()) {
        $response['series'][] = $row->count_per_division;
        // $response['labels'][] = $row->division;
    }
}

if (isset($_GET["chart_sex"])) {
    $query = "";
    $query .= "SELECT sex_table.sex, IFNULL(counts.count_per_sex, 0) AS count_per_sex ";
    $query .= "FROM (SELECT 'Male' AS sex UNION ALL SELECT 'Female' AS sex) AS sex_table ";
    $query .= "LEFT JOIN (SELECT u.sex, COUNT(h.id) AS count_per_sex FROM helpdesks h INNER JOIN users u ON h.requested_by = u.id WHERE YEAR(h.date_requested) = YEAR(CURRENT_DATE) AND h.offices_id = ? GROUP BY u.sex) AS counts ON sex_table.sex = counts.sex ";
    $query .= "ORDER BY counts.count_per_sex DESC";
    $result = $conn->execute_query($query, [$_SESSION['offices_id']]);

    $response = [
        'series' => [],
        'labels' => []
    ];

    while ($row = $result->fetch_object()) {
        $response['series'][] = $row->count_per_sex;
        $response['labels'][] = $row->sex;
    }
}

if (isset($_GET["chart_month"])) {
    $query = "";
    $query .= "SELECT months.month_name, IFNULL(counts.count_per_month, 0) AS count_per_month ";
    $query .= "FROM ( SELECT 1 AS month_num, 'JAN' AS month_name UNION ALL SELECT 2, 'FEB' UNION ALL SELECT 3, 'MAR' UNION ALL SELECT 4, 'APR' UNION ALL SELECT 5, 'MAY' UNION ALL SELECT 6, 'JUN' UNION ALL SELECT 7, 'JUL' UNION ALL SELECT 8, 'AUG' UNION ALL SELECT 9, 'SEP' UNION ALL SELECT 10, 'OCT' UNION ALL SELECT 11, 'NOV' UNION ALL SELECT 12, 'DEC') AS months ";
    $query .= "LEFT JOIN ( SELECT MONTH(date_requested) AS month_num, COUNT(id) AS count_per_month FROM helpdesks WHERE YEAR(CURRENT_DATE) = YEAR(date_requested) AND offices_id = ? GROUP BY MONTH(date_requested)) AS counts ON months.month_num = counts.month_num ";
    $query .= "ORDER BY months.month_num ";


    $result = $conn->execute_query($query, [$_SESSION['offices_id']]);

    $response = [
        'series' => [],
        'labels' => []
    ];

    while ($row = $result->fetch_object()) {
        $response['series'][] = $row->count_per_month;
        $response['labels'][] = $row->month_name;
    }
}

if (isset($_POST['csf'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $query = "SELECT * FROM helpdesks_info WHERE id = ?";
    $result = $conn->execute_query($query, [$id]);
    $response = $result->fetch_object();
}

if (isset($_POST['view_csf'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $query = "SELECT * FROM csf_info WHERE id = ?";
    $result = $conn->execute_query($query, [$id]);
    $response = $result->fetch_object();
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
