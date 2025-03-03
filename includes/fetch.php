<?php
require_once 'conn.php';
require_once 'common_functions.php';

session_start();

class DataFetcher
{
    private $conn;
    private $response = [];

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    private function fetchSimpleTable($table, $nameField, $condition = '')
    {
        $query = "SELECT `id`, `$nameField` as `name` FROM $table $condition";
        $result = $this->conn->execute_query($query);
        return $this->fetchObjects($result);
    }

    private function fetchObjects($result)
    {
        $data = [];
        while ($row = $result->fetch_object()) {
            $data[] = $row;
        }
        return $data;
    }

    private function fetchSelectData($type)
    {
        $lookup = [
            'offices_id' => ['table' => 'offices', 'field' => 'office'],
            'roles_id' => ['table' => 'roles', 'field' => 'role'],
            'divisions_id' => ['table' => 'divisions', 'field' => 'division'],
            'client_types_id' => ['table' => 'client_types', 'field' => 'client_type'],
            'h_statuses_id' => ['table' => 'h_statuses', 'field' => 'status'],
            'priority_levels_id' => ['table' => 'priority_levels', 'field' => 'priority_level'],
            'repair_types_id' => ['table' => 'repair_types', 'field' => 'repair_type'],
            'repair_classes_id' => ['table' => 'repair_classes', 'field' => 'repair_class'],
            'mediums_id' => ['table' => 'mediums', 'field' => 'medium'],
            'request_types_id' => ['table' => 'request_types', 'field' => 'request_type'],
            'hosts_id' => ['table' => 'hosts', 'field' => 'host'],
            'm_statuses_id' => ['table' => 'm_statuses', 'field' => 'status'],
        ];

        if (isset($lookup[$type])) {
            return $this->fetchSimpleTable($lookup[$type]['table'], $lookup[$type]['field']);
        }

        switch ($type) {
            case 'requested_by':
            case 'upd_requested_by':
                return $this->fetchSimpleTable('users', "CONCAT(first_name,' ',last_name)", 'ORDER BY first_name ASC');

            case 'serviced_by':
            case 'upd_serviced_by':
                return $this->fetchSimpleTable('users', "CONCAT(first_name,' ',last_name)", 'WHERE roles_id = 1 ORDER BY first_name ASC');

            case 'categories_id':
            case 'upd_categories_id':
                $query = "SELECT `id`, `category` as `name` FROM categories WHERE request_types_id = ?";
                return $this->fetchObjects($this->conn->execute_query($query, [$_GET['request_types_id']]));

            case 'sub_categories_id':
            case 'upd_sub_categories_id':
                $query = "SELECT `id`, `sub_category` as `name` FROM sub_categories WHERE categories_id = ?";
                return $this->fetchObjects($this->conn->execute_query($query, [$_GET['categories_id']]));
        }
        return [];
    }

    private function fetchMeetings($type)
    {
        if ($type === 'meetings') {
            $query = "SELECT * FROM meetings WHERE requested_by = ?";
            $result = $this->conn->execute_query($query, [$_SESSION['id']]);
        } else {
            $query = "SELECT m.*, ms.status_hex FROM meetings m LEFT JOIN m_statuses ms ON m.m_statuses_id = ms.id";
            $result = $this->conn->execute_query($query);
        }

        $meetings = [];
        while ($row = $result->fetch_object()) {
            $row->title = $row->topic;
            $row->start = "$row->date_scheduled" . "T" . "$row->time_start";
            $row->end = "$row->date_scheduled" . "T" . "$row->time_end";
            if ($type === 'allmeetings') {
                $row->color = $row->status_hex;
            }
            $meetings[] = $row;
        }
        return $meetings;
    }

