<?php

// get connection
require_once 'conn.php';
require_once 'common_functions.php';

session_start();

$response = array();

if (isset($_POST['captcha-token']) && !empty($_POST['captcha-token'])) {
    $g_response = verifyCaptcha($_POST['captcha-token'], secretkey);
}

if ($g_response == 1) {
    if (isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT u.*, r.role FROM users u LEFT JOIN roles r ON u.role_id = r.id WHERE u.username = ? OR u.email = ?";
        $result = $conn->execute_query($query, [$username, $username]);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_object();

            if (password_verify($password, $row->password)) {
                if ($row->active == 1) {

                    $_SESSION['id'] = $row->id;

                    $response = [
                        'status' => 'success',
                        'message' => 'Login successful.',
                        'redirect' => $row->role . '/dashboard.php'
                    ];
                } else {
                    $response = [
                        'status' => 'warning',
                        'message' => 'Account not activated!'
                    ];
                }
            } else {
                $response = [
                    'status' => 'warning',
                    'message' => 'Invalid password!'
                ];
            }
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Username or Email not found!'
            ];
        }
    }

    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_ARGON2I);

        $query = "SELECT * FROM users WHERE username = ? OR  email = ?";
        $result = $conn->execute_query($query, [$username, $username]);

        if ($result && $result->num_rows < 1) {
            $query = 'INSERT INTO `users`(`username`, `email`, `password`) VALUES(?, ?, ?)';
            $result = $conn->execute_query($query, [$username, $email, $password]);

            $response = [
                'status' => 'success',
                'message' => 'register successful.',
                'redirect' => 'dashboard.php'
            ];
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Username or Email already exist.'
            ];
        }
    }

    

} else {
    $response = [
        'status' => 'warning',
        'message' => 'robot verification failed.'
    ];
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();