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

if (isset($_GET['tbl_helpdesks'])) {
    $table = "(SELECT 
        h.id, 
        h.request_number, 
        h.requested_by, 
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
        hs.status
    FROM 
        helpdesks h
    LEFT JOIN 
        request_types rt ON h.request_types_id = rt.id
    LEFT JOIN 
        categories c ON h.categories_id = c.id
    LEFT JOIN 
        sub_categories sc ON h.sub_categories_id = sc.id
    LEFT JOIN 
        h_statuses hs ON h.h_statuses_id = hs.id
    WHERE requested_by = " . $_SESSION['id'] . ") AS tbl_helpdesks";

    $columns = array(
        array('db' => 'request_number', 'dt' => 0),
        array('db' => 'date_requested', 'dt' => 1),
        array('db' => 'request_type', 'dt' => 2),
        array('db' => 'category', 'dt' => 3),
        array('db' => 'sub_category', 'dt' => 4),
        array('db' => 'complaint', 'dt' => 5),
        array('db' => 'status', 'dt' => 6)
    );
}
if (isset($_GET['tbl_meetings'])) {
    $table = "(SELECT 
        m.id, 
        m.request_number, 
        m.requested_by, 
        m.date_requested, 
        m.request_types_id, 
        m.categories_id, 
        m.sub_categories_id, 
        m.complaint, 
        m.datetime_preferred, 
        m.h_statuses_id,
        ms.status
    FROM 
        meetings m
    LEFT JOIN 
        request_types rt ON m.request_types_id = rt.id
    LEFT JOIN 
        categories c ON m.categories_id = c.id
    LEFT JOIN 
        sub_categories sc ON m.sub_categories_id = sc.id
    LEFT JOIN 
        h_statuses ms ON m.m_statuses_id = ms.id
    WHERE requested_by = " . $_SESSION['id'] . ") AS tbl_meetings";

    $columns = array(
        array('db' => 'request_number', 'dt' => 0),
        array('db' => 'date_requested', 'dt' => 1),
        array('db' => 'request_type', 'dt' => 2),
        array('db' => 'category', 'dt' => 3),
        array('db' => 'sub_category', 'dt' => 4),
        array('db' => 'complaint', 'dt' => 5),
        array('db' => 'status', 'dt' => 6)
    );
}


require 'ssp.class.php';

echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
);
