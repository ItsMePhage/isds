<?php
require_once "conn.php";

session_start();

$dbDetails = array('host' => servername, 'user' => username, 'pass' => password, 'db' => dbname);

$primaryKey = 'id';

if (isset($_GET['MOCK_DATAs'])) {
    $table = "MOCK_DATA";

    $columns = array(
        array('db' => 'first_name', 'dt' => 0),
        array('db' => 'last_name', 'dt' => 1),
        array('db' => 'email', 'dt' => 2),
        array('db' => 'gender', 'dt' => 3),
        array('db' => 'ip_address', 'dt' => 4)
    );
}

if (isset($_GET['tbl_allusers'])) {
    $table = "";
    $table .= "(SELECT u.*, o.office_code, o.office, d.division, c.client_type, r.role ";
    $table .= "FROM users u ";
    $table .= "LEFT JOIN offices o ON u.offices_id = o.id ";
    $table .= "LEFT JOIN divisions d ON u.divisions_id = d.id ";
    $table .= "LEFT JOIN client_types c ON u.client_types_id = c.id ";
    $table .= "LEFT JOIN roles r ON u.roles_id = r.id) AS tbl_allusers ";

    $columns = array(
        array('db' => 'id_number', 'dt' => 0),
        array('db' => 'first_name', 'dt' => null),
        array(
            'db' => 'last_name',
            'dt' => 1,
            'formatter' => function ($d, $row) {
                return $row['first_name'] . ' ' . $row['last_name'];
            }
        ),
        array('db' => 'email', 'dt' => 2),
        array('db' => 'office', 'dt' => 3),
        array('db' => 'division', 'dt' => 4),
        array('db' => 'role', 'dt' => 5),
        array(
            'db' => 'id',
            'dt' => 6,
            'formatter' => function ($d, $row) {
                $html = '<small class="text-nowrap small"><button type="button" class="btn btn-primary mx-1 my-0 small" onclick="updusersbtn(' . $d . ')"><i class="bi bi-pencil-square small"></i></button>';
                $html .= '<button type="button" class="btn btn-warning mx-1 my-0 small" onclick="rstusersbtn(' . $row['id'] . ')"><i class="bi bi-key"></i></button></small>';

                return $html;
            }
        )
    );
}

if (isset($_GET['tbl_helpdesks'])) {
    $table = "";
    $table .= "(SELECT h.id, h.request_number, h.requested_by, h.date_requested, h.request_types_id, h.categories_id, h.sub_categories_id, h.complaint, h.datetime_preferred, h.h_statuses_id, rt.request_type, c.category, sc.sub_category, hs.status, hs.status_color ";
    $table .= "FROM helpdesks h ";
    $table .= "LEFT JOIN request_types rt ON h.request_types_id = rt.id ";
    $table .= "LEFT JOIN categories c ON h.categories_id = c.id ";
    $table .= "LEFT JOIN sub_categories sc ON h.sub_categories_id = sc.id ";
    $table .= "LEFT JOIN h_statuses hs ON h.h_statuses_id = hs.id ";
    $table .= "WHERE requested_by = " . $_SESSION['id'] . ") AS tbl_helpdesks ";

    $columns = array(
        array(
            'db' => 'date_requested',
            'dt' => 0,
            'formatter' => function ($d, $row) {
                return date_format(date_create($d), 'd/m/Y');
            }
        ),
        array('db' => 'request_number', 'dt' => 1),
        array('db' => 'category', 'dt' => 2),
        array('db' => 'sub_category', 'dt' => 3),
        array('db' => 'status_color', 'dt' => null),
        array(
            'db' => 'status',
            'dt' => 4,
            'formatter' => function ($d, $row) {
                return '<center><span class="badge text-bg-' . $row['status_color'] . '">' . $d . '</span></center>';
            }
        ),
        array(
            'db' => 'id',
            'dt' => 5,
            'formatter' => function ($d, $row) {
                $html = '<small class="text-nowrap small"><button type="button" class="btn btn-primary mx-1 my-0 small" onclick="updhelpdesksbtn(' . $row['id'] . ')"><i class="bi bi-pencil-square small"></i></button>';
                $html .= '<button type="button" class="btn btn-danger mx-1 my-0 small" onclick="delhelpdesksbtn(' . $row['id'] . ')"><i class="bi bi-trash3-fill small"></i></button></small>';

                return $html;
            }
        )
    );
}

if (isset($_GET['tbl_meetings'])) {
    $table = "(SELECT 
        m.id, 
        m.request_number, 
        m.requested_by, 
        m.date_requested, 
        m.topic, 
        m.date_scheduled, 
        m.time_start, 
        m.time_end, 
        m.m_statuses_id,
        ms.status,
        ms.status_color
    FROM 
        meetings m
    LEFT JOIN 
        m_statuses ms ON m.m_statuses_id = ms.id
    WHERE requested_by = " . $_SESSION['id'] . ") AS tbl_meetings";

    $columns = array(
        array(
            'db' => 'date_requested',
            'dt' => 0,
            'formatter' => function ($d, $row) {
                return date_format(date_create($d), 'd/m/Y');
            }
        ),
        array('db' => 'request_number', 'dt' => 1),
        array(
            'db' => 'date_scheduled',
            'dt' => 2,
            'formatter' => function ($d, $row) {
                return date_format(date_create($row['date_scheduled']), 'd/m/Y');
            }
        ),
        array(
            'db' => 'time_start',
            'dt' => null
        ),
        array(
            'db' => 'time_end',
            'dt' => 3,
            'formatter' => function ($d, $row) {
                return date_format(date_create($row['time_start']), 'H:i a') . "-" . date_format(date_create($row['time_end']), 'H:i a');
            }
        ),
        array('db' => 'status_color', 'dt' => null),
        array(
            'db' => 'status',
            'dt' => 4,
            'formatter' => function ($d, $row) {
                return '<span class="badge text-bg-' . $row['status_color'] . '">' . $d . '</span>';
            }
        ),
        array(
            'db' => 'id',
            'dt' => 5,
            'formatter' => function ($d, $row) {
                $html = '<small class="text-nowrap small"><button type="button" class="btn btn-primary mx-1 my-0 small" onclick="updmeetingsbtn(' . $row['id'] . ')"><i class="bi bi-pencil-square small"></i></button>';
                $html .= '<button type="button" class="btn btn-danger mx-1 my-0 small" onclick="delmeetingsbtn(' . $row['id'] . ')"><i class="bi bi-trash3-fill small"></i></button></small>';

                return $html;
            }
        )
    );
}

