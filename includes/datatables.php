<?php
require_once "conn.php";

session_start();

$dbDetails = array('host' => servername, 'user' => username, 'pass' => password, 'db' => dbname);

$primaryKey = 'id';

if (isset($_GET['users_table'])) {

    $table = ($_SESSION['offices_id'] == 1)
        ? "users_info"
        : "(SELECT * FROM users_info WHERE offices_id = " . $_SESSION['offices_id'] . ") AS users_info";
    $table = ($_SESSION['offices_id'] == 1)
        ? "users_info"
        : "(SELECT * FROM users_info WHERE offices_id = " . $_SESSION['offices_id'] . ") AS users_info";

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
                $html = '<div class="btn-group" role="group" aria-label="User Actions">';
                $html .= '<button type="button" class="btn btn-primary" onclick="updusersbtn(' . $d . ')"><i class="bi bi-pencil-square"></i></button>';
                $html .= '<button type="button" class="btn btn-warning" onclick="rstusersbtn(' . $d . ')"><i class="bi bi-key"></i></button>';
                $html .= '<button type="button" class="btn btn-danger" onclick="delusersbtn(' . $d . ')"><i class="bi bi-trash3-fill"></i></button>';
                $html .= '</div>';

                return $html;
            }
        )
    );
}

if (isset($_GET['csf_report_table'])) {
    $table = ($_SESSION['offices_id'] == 1)
        ? "csf_report"
        : "(SELECT * FROM csf_report WHERE requested_by = " . $_SESSION['isds_id'] . " AND offices_id = " . $_SESSION['offices_id'] . ") AS csf_report";

    $columns = array(
        array('db' => 'id', 'dt' => 0),
        array(
            'db' => 'requested_by_name',
            'dt' => 1,
            'formatter' => function ($d, $row) {
                return "<span class='text-nowrap'>" . $d . "</span>";
            }
        ),
        array(
            'db' => 'age',
            'dt' => 2,
            'formatter' => function ($d, $row) {
                $birthDate = new DateTime($d);
                $today = new DateTime();
                $age = $today->diff($birthDate)->y;

                return $age;
            }
        ),
        array('db' => 'sex', 'dt' => 3),
        array('db' => 'client_type', 'dt' => 4),
        array('db' => 'responsiveness', 'dt' => 5),
        array('db' => 'assurance', 'dt' => 6),
        array('db' => 'integrity', 'dt' => 7),
        array('db' => 'reliability', 'dt' => 8),
        array('db' => 'outcome', 'dt' => 9),
        array('db' => 'access_to_facilities', 'dt' => 10),
        array('db' => 'comms', 'dt' => 11),
        array('db' => 'overall', 'dt' => 12),
        array('db' => 'reasons', 'dt' => 13),
        array('db' => 'comments', 'dt' => 14)
    );
}

if (isset($_GET['helpdesks_report_table'])) {
    switch ($_GET['helpdesks_report_table']) {
        case 'mjr':
            $table = "(SELECT * FROM helpdesks_info WHERE offices_id = " . $_SESSION['offices_id'] . " AND request_types_id = 1) AS helpdesks_info";
            break;
        case 'ois':
            $table = "(SELECT * FROM helpdesks_info WHERE offices_id = " . $_SESSION['offices_id'] . " AND request_types_id = 2) AS helpdesks_info";
            break;
    }


    $columns = array(
        array('db' => 'id', 'dt' => 0),
        array('db' => 'office', 'dt' => 1),
        array('db' => 'request_number', 'dt' => 2),
        array('db' => 'requested_by_name', 'dt' => 3),
        array('db' => 'requested_by_email', 'dt' => 4),
        array('db' => 'date_requested', 'dt' => 5),
        array('db' => 'request_type', 'dt' => 6),
        array('db' => 'category', 'dt' => 7),
        array('db' => 'sub_category', 'dt' => 8),
        array('db' => 'complaint', 'dt' => 9),
        array('db' => 'datetime_preferred', 'dt' => 10),
        array('db' => 'status_color', 'dt' => null),
        array('db' => 'status', 'dt' => 11),
        array('db' => 'csf_id', 'dt' => 12),
        array('db' => 'property_number', 'dt' => 13),
        array('db' => 'priority_level', 'dt' => 14),
        array('db' => 'repair_type', 'dt' => 15),
        array('db' => 'repair_class', 'dt' => 16),
        array('db' => 'medium', 'dt' => 17),
        array('db' => 'serviced_by_name', 'dt' => 18),
        array('db' => 'approved_by_name', 'dt' => 19),
        array('db' => 'datetime_start', 'dt' => 20),
        array('db' => 'is_pullout', 'dt' => 21),
        array('db' => 'datetime_end', 'dt' => 22),
        array('db' => 'is_turnover', 'dt' => 23),
        array('db' => 'diagnosis', 'dt' => 24),
        array('db' => 'action_taken', 'dt' => 25),
        array('db' => 'remarks', 'dt' => 26),
    );
}

