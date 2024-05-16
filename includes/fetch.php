<?php

// get connection
require_once 'conn.php';

session_start();

$response = array();

if (isset($_POST['get_provinces'])) {

    $query = "SELECT * FROM provinces";
    $result = $conn->execute_query($query);

    while ($row = $result->fetch_object()) {
        $response[] = $row;
    }
}

if (isset($_POST['get_industry_clusters'])) {

    $query = "SELECT * FROM industry_clusters";
    $result = $conn->execute_query($query);

    while ($row = $result->fetch_object()) {
        $response[] = $row;
    }
}

if (isset($_POST['get_major_business_activities'])) {

    $query = "SELECT * FROM major_business_activities";
    $result = $conn->execute_query($query);

    while ($row = $result->fetch_object()) {
        $response[] = $row;
    }
}

if (isset($_POST['get_edt_levels'])) {

    $query = "SELECT * FROM edt_levels";
    $result = $conn->execute_query($query);

    while ($row = $result->fetch_object()) {
        $response[] = $row;
    }
}

if (isset($_POST['get_asset_sizes'])) {

    $query = "SELECT * FROM asset_sizes";
    $result = $conn->execute_query($query);

    while ($row = $result->fetch_object()) {
        $response[] = $row;
    }
}

if (isset($_POST['get_business_names'])) {
    $province_id = $_POST['province_id'];

    $query = "SELECT * FROM msmes WHERE province_id = ?";
    $result = $conn->execute_query($query, [$province_id]);

    while ($row = $result->fetch_object()) {
        $response[] = $row->business_name;
    }
}

if (isset($_GET['uuid'])) {
    $province_id = $_POST['province_id'];

    $query = "SELECT * FROM msmes WHERE province_id = ?";
    $result = $conn->execute_query($query, [$province_id]);

    while ($row = $result->fetch_object()) {
        $response[] = $row->business_name;
    }
}

if (isset($_POST[""])) {
    $acc_id = $_POST['acc_id'];

    $counts = [
        'helpdesks' => [
            'today' => $conn->query("SELECT COUNT(*) as count_day FROM helpdesks WHERE DATE(date_requested) = CURDATE() AND requested_by = $acc_id")->fetch_object()->count_day,
            'month' => $conn->query("SELECT COUNT(*) as count_month FROM helpdesks WHERE YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE()) AND requested_by = $acc_id")->fetch_object()->count_month,
            'year' => $conn->query("SELECT COUNT(*) as count_year FROM helpdesks WHERE YEAR(date_requested) = YEAR(CURDATE()) AND requested_by = $acc_id")->fetch_object()->count_year,
        ],
        'meetings' => [
            'today' => $conn->query("SELECT COUNT(*) as count_day FROM meetings WHERE DATE(date_requested) = CURDATE() AND requested_by = $acc_id")->fetch_object()->count_day,
            'month' => $conn->query("SELECT COUNT(*) as count_month FROM meetings WHERE YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE()) AND requested_by = $acc_id")->fetch_object()->count_month,
            'year' => $conn->query("SELECT COUNT(*) as count_year FROM meetings WHERE YEAR(date_requested) = YEAR(CURDATE()) AND requested_by = $acc_id")->fetch_object()->count_year,
        ]
    ];
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
