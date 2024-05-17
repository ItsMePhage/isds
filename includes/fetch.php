<?php

// get connection
require_once 'conn.php';

session_start();

$response = array();

if (isset($_GET['select_data'])) {
    switch ($_GET['select_data']) {
        case 'request_type_id':
            $query = "SELECT * FROM request_types";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $row->name = $row->request_type;
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
        case 'offices_id':
            $query = "SELECT * FROM offices";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $row->name = $row->office;
                $response[] = $row;
            }
            break;
        case 'roles_id':
            $query = "SELECT * FROM roles";
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $row->name = $row->role;
                $response[] = $row;
            }
            break;
        case 'category_id':
            $query = "SELECT * FROM categories WHERE request_type_id = " . $_GET['request_type_id'];
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $row->name = $row->category;
                $response[] = $row;
            }
            break;
        case 'sub_category_id':
            $query = "SELECT * FROM sub_categories WHERE category_id = " . $_GET['category_id'];
            $result = $conn->execute_query($query);

            while ($row = $result->fetch_object()) {
                $row->name = $row->sub_category;
                $response[] = $row;
            }
            break;
    }
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