if (isset($_GET['accomplishment_report_table'])) {
    $table = "(SELECT * FROM helpdesks_info WHERE serviced_by = " . $_SESSION['isds_id'] . ") AS helpdesks_info";

    $columns = array(
        array('db' => 'date_requested', 'dt' => 0),
        array('db' => 'request_number', 'dt' => 1),
        array('db' => 'requested_by_name', 'dt' => 2),
        array('db' => 'division', 'dt' => 3),
        array('db' => 'request_type', 'dt' => 4),
        array('db' => 'category', 'dt' => 5),
        array('db' => 'sub_category', 'dt' => 6),
        array('db' => 'complaint', 'dt' => 7),
        array('db' => 'diagnosis', 'dt' => 8),
        array('db' => 'action_taken', 'dt' => 9),
        array(
            'db' => 'status',
            'dt' => 10,
            'formatter' => function ($d, $row) {
                return '<center><span class="w-100 badge text-bg-' . (($d === 'Completed') ? 'success' : 'warning') . '">' . $d . '</span></center>';
            }
        ),
        array(
            'db' => 'csf_overall',
            'dt' => 11,
            'formatter' => function ($d, $row) {
                $labels = [
                    1 => ['text' => 'Very Dissatisfied', 'class' => 'text-bg-danger'],
                    2 => ['text' => 'Dissatisfied', 'class' => 'text-bg-warning'],
                    3 => ['text' => 'Satisfied', 'class' => 'text-bg-info'],
                    4 => ['text' => 'Very Satisfied', 'class' => 'text-bg-success']
                ];

                $label = isset($labels[$d]) ? $labels[$d] : ['text' => 'Pending', 'class' => 'text-bg-secondary'];

                return '<center><span class="w-100 badge ' . $label['class'] . '">' . $label['text'] . '</span></center>';
            }
        ),

    );
}

