<?php
require_once 'config.php';

session_start();

$response = array();

$client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

$db = new DB();
$arr_token = $db->get_access_token();
$accessToken = $arr_token->access_token;

$response = $client->request('POST', '/v2/users/me/meetings', [
    "headers" => [
        "Authorization" => "Bearer $accessToken"
    ],
    'json' => [
        "topic" => $_POST['topic'],
        "type" => 2,
        "start_time" => "2020-06-24T20:30:00",
        "duration" => "30"
    ],
]);

$data = json_decode($response->getBody());

$response = [
    'zoom_details' => "DTI VI is inviting you to a scheduled Zoom meeting.<br><br>Topic: $data->topic<br>Time: $data->start_time<br><br>Join Zoom Meeting<br><a href='$data->join_url'>$data->join_url</a><br><br>Meeting ID: $data->id<br>Passcode: $data->password<br>",
    'message' => 'meeting scheduled',
    'status' => 'success'
];

$responseJSON = json_encode($response);

echo $responseJSON;