    private function fetchChartData($type)
    {
        $queries = [
            'category' => [
                'sql' => "SELECT c.category, IFNULL(h.count_per_category, 0) AS count_per_category 
                         FROM categories c 
                         LEFT JOIN (SELECT categories_id, COUNT(id) AS count_per_category 
                                   FROM helpdesks 
                                   WHERE YEAR(CURRENT_DATE) = YEAR(date_requested) 
                                   AND offices_id = ? 
                                   GROUP BY categories_id) h 
                         ON c.id = h.categories_id 
                         ORDER BY h.count_per_category DESC"
            ],
            'division' => [
                'sql' => "SELECT d.division, IFNULL(hd.count_per_division, 0) AS count_per_division 
                         FROM divisions d 
                         LEFT JOIN (SELECT u.divisions_id, COUNT(h.id) AS count_per_division 
                                   FROM helpdesks h 
                                   INNER JOIN users u ON h.requested_by = u.id 
                                   WHERE YEAR(h.date_requested) = YEAR(CURRENT_DATE) 
                                   AND h.offices_id = ? 
                                   GROUP BY u.divisions_id) hd 
                         ON d.id = hd.divisions_id"
            ],
            'sex' => [
                'sql' => "SELECT sex_table.sex, IFNULL(counts.count_per_sex, 0) AS count_per_sex 
                         FROM (SELECT 'Male' AS sex UNION ALL SELECT 'Female' AS sex) AS sex_table 
                         LEFT JOIN (SELECT u.sex, COUNT(h.id) AS count_per_sex 
                                   FROM helpdesks h 
                                   INNER JOIN users u ON h.requested_by = u.id 
                                   WHERE YEAR(h.date_requested) = YEAR(CURRENT_DATE) 
                                   AND h.offices_id = ? 
                                   GROUP BY u.sex) AS counts 
                         ON sex_table.sex = counts.sex 
                         ORDER BY counts.count_per_sex DESC"
            ],
            'month' => [
                'sql' => "SELECT months.month_name, IFNULL(counts.count_per_month, 0) AS count_per_month 
                         FROM (SELECT 1 AS month_num, 'JAN' AS month_name UNION ALL SELECT 2, 'FEB' 
                              UNION ALL SELECT 3, 'MAR' UNION ALL SELECT 4, 'APR' 
                              UNION ALL SELECT 5, 'MAY' UNION ALL SELECT 6, 'JUN' 
                              UNION ALL SELECT 7, 'JUL' UNION ALL SELECT 8, 'AUG' 
                              UNION ALL SELECT 9, 'SEP' UNION ALL SELECT 10, 'OCT' 
                              UNION ALL SELECT 11, 'NOV' UNION ALL SELECT 12, 'DEC') AS months 
                         LEFT JOIN (SELECT MONTH(date_requested) AS month_num, COUNT(id) AS count_per_month 
                                   FROM helpdesks 
                                   WHERE YEAR(CURRENT_DATE) = YEAR(date_requested) 
                                   AND offices_id = ? 
                                   GROUP BY MONTH(date_requested)) AS counts 
                         ON months.month_num = counts.month_num 
                         ORDER BY months.month_num"
            ]
        ];

        $result = $this->conn->execute_query($queries[$type]['sql'], [$_SESSION['offices_id']]);
        $response = ['series' => [], 'labels' => []];

        while ($row = $result->fetch_object()) {
            $response['series'][] = $row->{"count_per_$type"};
            $response['labels'][] = $row->{$type};
        }
        return $response;
    }

    public function processRequest()
    {
        if (isset($_GET['select_data'])) {
            $this->response = $this->fetchSelectData($_GET['select_data']);
        }

        if (isset($_GET['meetings']) || isset($_GET['allmeetings'])) {
            $this->response = $this->fetchMeetings($_GET['meetings'] ? 'meetings' : 'allmeetings');
        }

        if (isset($_GET["view_helpdesks"])) {
            $this->response = $this->conn->execute_query("SELECT * FROM helpdesks_info WHERE id = ?", [$_GET['helpdesks_id']])->fetch_object();
        }

        if (isset($_GET["upd_helpdesk"])) {
            $this->response = $this->conn->execute_query("SELECT * FROM helpdesks WHERE id = ?", [$_GET['helpdesks_id']])->fetch_object();
        }

        if (isset($_GET["upd_meeting"])) {
            $this->response = $this->conn->execute_query("SELECT * FROM meetings WHERE id = ?", [$_GET['meetings_id']])->fetch_object();
        }

        if (isset($_GET["upd_user"])) {
            $this->response = $this->conn->execute_query("SELECT * FROM users WHERE id = ?", [$_GET['users_id']])->fetch_object();
        }

        if (isset($_GET["chart_category"])) {
            $this->response = $this->fetchChartData('category');
        }

        if (isset($_GET["chart_division"])) {
            $this->response = $this->fetchChartData('division');
        }

        if (isset($_GET["chart_sex"])) {
            $this->response = $this->fetchChartData('sex');
        }

        if (isset($_GET["chart_month"])) {
            $this->response = $this->fetchChartData('month');
        }

        if (isset($_POST['csf'])) {
            $this->response = $this->conn->execute_query("SELECT * FROM helpdesks_info WHERE id = ?", [$this->conn->real_escape_string($_POST['id'])])->fetch_object();
        }

        if (isset($_POST['view_csf'])) {
            $this->response = $this->conn->execute_query("SELECT * FROM csf_info WHERE id = ?", [$this->conn->real_escape_string($_POST['id'])])->fetch_object();
        }

        return json_encode($this->response);
    }
}

$fetcher = new DataFetcher($conn);
echo $fetcher->processRequest();
$conn->close();