if (isset($_GET['helpdesks_table'])) {
    switch ($_SESSION['role']) {
        case 'admin':
            $table = ($_SESSION['offices_id'] == 1)
                ? "helpdesks_info"
                : "(SELECT * FROM helpdesks_info WHERE offices_id = " . $_SESSION['offices_id'] . ") AS helpdesks_info";

            $columns = array(
                array(
                    'db' => 'date_requested',
                    'dt' => 0,
                    'formatter' => function ($d, $row) {
                        return date_format(date_create($d), 'd/m/Y');
                    }
                ),
                array(
                    'db' => 'request_number',
                    'dt' => 1,
                    'formatter' => function ($d, $row) {
                        return '<a href="#" onclick="viewhelpdesksbtn(' . $row['id'] . ')"><span><u>' . $d . '</u></span></a>';
                    }
                ),
                array('db' => 'category', 'dt' => 2),
                array('db' => 'sub_category', 'dt' => 3),
                array(
                    'db' => 'status',
                    'dt' => 4,
                    'formatter' => function ($d, $row) {
                        return '<center><span class="w-100 badge text-bg-' . $row['status_color'] . '">' . $d . '</span></center>';
                    }
                ),
                array(
                    'db' => 'csf_id',
                    'dt' => 5,
                    'formatter' => function ($d, $row) {
                        return '<center><span class="w-100 badge text-bg-' . ($d != null ? 'success' : 'warning') . '">' . ($d != null ? 'Responded' : 'Pending') . '</span></center>';
                    }
                ),
                array('db' => 'requested_by_name', 'dt' => 6),
                array('db' => 'serviced_by_name', 'dt' => 7),
                array('db' => 'status_color', 'dt' => null),
                array('db' => 'request_types_id', 'dt' => null),
                array('db' => 'datetime_start', 'dt' => null),
                array('db' => 'complaint', 'dt' => null),
                array('db' => 'diagnosis', 'dt' => null),
                array('db' => 'property_number', 'dt' => null),
                array('db' => 'action_taken', 'dt' => null),
                array('db' => 'remarks', 'dt' => null),
                array('db' => 'division', 'dt' => null),
                array(
                    'db' => 'id',
                    'dt' => 8,
                    'formatter' => function ($d, $row) {
                        $editBtn = '<button type="button" class="btn btn-primary" onclick="updhelpdesksbtn(' . $row['id'] . ')"><i class="bi bi-pencil-square"></i></button>';
                        $deleteBtn = '<button type="button" class="btn btn-danger" onclick="delhelpdesksbtn(' . $row['id'] . ', \'' . $row['request_number'] . '\')"><i class="bi bi-trash3-fill"></i></button>';

                        // Print Button Handling
                        $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                        if ($row['status'] == "Pre-repair") {
                            $printBtn = '<button type="button" class="btn btn-info" onclick=\'printpribtn(' . $rowJson . ')\'> <i class="bi bi-printer"></i> </button>';
                        } elseif ($row['request_types_id'] == 1) {
                            $printBtn = '<button type="button" class="btn btn-info" onclick=\'printmjrbtn(' . $rowJson . ')\'> <i class="bi bi-printer"></i> </button>';
                        } elseif ($row['request_types_id'] == 2) {
                            $printBtn = '<button type="button" class="btn btn-info" onclick=\'printoisbtn(' . $rowJson . ')\'> <i class="bi bi-printer"></i> </button>';
                        } else {
                            $printBtn = '';
                        }

                        // Feedback Button
                        $feedbackBtn = $row['csf_id'] === null
                            ? '<button type="button" class="btn btn-warning" onclick="window.open(\'/isds/csf.php?reqno=' . $d . '\', \'_blank\')"><i class="bi bi-list-check"></i></button>'
                            : '<button type="button" class="btn btn-success" onclick="window.open(\'/isds/view_csf.php?reqno=' . $d . '\', \'_blank\')"><i class="bi bi-list-check"></i></button>';

                        // Generate Button Group
                        $html = '<div class="btn-group" role="group">';

                        if ($row['status'] === 'Completed') {
                            $html .= "{$editBtn}{$feedbackBtn}{$deleteBtn}";
                        } else {
                            $html .= "{$editBtn}{$printBtn}{$deleteBtn}";
                        }

                        $html .= '</div>';
                        return $html;
                    }
                )
            );
            break;
        case 'employee':
        case 'VIP':
            $table = "(SELECT * FROM helpdesks_info WHERE requested_by = " . $_SESSION['isds_id'] . ") AS helpdesks_info";

            $columns = array(
                array(
                    'db' => 'date_requested',
                    'dt' => 0,
                    'formatter' => function ($d, $row) {
                        return date_format(date_create($d), 'd/m/Y');
                    }
                ),
                array(
                    'db' => 'request_number',
                    'dt' => 1,
                    'formatter' => function ($d, $row) {
                        return '<a href="#" onclick="viewhelpdesksbtn(' . $row['id'] . ')"><span><u>' . $d . '</u></span></a>';
                    }
                ),
                array('db' => 'category', 'dt' => 2),
                array('db' => 'sub_category', 'dt' => 3),
                array(
                    'db' => 'status',
                    'dt' => 4,
                    'formatter' => function ($d, $row) {
                        return '<center><span class="w-100 badge text-bg-' . $row['status_color'] . '">' . $d . '</span></center>';
                    }
                ),
                array(
                    'db' => 'csf_id',
                    'dt' => 5,
                    'formatter' => function ($d, $row) {
                        return '<center><span class="w-100 badge text-bg-' . ($d != null ? 'success' : 'warning') . '">' . ($d != null ? 'Responded' : 'Pending') . '</span></center>';
                    }
                ),
                array('db' => 'requested_by_name', 'dt' => null),
                array('db' => 'serviced_by_name', 'dt' => null),
                array('db' => 'status_color', 'dt' => null),
                array('db' => 'request_types_id', 'dt' => null),
                array('db' => 'datetime_start', 'dt' => null),
                array('db' => 'complaint', 'dt' => null),
                array('db' => 'diagnosis', 'dt' => null),
                array('db' => 'property_number', 'dt' => null),
                array('db' => 'action_taken', 'dt' => null),
                array('db' => 'remarks', 'dt' => null),
                array('db' => 'division', 'dt' => null),
                array(
                    'db' => 'id',
                    'dt' => 6,
                    'formatter' => function ($d, $row) {
                        $editBtn = '<button type="button" class="btn btn-primary" onclick="updhelpdesksbtn(' . $row['id'] . ')"><i class="bi bi-pencil-square"></i></button>';
                        $deleteBtn = '<button type="button" class="btn btn-danger" onclick="delhelpdesksbtn(' . $row['id'] . ', \'' . $row['request_number'] . '\')"><i class="bi bi-trash3-fill"></i></button>';

                        // Secure JSON encoding
                        $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');

                        // Print Button Logic (Consolidated)
                        $printBtn = ($row['status'] === "Pre-repair") ? '<button type="button" class="btn btn-info" onclick=\'printpribtn(' . $rowJson . ')\'><i class="bi bi-printer"></i></button>'
                            : (($row['request_types_id'] == 1) ? '<button type="button" class="btn btn-info" onclick=\'printmjrbtn(' . $rowJson . ')\'><i class="bi bi-printer"></i></button>'
                                : (($row['request_types_id'] == 2) ? '<button type="button" class="btn btn-info" onclick=\'printoisbtn(' . $rowJson . ')\'><i class="bi bi-printer"></i></button>'
                                    : ''));

                        // Feedback Button Logic
                        $feedbackBtn = ($row['csf_id'] === null)
                            ? '<button type="button" class="btn btn-warning" onclick="window.open(\'/isds/csf.php?reqno=' . $d . '\', \'_blank\')"><i class="bi bi-list-check"></i></button>'
                            : '<button type="button" class="btn btn-success" onclick="window.open(\'/isds/view_csf.php?reqno=' . $d . '\', \'_blank\')"><i class="bi bi-list-check"></i></button>';

                        // Generate Button Group
                        $html = '<div class="btn-group" role="group">';

                        if (in_array($row['status'], ['Open', 'Cancelled'])) {
                            $html .= "{$editBtn}{$printBtn}{$deleteBtn}";
                        } elseif (in_array($row['status'], ['Unserviceable', 'Pending', 'Pre-repair', 'Completed'])) {
                            $html .= "{$printBtn}{$feedbackBtn}";
                        }

                        $html .= '</div>';
                        return $html;
                    }
                )

            );
            break;
    }
}

