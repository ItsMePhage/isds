<?php
require_once 'config.php';

$response = array();
function create_meeting()
{
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

    $db = new DB();
    $arr_token = $db->get_access_token();
    $accessToken = $arr_token->access_token;

    $topic = $_POST['topic'];
    $date_scheduled = $_POST['date_scheduled'];
    $start_time = $date_scheduled . " " . $_POST['time_start'];
    $end_time = $date_scheduled . " " . $_POST['time_end'];

    $start = new DateTime($start_time);
    $end = new DateTime($end_time);

    $interval = $start->diff($end);
    $minutes = ($interval->h * 60) + $interval->i;

    try {
        // if you have userid of user than change it with me in url
        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ],
            'json' => [
                "topic" => $topic,
                "type" => 2,
                "start_time" => $date_scheduled . "T" . $start_time,
                "duration" => $minutes,
            ],
        ]);

        $data = json_decode($response->getBody());

    } catch (Exception $e) {
        if ('401' == $e->getCode()) {
            $refresh_token = $db->get_refersh_token();
            $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode(CLIENT_ID . ':' . CLIENT_SECRET)
                ],
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "refresh_token" => $refresh_token
                ],
            ]);
            $token = json_decode($response->getBody()->getContents(), true);
            // echo json_encode($token);
            $db->update_access_token(json_encode($token));

            create_meeting();
        } else {
            echo $e->getMessage();
        }

    }

    $response = [
        'zoom_details' => "DTI VI is inviting you to a scheduled Zoom meeting.&#13;&#10;&#13;&#10;Topic: $data->topic&#13;&#10;Time: $data->start_time&#13;&#10;&#13;&#10;Join Zoom Meeting&#13;&#10;$data->join_url&#13;&#10;&#13;&#10;Meeting ID: $data->id&#13;&#10;Passcode: $data->password&#13;&#10;",
        'message' => 'meeting scheduled',
        'status' => 'success'
    ];

    $responseJSON = json_encode($response);

    echo $responseJSON;
}

create_meeting();