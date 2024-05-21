<?php

// get connection
require_once 'conn.php';

session_start();

$response = array();

if (isset($_GET['select_data'])) {
    switch ($_GET['select_data']) {
        case 'offices_id':
            $query = "SELECT * FROM offices";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $row->name = $row->office;
                $response[] = $row;
            }
            break;
        case 'divisions_id':
            $query = "SELECT * FROM divisions";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $row->name = $row->division;
                $response[] = $row;
            }
            break;
        case 'client_types_id':
            $query = "SELECT * FROM client_types";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $row->name = $row->client_type;
                $response[] = $row;
            }
            break;
        case 'request_types_id':
            $query = "SELECT * FROM request_types";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $row->name = $row->request_type;
                $response[] = $row;
            }
            break;
        case 'categories_id':
            $query = "SELECT * FROM categories WHERE request_types_id = " . $_GET['request_types_id'];
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $row->name = $row->category;
                $response[] = $row;
            }
            break;
        case 'sub_categories_id':
            $query = "SELECT * FROM sub_categories WHERE categories_id = " . $_GET['categories_id'];
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $row->name = $row->sub_category;
                $response[] = $row;
            }
            break;
    }
}

if (isset($_GET['meetings'])) {
    $query = "SELECT * FROM meetings WHERE requested_by = " . $_SESSION['id'];
    $result = $conn->execute_query($query);

    while ($row = $result->fetch_object()) {
        $row->title = $row->topic;
        $row->start = $row->date_scheduled . "T" . $row->time_start;
        $row->end = $row->date_scheduled . "T" . $row->time_end;
        $response[] = $row;
    }
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
