<?php
require_once "conn.php";

session_start();

$dbDetails = array('host' => servername, 'user' => username, 'pass' => password, 'db' => dbname);

$primaryKey = 'id';

if (isset($_GET['tbl_users_a'])) {
    $table = ($_SESSION['offices_id'] == 1) ? "view_users_a" : "(select * from view_users_a WHERE `offices_id` == " . $_SESSION['offices_id'] . ") AS view_users ";

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
    $table = "(SELECT * FROM view_helpdesks WHERE requested_by = " . $_SESSION['id'] . ") AS tbl_helpdesks";

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
    $table = "(SELECT * FROM view_meetings WHERE requested_by = " . $_SESSION['id'] . ") AS tbl_meetings";

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
    $table = "(SELECT * FROM view_helpdesks WHERE serviced_by = " . $_SESSION['id'] . " OR serviced_by IS NULL) AS tbl_helpdesks";

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
        // array(
        //     'db' => 'csf_status',
        //     'dt' => 6,
        //     'formatter' => function ($d, $row) {
        //         return '<center><span class="badge text-bg-' . ($d == 1 ? 'success' : 'warning') . '">' . ($d == 1 ? 'Completed' : 'Pending') . '</span></center>';
        //     }
        // ),
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
    $table = "view_meetings";

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

if (isset($_GET['tbl_request_types'])) {
    $table = "view_request_types";

    $columns = array(
        array('db' => 'id', 'dt' => null),
        array('db' => 'request_type', 'dt' => 0),
        array(
            'db' => 'id',
            'dt' => 1,
            'formatter' => function ($d, $row) {
                $html = '<p class="text-nowrap small text-end"><button type="button" class="btn btn-primary mx-1 my-0 small" onclick="updreqtypebtn(' . $row['id'] . ')"><i class="bi bi-pencil-square small"></i></button>';
                $html .= '<button type="button" class="btn btn-danger mx-1 my-0 small" onclick="delreqtypebtn(' . $row['id'] . ')"><i class="bi bi-trash3-fill small"></i></button></p>';

                return $html;
            }
        )
    );
}

if (isset($_GET['tbl_categories'])) {
    $table = "view_categories";

    $columns = array(
        array('db' => 'id', 'dt' => null),
        array('db' => 'category', 'dt' => 0),
        array('db' => 'request_type', 'dt' => 1),
        array(
            'db' => 'id',
            'dt' => 2,
            'formatter' => function ($d, $row) {
                $html = '<p class="text-nowrap small text-end"><button type="button" class="btn btn-primary mx-1 my-0 small" onclick="updreqtypebtn(' . $row['id'] . ')"><i class="bi bi-pencil-square small"></i></button>';
                $html .= '<button type="button" class="btn btn-danger mx-1 my-0 small" onclick="delreqtypebtn(' . $row['id'] . ')"><i class="bi bi-trash3-fill small"></i></button></p>';

                return $html;
            }
        )
    );
}

if (isset($_GET['tbl_sub_categories'])) {
    $table = "view_sub_categories";

    $columns = array(
        array('db' => 'id', 'dt' => null),
        array('db' => 'sub_category', 'dt' => 0),
        array('db' => 'category', 'dt' => 1),
        array(
            'db' => 'id',
            'dt' => 2,
            'formatter' => function ($d, $row) {
                $html = '<p class="text-nowrap small text-end"><button type="button" class="btn btn-primary mx-1 my-0 small" onclick="updreqtypebtn(' . $row['id'] . ')"><i class="bi bi-pencil-square small"></i></button>';
                $html .= '<button type="button" class="btn btn-danger mx-1 my-0 small" onclick="delreqtypebtn(' . $row['id'] . ')"><i class="bi bi-trash3-fill small"></i></button></p>';

                return $html;
            }
        )
    );
}


require 'ssp.class.php';

echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
);