if (isset($_GET['tbl_helpdesks_a'])) {
    $table = "(SELECT 
        h.id, 
        h.request_number, 
        h.requested_by,  
        CONCAT(u.first_name,' ',u.last_name) AS requested_by_name, 
        h.date_requested, 
        h.request_types_id, 
        h.categories_id, 
        h.sub_categories_id, 
        h.complaint, 
        h.datetime_preferred, 
        h.h_statuses_id, 
        rt.request_type, 
        c.category, 
        sc.sub_category, 
        hs.status, 
        hs.status_color
    FROM 
        helpdesks h
    LEFT JOIN 
        request_types rt ON h.request_types_id = rt.id
    LEFT JOIN 
        users u ON h.requested_by = u.id
    LEFT JOIN 
        categories c ON h.categories_id = c.id
    LEFT JOIN 
        sub_categories sc ON h.sub_categories_id = sc.id
    LEFT JOIN 
        h_statuses hs ON h.h_statuses_id = hs.id
     WHERE 
        h.serviced_by = " . $_SESSION['id'] . " OR h.serviced_by IS NULL) AS tbl_helpdesks";

    $columns = array(
        array(
            'db' => 'date_requested',
            'dt' => 0,
            'formatter' => function ($d, $row) {
                return date_format(date_create($d), 'd/m/Y');
            }
        ),
        array('db' => 'requested_by_name', 'dt' => 1),
        array('db' => 'request_number', 'dt' => 2),
        array('db' => 'category', 'dt' => 3),
        array('db' => 'sub_category', 'dt' => 4),
        array('db' => 'status_color', 'dt' => null),
        array(
            'db' => 'status',
            'dt' => 5,
            'formatter' => function ($d, $row) {
                return '<center><span class="badge text-bg-' . $row['status_color'] . '">' . $d . '</span></center>';
            }
        ),
        array(
            'db' => 'id',
            'dt' => 6,
            'formatter' => function ($d, $row) {
                $html = '<small class="text-nowrap small"><button type="button" class="btn btn-primary mx-1 my-0 small" onclick="updhelpdesksbtn(' . $row['id'] . ')"><i class="bi bi-pencil-square small"></i></button>';
                $html .= '<button type="button" class="btn btn-danger mx-1 my-0 small" onclick="delhelpdesksbtn(' . $row['id'] . ')"><i class="bi bi-trash3-fill small"></i></button></small>';

                return $html;
            }
        )
    );
}

if (isset($_GET['tbl_meetings_a'])) {
    $table = "(SELECT 
        m.id, 
        m.request_number, 
        m.requested_by, 
        CONCAT(u.first_name,' ',u.last_name) AS requested_by_name, 
        m.date_requested, 
        m.topic, 
        m.date_scheduled, 
        m.time_start, 
        m.time_end, 
        m.m_statuses_id,
        ms.status,
        ms.status_color
    FROM 
        meetings m
    LEFT JOIN 
        m_statuses ms ON m.m_statuses_id = ms.id
    LEFT JOIN 
        users u ON m.requested_by = u.id
    ) AS tbl_meetings";

    $columns = array(
        array(
            'db' => 'date_requested',
            'dt' => 0,
            'formatter' => function ($d, $row) {
                return date_format(date_create($d), 'd/m/Y');
            }
        ),
        array('db' => 'requested_by_name', 'dt' => 1),
        array('db' => 'request_number', 'dt' => 2),
        array(
            'db' => 'date_scheduled',
            'dt' => 3,
            'formatter' => function ($d, $row) {
                return date_format(date_create($row['date_scheduled']), 'd/m/Y');
            }
        ),
        array(
            'db' => 'time_start',
            'dt' => null
        ),
        array(
            'db' => 'time_end',
            'dt' => 4,
            'formatter' => function ($d, $row) {
                return date_format(date_create($row['time_start']), 'H:i a') . "-" . date_format(date_create($row['time_end']), 'H:i a');
            }
        ),
        array('db' => 'status_color', 'dt' => null),
        array(
            'db' => 'status',
            'dt' => 5,
            'formatter' => function ($d, $row) {
                return '<span class="badge text-bg-' . $row['status_color'] . '">' . $d . '</span>';
            }
        ),
        array(
            'db' => 'id',
            'dt' => 6,
            'formatter' => function ($d, $row) {
                $html = '<small class="text-nowrap small"><button type="button" class="btn btn-primary mx-1 my-0 small" onclick="updmeetingsbtn(' . $row['id'] . ')"><i class="bi bi-pencil-square small"></i></button>';
                $html .= '<button type="button" class="btn btn-danger mx-1 my-0 small" onclick="delmeetingsbtn(' . $row['id'] . ')"><i class="bi bi-trash3-fill small"></i></button></small>';

                return $html;
            }
        )
    );
}


require 'ssp.class.php';

echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
);
