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

        $query = "SELECT u.*, r.role FROM users u LEFT JOIN roles r ON u.roles_id = r.id WHERE u.username = ? OR u.email = ?";
        $result = $conn->execute_query($query, [$username, $username]);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_object();

            if (password_verify($password, $row->password)) {
                if ($row->is_active == 1) {

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
        $id_number = $_POST['id_number'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $date_birth = $_POST['date_birth'];
        $sex = $_POST['sex'];
        $is_pwd = $_POST['is_pwd'] ?? null;
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $position = $_POST['position'];
        $provinces_id = $_POST['provinces_id'];
        $divisions_id = $_POST['divisions_id'];
        $client_types_id = $_POST['client_types_id'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_ARGON2I);

        $query = "SELECT * FROM users WHERE username = ? OR  email = ?";
        $result = $conn->execute_query($query, [$username, $username]);

        if ($result && $result->num_rows < 1) {
            $query = "INSERT INTO `users` (`id_number`,`first_name`,`middle_name`,`last_name`,`position`,`provinces_id`,`divisions_id`,`client_types_id`,`date_birth`,`sex`,`is_pwd`,`phone`,`email`,`address`,`username`,`password`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $result = $conn->execute_query($query, [$id_number, $first_name, $middle_name, $last_name, $position, $provinces_id, $divisions_id, $client_types_id, $date_birth, $sex, $is_pwd, $phone, $email, $address, $username, $password]);

            $_SESSION['id'] = $conn->insert_id;

            $response = [
                'status' => 'success',
                'message' => 'Register successful.',
                'redirect' => 'employee/dashboard.php'
            ];
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Username or Email already exist.'
            ];
        }
    }

    if (isset($_POST['change_password'])) {
        $password = $_POST['password'];
        $new_password = $_POST['new_password'];
        $ver_password = $_POST['ver_password'];
        $hashed_password = password_hash($new_password, PASSWORD_ARGON2I);

        if ($new_password != $password) {
            if ($ver_password == $new_password) {
                $query = "SELECT * FROM `users` WHERE `id` = ?";
                $result = $conn->execute_query($query, [$_SESSION['id']]);

                $row = $result->fetch_object();

                if (password_verify($password, $row->password)) {

                    $query = "UPDATE `users` SET `password` = ? WHERE `id` = ?";
                    $result = $conn->execute_query($query, [$hashed_password, $_SESSION['id']]);
                    $response = [
                        'status' => 'success',
                        'message' => 'Password updated.',
                        'redirect' => 'dashboard.php'
                    ];
                } else {
                    $response = [
                        'status' => 'warning',
                        'message' => 'Invalid current password.'
                    ];
                }
            } else {
                $response = [
                    'status' => 'warning',
                    'message' => 'Password don\'t match.'
                ];
            }
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Current and New passwords should not be the same.'
            ];
        }
    }

    if (isset($_POST['update_profile'])) {
        $id_number = $_POST['id_number'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $position = $_POST['position'];
        $division_id = $_POST['division_id'];
        $client_type_id = $_POST['client_type_id'];
        $date_birth = $_POST['date_birth'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $sex = $_POST['sex'];
        $address = $_POST['address'];
        $pwd = isset($_POST['pwd']) ? 1 : 0;

        $query = "SELECT * 
    FROM users 
    WHERE id_number = ? AND id != ?";

        $result = $conn->execute_query($query, [$id_number, $_SESSION['id']]);

        if (!$result->num_rows) {
            $query = "SELECT * 
            FROM users 
            WHERE email = ? AND id != ?";

            $result = $conn->execute_query($query, [$email, $_SESSION['id']]);

            if (!$result->num_rows) {
                $query = "UPDATE users
                SET `id_number` = ?, `first_name` = ?, `middle_name` = ?, `last_name` = ?, `position` = ?, `division_id` = ?, `client_type_id` = ?, `date_birth` = ?, `phone` = ?, `email` = ?, `sex` = ?, `address` = ?, `pwd` = ?
                WHERE id = ?";

                $result = $conn->execute_query($query, [$id_number, $first_name, $middle_name, $last_name, $position, $division_id, $client_type_id, $date_birth, $phone, $email, $sex, $address, $pwd, $_SESSION['id']]);
                $response['status'] = 'success';
                $response['message'] = 'User updated successful!';
            } else {
                $response['status'] = 'warning';
                $response['message'] = $email . ' already exist!';
            }
        } else {
            $response['status'] = 'warning';
            $response['message'] = $id_number . ' already exist!';
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