if (isset($_GET['meetings_table'])) {
    switch ($_SESSION['role']) {
        case 'admin':
            $table = ($_SESSION['offices_id'] == 1)
                ? "meetings_info"
                : "(SELECT * FROM meetings_info WHERE offices_id = " . $_SESSION['offices_id'] . ") AS meetings_info";

            $columns = array(
                array(
                    'db' => 'date_requested',
                    'dt' => 0,
                    'formatter' => function ($d, $row) {
                        return date_format(date_create($d), 'd/m/Y');
                    }
                ),
                array(
                    'db' => 'request_number',
                    'dt' => 1,
                    'formatter' => function ($d, $row) {
                        return '<a href="#" onclick="viewMeeting(' . $row['id'] . ')"><span><u>' . $d . '</u></span></a>';
                    }
                ),
                array('db' => 'topic', 'dt' => 2),
                array('db' => 'time_start', 'dt' => null),
                array('db' => 'time_end', 'dt' => null),
                array(
                    'db' => 'date_scheduled',
                    'dt' => 3,
                    'formatter' => function ($d, $row) {
                        return date_format(date_create($d), 'd/m/Y') . ' | ' . date_format(date_create($row['time_start']), 'h:i a') . '-' . date_format(date_create($row['time_end']), 'h:i a');
                    }
                ),
                array('db' => 'status_color', 'dt' => null),
                array(
                    'db' => 'status',
                    'dt' => 4,
                    'formatter' => function ($d, $row) {
                        return '<center><span class="w-100 badge text-bg-' . $row['status_color'] . '">' . $d . '</span></center>';
                    }
                ),
                array('db' => 'host', 'dt' => 5),
                array('db' => 'requested_by_name', 'dt' => 6),
                array(
                    'db' => 'id',
                    'dt' => 7,
                    'formatter' => function ($d, $row) {
                        $editBtn = '<button type="button" class="btn btn-primary" onclick="updmeetingsbtn(' . $row['id'] . ')">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>';

                        $deleteBtn = '<button type="button" class="btn btn-danger" onclick="delmeetingsbtn(' . $row['id'] . ', \'' . $row['request_number'] . '\')">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>';

                        $viewBtn = '<button type="button" class="btn btn-info" onclick="viewMeeting(' . $row['id'] . ')">
                                        <i class="bi bi-eye"></i>
                                    </button>';

                        return '<div class="btn-group" role="group">' . $editBtn . $viewBtn . $deleteBtn . '</div>';
                    }
                )

            );
            break;

        case 'employee':
        case 'VIP':
            $table = "(SELECT * FROM meetings_info WHERE requested_by = " . $_SESSION['isds_id'] . ") AS meetings_info";

            $columns = array(
                array(
                    'db' => 'date_requested',
                    'dt' => 0,
                    'formatter' => function ($d, $row) {
                        return date_format(date_create($d), 'd/m/Y');
                    }
                ),
                array(
                    'db' => 'request_number',
                    'dt' => 1,
                    'formatter' => function ($d, $row) {
                        return '<a href="#" onclick="viewMeeting(' . $row['id'] . ')"><span><u>' . $d . '</u></span></a>';
                    }
                ),
                array('db' => 'topic', 'dt' => 2),
                array('db' => 'time_start', 'dt' => null),
                array('db' => 'time_end', 'dt' => null),
                array(
                    'db' => 'date_scheduled',
                    'dt' => 3,
                    'formatter' => function ($d, $row) {
                        return date_format(date_create($d), 'd/m/Y') . ' | ' . date_format(date_create($row['time_start']), 'h:i a') . '-' . date_format(date_create($row['time_end']), 'h:i a');
                    }
                ),
                array('db' => 'status_color', 'dt' => null),
                array(
                    'db' => 'status',
                    'dt' => 4,
                    'formatter' => function ($d, $row) {
                        return '<center><span class="w-100 badge text-bg-' . $row['status_color'] . '">' . $d . '</span></center>';
                    }
                ),
                array('db' => 'host', 'dt' => 5),
                array(
                    'db' => 'id',
                    'dt' => 6,
                    'formatter' => function ($d, $row) {
                        $viewBtn = '<button type="button" class="btn btn-info" onclick="viewMeeting(' . $row['id'] . ')">
                                        <i class="bi bi-eye"></i>
                                    </button>';

                        // Show edit and delete buttons only if status is "Pending"
                        $editBtn = $deleteBtn = '';
                        if ($row['status'] === 'Pending') {
                            $editBtn = '<button type="button" class="btn btn-primary" onclick="updmeetingsbtn(' . $row['id'] . ')">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>';

                            $deleteBtn = '<button type="button" class="btn btn-danger" onclick="delmeetingsbtn(' . $row['id'] . ', \'' . $row['request_number'] . '\')">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>';
                        }

                        return '<div class="btn-group text-end" role="group">' . $editBtn . $viewBtn . $deleteBtn . '</div>';
                    }
                )
            );
            break;
    }
}

/*
if (isset($_GET['meeting_table'])) {
    $table = "(SELECT * FROM view_meetings WHERE requested_by = " . $_SESSION['isds_id'] . ") AS tbl_meetings";

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
        array('db' => 'requested_by', 'dt' => 1),
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
*/

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
