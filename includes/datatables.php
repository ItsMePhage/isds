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


require 'ssp.class.php';

echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
);