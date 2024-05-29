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
    /* general process */
    if (isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT u.*, r.role FROM users u LEFT JOIN roles r ON u.roles_id = r.id WHERE u.username = ? OR u.id_number = ? OR u.email = ?";
        $result = $conn->execute_query($query, [$username, $username, $username]);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_object();

            if (password_verify($password, $row->password)) {
                if (password_verify($password, $row->password)) {

                }
                if ($row->is_active == 1) {

                    if (!empty($row->password_exp)) {
                        $current = new DateTime();
                        $expiry = new DateTime($row->password_exp);

                        if ($current > $expiry) {
                            $response = [
                                'status' => 'warning',
                                'message' => 'Password has expired.'
                            ];
                        } else {
                            $conn->query('UPDATE `users` SET `password_exp` = NULL WHERE `id` = ' . $row->id);
                            $_SESSION['id'] = $row->id;
                            $_SESSION['role'] = $row->role;

                            $response = [
                                'status' => 'success',
                                'message' => 'Login successful.',
                                'redirect' => $row->role . '/dashboard.php'
                            ];
                        }
                    } else {
                        $_SESSION['id'] = $row->id;
                        $_SESSION['role'] = $row->role;

                        $response = [
                            'status' => 'success',
                            'message' => 'Login successful.',
                            'redirect' => $row->role . '/dashboard.php'
                        ];
                    }


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
        $designation = $_POST['designation'];
        $offices_id = $_POST['offices_id'];
        $divisions_id = $_POST['divisions_id'];
        $client_types_id = $_POST['client_types_id'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_ARGON2I);

        $query = "SELECT * FROM users WHERE username = ? OR  email = ?";
        $result = $conn->execute_query($query, [$username, $username]);

        if ($result && $result->num_rows < 1) {
            $query = "INSERT INTO `users` (`id_number`,`first_name`,`middle_name`,`last_name`,`designation`,`offices_id`,`divisions_id`,`client_types_id`,`date_birth`,`sex`,`is_pwd`,`phone`,`email`,`address`,`username`,`password`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $result = $conn->execute_query($query, [$id_number, $first_name, $middle_name, $last_name, $designation, $offices_id, $divisions_id, $client_types_id, $date_birth, $sex, $is_pwd, $phone, $email, $address, $username, $password]);

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

    if (isset($_POST['forgot_password'])) {
        $username = $_POST['username'];

        $query = "SELECT * FROM `users` WHERE `username` = ? OR `email` = ?";
        $result = $conn->execute_query($query, [$username, $username]);

        if ($result->num_rows) {
            $password = generatePassword();
            $password_hashed = password_hash($password, PASSWORD_ARGON2I);
            $password_exp = date("Y-m-d H:i:s", strtotime("+2 minutes"));

            $query2 = "UPDATE `users` SET `password` = ?, `password_exp` = ? WHERE `email` = ?";
            $result2 = $conn->execute_query($query2, [$password_hashed, $password_exp, $username]);

            $query3 = $conn->execute_query($query, [$username, $username]);

            while ($user = $query3->fetch_object()) {
                $Subject = "DTI6 MIS | Temporary Password";

                $Message = "";
                $Message .= "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p>";
                $Message .= "<hr>";
                $Message .= "<div>";
                $Message .= "<div>Good day!,</div>";
                $Message .= "<br>";
                $Message .= "<div>You have requested a temporary password. Please use the temporary password below to login:</div>";
                $Message .= "<br><br>";
                $Message .= "<div>Username: " . $user->username . "</div>";
                $Message .= "<div>Password: " . $password . "</div>";
                $Message .= "<br><br>";
                $Message .= "<div>For security reasons, we recommend that you change your password after your first login.</div>";
                $Message .= "<div><a href='http://r6itbpm.site/DTI6-MIS/index.php'>Click here</a> to login. Thank you.</div>";
                $Message .= "<br><br>";
                $Message .= "<div>Best Regards,</div>";
                $Message .= "<br>";
                $Message .= "<div>DTI6 MIS Administrator</div>";
                $Message .= "<div>IT Support Staff</div>";
                $Message .= "<div>DTI Region VI</div>";
                $Message .= "<br><hr>";
                $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div>";
                $Message .= "</div>";

                sendEmail($user->email, $Subject, $Message);
            }

            $response['status'] = 'success';
            $response['message'] = 'Temporary password sent!';
            $response['redirect'] = 'login.php';
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Email not found!'
            ];
        }
    }

    if (isset($_POST['change_username'])) {
        $username = $_POST['username'];

        $query = "SELECT * FROM users WHERE username = ? AND id != ?";
        $result = $conn->execute_query($query, [$username, $_SESSION['id']]);

        if ($result && $result->num_rows == 0) {
            $query = "UPDATE `users` SET `username` = ? WHERE `id` = ?";
            $result = $conn->execute_query($query, [$username, $_SESSION['id']]);
            $response = [
                'status' => 'success',
                'message' => 'Username updated.'
            ];
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Username already exist.'
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
                        'message' => 'Password updated.'
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
        $date_birth = $_POST['date_birth'];
        $sex = $_POST['sex'];
        $is_pwd = isset($_POST['is_pwd']) ? 1 : 0;
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $designation = $_POST['designation'];
        $offices_id = $_POST['offices_id'];
        $divisions_id = $_POST['divisions_id'];
        $client_types_id = $_POST['client_types_id'];

        $query = "SELECT * 
        FROM users 
        WHERE id_number = ? AND id != ?";

        $result = $conn->execute_query($query, [$id_number, $_SESSION['id']]);

        if (!$result->num_rows) {
            $query = "SELECT * 
            FROM users 
            WHERE email = ? AND id <> ?";

            $result = $conn->execute_query($query, [$email, $_SESSION['id']]);

            if (!$result->num_rows) {
                $query = "UPDATE `users` SET `id_number` = ?, `first_name` = ?, `middle_name` = ?, `last_name` = ?, `date_birth` = ?, `sex` = ?, `is_pwd` = ?, `phone` = ?, `email` = ?, `address` = ?, `designation` = ?, `offices_id` = ?, `divisions_id` = ?, `client_types_id` = ? WHERE `id` = ?";

                $result = $conn->execute_query($query, [$id_number, $first_name, $middle_name, $last_name, $date_birth, $sex, $is_pwd, $phone, $email, $address, $designation, $offices_id, $divisions_id, $client_types_id, $_SESSION['id']]);
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

    if (isset($_POST['add_helpdesks'])) {
        switch ($_SESSION['role']) {
            case 'employee':
                $requested_by = $_SESSION['id'];
                $date_requested = $_POST['date_requested'];
                $request_types_id = $_POST['request_types_id'];
                $categories_id = $_POST['categories_id'];
                $sub_categories_id = $_POST['sub_categories_id'];
                $complaint = $_POST['complaint'];
                $datetime_preferred = !empty($_POST['datetime_preferred']) ? $_POST['datetime_preferred'] : date('Y-m-d H:i:s');

                $query = "INSERT INTO helpdesks(`requested_by`,`date_requested`,`request_types_id`,`categories_id`,`sub_categories_id`,`complaint`,`datetime_preferred`) VALUE (?,?,?,?,?,?,?)";
                $result = $conn->execute_query($query, [$requested_by, $date_requested, $request_types_id, $categories_id, $sub_categories_id, $complaint, $datetime_preferred]);

                $response = [
                    'status' => 'success',
                    'message' => 'Request submitted.',
                    'redirect' => '../employee/helpdesks.php'
                ];
                break;
            case 'admin':
                $requested_by = !empty($_POST['requested_by']) ? $_POST['requested_by'] : $_SESSION['id'];
                $date_requested = $_POST['date_requested'];
                $request_types_id = $_POST['request_types_id'];
                $categories_id = $_POST['categories_id'];
                $sub_categories_id = $_POST['sub_categories_id'];
                $complaint = $_POST['complaint'];
                $datetime_preferred = !empty($_POST['datetime_preferred']) ? $_POST['datetime_preferred'] : date('Y-m-d H:i:s');
                $h_statuses_id = !empty($_POST['h_statuses_id']) ? $_POST['h_statuses_id'] : 1;
                $property_number = $_POST['property_number'];
                $priority_levels_id = !empty($_POST['priority_levels_id']) ? $_POST['priority_levels_id'] : NULL;
                $repair_types_id = !empty($_POST['repair_types_id']) ? $_POST['repair_types_id'] : NULL;
                $repair_classes_id = !empty($_POST['repair_classes_id']) ? $_POST['repair_classes_id'] : NULL;
                $mediums_id = !empty($_POST['mediums_id']) ? $_POST['mediums_id'] : NULL;
                $datetime_start = !empty($_POST['datetime_start']) ? $_POST['datetime_start'] : NULL;
                $is_pullout = isset($_POST['is_pullout']) ? 1 : NULL;
                $datetime_end = !empty($_POST['datetime_end']) ? $_POST['datetime_end'] : NULL;
                $is_turnover = isset($_POST['is_turnover']) ? 1 : NULL;
                $diagnosis = $_POST['diagnosis'];
                $action_taken = $_POST['action_taken'];
                $remarks = $_POST['remarks'];

                $query = "INSERT INTO helpdesks(`requested_by`,`date_requested`,`request_types_id`,`categories_id`,`sub_categories_id`,`complaint`,`datetime_preferred`,`h_statuses_id`,`property_number`,`priority_levels_id`,`repair_types_id`,`repair_classes_id`,`mediums_id`,`datetime_start`,`is_pullout`,`datetime_end`,`is_turnover`,`diagnosis`,`action_taken`,`remarks`) VALUE (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $result = $conn->execute_query($query, [$requested_by, $date_requested, $request_types_id, $categories_id, $sub_categories_id, $complaint, $datetime_preferred, $h_statuses_id, $property_number, $priority_levels_id, $repair_types_id, $repair_classes_id, $mediums_id, $datetime_start, $is_pullout, $datetime_end, $is_turnover, $diagnosis, $action_taken, $remarks]);

                $response = [
                    'status' => 'success',
                    'message' => 'Request submitted.',
                    'redirect' => '../admin/helpdesks.php'
                ];
                break;
        }
    }

    if (isset($_POST['upd_helpdesks'])) {

        switch ($_SESSION['role']) {
            case 'employee':
                $upd_helpdesks_id = $_POST['upd_helpdesks_id'];
                $date_requested = $_POST['date_requested'];
                $request_types_id = $_POST['request_types_id'];
                $categories_id = $_POST['categories_id'];
                $sub_categories_id = $_POST['sub_categories_id'];
                $complaint = $_POST['complaint'];
                $datetime_preferred = !empty($_POST['datetime_preferred']) ? $_POST['datetime_preferred'] : date('Y-m-d H:i:s');

                $query = "UPDATE `helpdesks` SET `date_requested` = ?, `request_types_id` = ?, `categories_id` = ?, `sub_categories_id` = ?, `complaint` = ?, `datetime_preferred` = ? WHERE `id` = ?";
                $result = $conn->execute_query($query, [$date_requested, $request_types_id, $categories_id, $sub_categories_id, $complaint, $datetime_preferred, $upd_helpdesks_id]);

                $response = [
                    'status' => 'success',
                    'message' => 'Request updated.',
                    'redirect' => '../employee/helpdesks.php'
                ];
                break;
            case 'admin':
                $helpdesks_id = $_POST['upd_helpdesks_id'];
                $requested_by = !empty($_POST['requested_by']) ? $_POST['requested_by'] : $_SESSION['id'];
                $date_requested = $_POST['date_requested'];
                $request_types_id = $_POST['request_types_id'];
                $categories_id = $_POST['categories_id'];
                $sub_categories_id = $_POST['sub_categories_id'];
                $complaint = $_POST['complaint'];
                $datetime_preferred = !empty($_POST['datetime_preferred']) ? $_POST['datetime_preferred'] : date('Y-m-d H:i:s');
                $h_statuses_id = !empty($_POST['h_statuses_id']) ? $_POST['h_statuses_id'] : 1;
                $property_number = $_POST['property_number'];
                $priority_levels_id = !empty($_POST['priority_levels_id']) ? $_POST['priority_levels_id'] : NULL;
                $repair_types_id = !empty($_POST['repair_types_id']) ? $_POST['repair_types_id'] : NULL;
                $repair_classes_id = !empty($_POST['repair_classes_id']) ? $_POST['repair_classes_id'] : NULL;
                $mediums_id = !empty($_POST['mediums_id']) ? $_POST['mediums_id'] : NULL;
                $datetime_start = !empty($_POST['datetime_start']) ? $_POST['datetime_start'] : NULL;
                $is_pullout = isset($_POST['is_pullout']) ? 1 : NULL;
                $datetime_end = !empty($_POST['datetime_end']) ? $_POST['datetime_end'] : NULL;
                $is_turnover = isset($_POST['is_turnover']) ? 1 : NULL;
                $diagnosis = $_POST['diagnosis'];
                $action_taken = $_POST['action_taken'];
                $remarks = $_POST['remarks'];


                $query = "UPDATE `helpdesks` SET `requested_by` = ?, `date_requested` = ?, `request_types_id` = ?, `categories_id` = ?, `sub_categories_id` = ?, `complaint` = ?, `datetime_preferred` = ?, `h_statuses_id` = ?, `property_number` = ?, `priority_levels_id` = ?, `repair_types_id` = ?, `repair_classes_id` = ?, `mediums_id` = ?, `datetime_start` = ?, `is_pullout` = ?, `datetime_end` = ?, `is_turnover` = ?, `diagnosis` = ?, `action_taken` = ?, `remarks` = ? WHERE `id` = ?";
                $result = $conn->execute_query($query, [$requested_by, $date_requested, $request_types_id, $categories_id, $sub_categories_id, $complaint, $datetime_preferred, $h_statuses_id, $property_number, $priority_levels_id, $repair_types_id, $repair_classes_id, $mediums_id, $datetime_start, $is_pullout, $datetime_end, $is_turnover, $diagnosis, $action_taken, $remarks, $helpdesks_id]);

                $response = [
                    'status' => 'success',
                    'message' => 'Request updated.',
                    'redirect' => '../admin/helpdesks.php'
                ];
                break;
        }
    }

    if (isset($_POST['del_helpdesks'])) {
        $helpdesks_id = $_POST['helpdesks_id'];

        $conn->query("SET @audit_user_id = " . (int) $_SESSION['id']);

        $query = "DELETE FROM helpdesks WHERE id = ?";
        $result = $conn->execute_query($query, [$helpdesks_id]);

        $response = [
            'status' => 'success',
            'message' => 'Request deleted.',
            'redirect' => '../employee/helpdesks.php'
        ];
    }

    if (isset($_POST['add_meetings'])) {
        switch ($_SESSION['role']) {
            case 'employee':
                $requested_by = $_SESSION['id'];
                $date_requested = $_POST['date_requested'];
                $topic = $_POST['topic'];
                $date_scheduled = $_POST['date_scheduled'];
                $time_start = $_POST['time_start'];
                $time_end = $_POST['time_end'];

                $query = "SELECT * FROM meetings WHERE date_scheduled = ? AND ( ( time_start < ? AND time_end > ? ) OR ( time_start < ? AND time_end > ? ) OR ( time_start >= ? AND time_end <= ? ))";

                $result = $conn->execute_query($query, [$date_scheduled, $time_start, $time_end, $time_start, $time_end, $time_start, $time_end]);
                if ($result->num_rows == 0) {
                    $query = "INSERT INTO meetings(`requested_by`,`topic`,`date_requested`,`date_scheduled`,`time_start`,`time_end`) VALUE (?,?,?,?,?,?)";
                    $result = $conn->execute_query($query, [$requested_by, $topic, $date_requested, $date_scheduled, $time_start, $time_end]);

                    $response = [
                        'status' => 'success',
                        'message' => 'Request submitted.',
                        'redirect' => '../employee/meetings.php'
                    ];
                } else {
                    $response = [
                        'status' => 'warning',
                        'message' => 'Conflict meeting.'
                    ];
                }
                break;
            case 'admin':
                $requested_by = !empty($_POST['requested_by']) ? $_POST['requested_by'] : $_SESSION['id'];
                $date_requested = $_POST['date_requested'];
                $topic = $_POST['topic'];
                $date_scheduled = $_POST['date_scheduled'];
                $time_start = $_POST['time_start'];
                $time_end = $_POST['time_end'];
                $hosts_id = !empty($_POST['hosts_id']) ? $_POST['hosts_id'] : NULL;
                $m_statuses_id = !empty($_POST['m_statuses_id']) ? $_POST['m_statuses_id'] : 1;
                $meeting_details = $_POST['meeting_details'];

                $query = "SELECT * FROM meetings WHERE date_scheduled = ? AND ( ( time_start < ? AND time_end > ? ) OR ( time_start < ? AND time_end > ? ) OR ( time_start >= ? AND time_end <= ? ))";

                $result = $conn->execute_query($query, [$date_scheduled, $time_start, $time_end, $time_start, $time_end, $time_start, $time_end]);
                if ($result->num_rows == 0) {
                    $query = "INSERT INTO meetings(`requested_by`,`topic`,`date_requested`,`date_scheduled`,`time_start`,`time_end`,`hosts_id`,`m_statuses_id`,`meeting_details`) VALUE (?,?,?,?,?,?,?,?,?)";
                    $result = $conn->execute_query($query, [$requested_by, $topic, $date_requested, $date_scheduled, $time_start, $time_end, $hosts_id, $m_statuses_id, $meeting_details]);

                    $response = [
                        'status' => 'success',
                        'message' => 'Request submitted.',
                        'redirect' => '../admin/meetings.php'
                    ];
                } else {
                    $response = [
                        'status' => 'warning',
                        'message' => 'Conflict meeting.'
                    ];
                }
                break;
        }
    }

    if (isset($_POST['upd_meetings'])) {
        $upd_meetings_id = $_POST['upd_meetings_id'];
        $date_requested = $_POST['date_requested'];
        $topic = $_POST['topic'];
        $date_scheduled = $_POST['date_scheduled'];
        $time_start = $_POST['time_start'];
        $time_end = $_POST['time_end'];
        $query = "SELECT * FROM meetings WHERE date_scheduled = ? AND ( ( time_start < ? AND time_end > ? ) OR ( time_start < ? AND time_end > ? ) OR ( time_start >= ? AND time_end <= ? ))";

        $result = $conn->execute_query($query, [$date_scheduled, $time_start, $time_end, $time_start, $time_end, $time_start, $time_end]);
        if ($result->num_rows == 0) {
            $query = "UPDATE meetings SET date_requested = ?, topic = ?, date_scheduled = ?, time_start = ?, time_end = ? FROM meetings WHERE id = ?";
            $result = $conn->execute_query($query, [$upd_meetings_id]);

            $response = [
                'status' => 'success',
                'message' => 'Request updated.',
                'redirect' => '../employee/meetings.php'
            ];
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Conflict meeting.'
            ];
        }
    }

    if (isset($_POST['del_meetings'])) {
        $meetings_id = $_POST['meetings_id'];

        $conn->query("SET @audit_user_id = " . (int) $_SESSION['id']);

        $query = "DELETE FROM meetings WHERE id = ?";
        $result = $conn->execute_query($query, [$meetings_id]);

        $response = [
            'status' => 'success',
            'message' => 'Request deleted.',
            'redirect' => '../employee/meetings.php'
        ];
    }

    if (isset($_POST['add_users'])) {
        $id_number = $_POST['id_number'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $date_birth = $_POST['date_birth'];
        $sex = $_POST['sex'];
        $is_pwd = $_POST['is_pwd'] ?? null;
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $designation = $_POST['designation'];
        $offices_id = $_POST['offices_id'];
        $divisions_id = $_POST['divisions_id'];
        $client_types_id = $_POST['client_types_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_hashed = password_hash($_POST['password'], PASSWORD_ARGON2I);

        $roles_id = $_POST['roles_id'];

        $query = "SELECT * FROM users WHERE username = ? OR  email = ?";
        $result = $conn->execute_query($query, [$username, $username]);

        if ($result && $result->num_rows < 1) {
            $query = "INSERT INTO `users` (`id_number`,`first_name`,`middle_name`,`last_name`,`designation`,`offices_id`,`divisions_id`,`client_types_id`,`date_birth`,`sex`,`is_pwd`,`phone`,`email`,`address`,`username`,`password`,`roles_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $result = $conn->execute_query($query, [$id_number, $first_name, $middle_name, $last_name, $designation, $offices_id, $divisions_id, $client_types_id, $date_birth, $sex, $is_pwd, $phone, $email, $address, $username, $password_hashed, $roles_id]);

            $response = [
                'status' => 'success',
                'message' => 'Register successful.',
                'redirect' => 'users.php'
            ];
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Username or Email already exist.'
            ];
        }
    }

    if (isset($_POST['upd_users'])) {
        $upd_users_id = $_POST['upd_users_id'];
        $id_number = $_POST['id_number'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $date_birth = $_POST['date_birth'];
        $sex = $_POST['sex'];
        $is_pwd = $_POST['is_pwd'] ?? null;
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $designation = $_POST['designation'];
        $offices_id = $_POST['offices_id'];
        $divisions_id = $_POST['divisions_id'];
        $client_types_id = $_POST['client_types_id'];
        $roles_id = $_POST['roles_id'];

        // Check for existing username or email to avoid duplication
        $query = "SELECT * FROM users WHERE email = ? AND id <> ?";
        $result = $conn->execute_query($query, [$email, $upd_users_id]);

        if ($result && $result->num_rows < 1) {
            $query = "UPDATE `users` SET `id_number` = ?, `first_name` = ?, `middle_name` = ?, `last_name` = ?, `designation` = ?, `offices_id` = ?, `divisions_id` = ?, `client_types_id` = ?, `date_birth` = ?, `sex` = ?, `is_pwd` = ?, `phone` = ?, `email` = ?, `address` = ?, `roles_id` = ? WHERE `id` = ?";
            $result = $conn->execute_query($query, [$id_number, $first_name, $middle_name, $last_name, $designation, $offices_id, $divisions_id, $client_types_id, $date_birth, $sex, $is_pwd, $phone, $email, $address, $roles_id, $users_id]);

            if ($result) {
                $response = [
                    'status' => 'success',
                    'message' => 'Update successful.',
                    'redirect' => 'users.php'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Update failed. Please try again.'
                ];
            }
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Email already exists.'
            ];
        }
    }

    if (isset($_POST['reset_password'])) {
        $users_id = $_POST['users_id'];

        $query = "SELECT * FROM `users` WHERE `id` = ?";
        $result = $conn->execute_query($query, [$users_id]);

        if ($result->num_rows) {
            $password = generatePassword();
            $password_hashed = password_hash($password, PASSWORD_ARGON2I);
            $password_exp = date("Y-m-d H:i:s", strtotime("+2 minutes"));

            $query2 = "UPDATE `users` SET `password` = ?, `password_exp` = ? WHERE `id` = ?";
            $result2 = $conn->execute_query($query2, [$password_hashed, $password_exp, $users_id]);

            $query3 = $conn->execute_query($query, [$users_id]);

            while ($acc = $query3->fetch_object()) {
                $Subject = "DTI6 MIS | Reset Password";

                $Message = "";
                $Message .= "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p>";
                $Message .= "<hr>";
                $Message .= "<div>";
                $Message .= "<div>Good day!,</div>";
                $Message .= "<br>";
                $Message .= "<div>You have requested a reset password. Please use the temporary password below to login:</div>";
                $Message .= "<br><br>";
                $Message .= "<div>username: " . $acc->username . "</div>";
                $Message .= "<div>Password: " . $password . "</div>";
                $Message .= "<br><br>";
                $Message .= "<div>For security reasons, we recommend that you change your password after your first login.</div>";
                $Message .= "<div><a href='http://r6itbpm.site/DTI6-MIS/index.php'>Click here</a> to login. Thank you.</div>";
                $Message .= "<br><br>";
                $Message .= "<div>Best Regards,</div>";
                $Message .= "<br>";
                $Message .= "<div>DTI6 MIS Administrator</div>";
                $Message .= "<div>IT Support Staff</div>";
                $Message .= "<div>DTI Region VI</div>";
                $Message .= "<br><hr>";
                $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div>";
                $Message .= "</div>";

                sendEmail($acc->email, $Subject, $Message);
            }

            $response['status'] = 'success';
            $response['message'] = 'Reset password sent!';
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Email not found!'
            ];
        }
    }

} else {
    $response = [
        'status' => 'warning',
        'message' => 'robot verification failed.',
        'reload' => true
    ];
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
