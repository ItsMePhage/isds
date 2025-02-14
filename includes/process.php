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

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $query = "SELECT * FROM `users_info` WHERE `username` = ? OR `id_number` = ? OR `email` = ?";
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
                            $_SESSION['isds_id'] = $row->id;
                            $_SESSION['role'] = $row->role;

                            $response = [
                                'status' => 'success',
                                'message' => 'Login successful.',
                                'redirect' => ($row->roles_id == 1 ? 'admin' : 'user') . '/dashboard.php'
                            ];
                        }
                    } else {
                        $_SESSION['isds_id'] = $row->id;
                        $_SESSION['role'] = $row->role;

                        $response = [
                            'status' => 'success',
                            'message' => 'Login successful.',
                            'redirect' => ($row->roles_id == 1 ? 'admin' : 'user') . '/dashboard.php'
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

        $query = "SELECT * FROM `users_info` WHERE `username` = ? OR `email` = ?";
        $result = $conn->execute_query($query, [$username, $username]);

        if ($result && $result->num_rows < 1) {
            $query = "INSERT INTO `users` (`id_number`,`first_name`,`middle_name`,`last_name`,`designation`,`offices_id`,`divisions_id`,`client_types_id`,`date_birth`,`sex`,`is_pwd`,`phone`,`email`,`address`,`username`,`password`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $result = $conn->execute_query($query, [$id_number, $first_name, $middle_name, $last_name, $designation, $offices_id, $divisions_id, $client_types_id, $date_birth, $sex, $is_pwd, $phone, $email, $address, $username, $password]);

            $_SESSION['isds_id'] = $conn->insert_id;

            $response = [
                'status' => 'success',
                'message' => 'Register successful.',
                'redirect' => 'user/dashboard.php'
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

        $query = "SELECT * FROM `users_info` WHERE `username` = ? OR `email` = ?";
        $result = $conn->execute_query($query, [$username, $username]);

        if ($result->num_rows) {
            $password = generatePassword();
            $password_hashed = password_hash($password, PASSWORD_ARGON2I);
            $password_exp = date("Y-m-d H:i:s", strtotime("+2 minutes"));

            $query2 = "UPDATE `users` SET `password` = ?, `password_exp` = ? WHERE `email` = ?";
            $result2 = $conn->execute_query($query2, [$password_hashed, $password_exp, $username]);

            $query3 = $conn->execute_query($query, [$username, $username]);

            while ($user = $query3->fetch_object()) {
                $Subject = "DTI6 ISDS: Temporary Password";

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
                $Message .= "<div><a href='http://r6itbpm.site/isds/index.php'>Click here</a> to login. Thank you.</div>";
                $Message .= "<br><br>";
                $Message .= "<div>Best Regards,</div>";
                $Message .= "<br>";
                $Message .= "<div>DTI6 MIS Administrator</div>";
                $Message .= "<div>IT Support VIP</div>";
                $Message .= "<div>DTI Region VI</div>";
                $Message .= "<br><hr>";
                $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div>";
                $Message .= "</div>";

                sendEmail($user->email, $Subject, $Message);
            }

            $response['status'] = 'success';
            $response['message'] = 'Temporary password sent.';
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

        $query = "SELECT * FROM `users_info` WHERE userna`me = ? AND `id` != ?";
        $result = $conn->execute_query($query, [$username, $_SESSION['isds_id']]);

        if ($result && $result->num_rows == 0) {
            $query = "UPDATE `users` SET `username` = ? WHERE `id` = ?";
            $result = $conn->execute_query($query, [$username, $_SESSION['isds_id']]);
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
                $query = "SELECT * FROM `users_info` WHERE `id` = ?";
                $result = $conn->execute_query($query, [$_SESSION['isds_id']]);

                $row = $result->fetch_object();

                if (password_verify($password, $row->password)) {

                    $query = "UPDATE `users` SET `password` = ? WHERE `id` = ?";
                    $result = $conn->execute_query($query, [$hashed_password, $_SESSION['isds_id']]);
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

        $query = "SELECT * FROM `users_info` WHERE `id_number` = ? AND `id` != ?";

        $result = $conn->execute_query($query, [$id_number, $_SESSION['isds_id']]);

        if (!$result->num_rows) {
            $query = "SELECT * FROM `users_info` WHERE `email` = ? AND `id` <> ?";

            $result = $conn->execute_query($query, [$email, $_SESSION['isds_id']]);

            if (!$result->num_rows) {
                $query = "UPDATE `users` SET `id_number` = ?, `first_name` = ?, `middle_name` = ?, `last_name` = ?, `date_birth` = ?, `sex` = ?, `is_pwd` = ?, `phone` = ?, `email` = ?, `address` = ?, `designation` = ?, `offices_id` = ?, `divisions_id` = ?, `client_types_id` = ? WHERE `id` = ?";

                $result = $conn->execute_query($query, [$id_number, $first_name, $middle_name, $last_name, $date_birth, $sex, $is_pwd, $phone, $email, $address, $designation, $offices_id, $divisions_id, $client_types_id, $_SESSION['isds_id']]);
                $response['status'] = 'success';
                $response['message'] = 'User updated successfully.';
            } else {
                $response['status'] = 'warning';
                $response['message'] = 'Email already exist.';
            }
        } else {
            $response['status'] = 'warning';
            $response['message'] = 'ID Number already exist.';
        }
    }

    if (isset($_POST['add_helpdesk'])) {
        switch ($_SESSION['role']) {
            case 'employee':
            case 'VIP':
                $requested_by = $_SESSION['isds_id'];
                $offices_id = $_SESSION['offices_id'];
                $date_requested = $_POST['date_requested'];
                $request_types_id = $_POST['request_types_id'];
                $categories_id = $_POST['categories_id'];
                $sub_categories_id = $_POST['sub_categories_id'];
                $complaint = str_replace("'", "&apos;", $_POST['complaint']);
                $datetime_preferred = !empty($_POST['datetime_preferred']) ? $_POST['datetime_preferred'] : date('Y-m-d H:i:s');

                $query = "INSERT INTO helpdesks(`requested_by`,`date_requested`,`request_types_id`,`categories_id`,`sub_categories_id`,`complaint`,`datetime_preferred`,`offices_id`) VALUE (?,?,?,?,?,?,?,?)";
                $result = $conn->execute_query($query, [$requested_by, $date_requested, $request_types_id, $categories_id, $sub_categories_id, $complaint, $datetime_preferred, $offices_id]);

                $helpdesks_id = $conn->insert_id;

                $query = "SELECT * FROM `helpdesks_info` WHERE `id` = ?";
                $result = $conn->execute_query($query, [$helpdesks_id]);

                $row = $result->fetch_object();

                $row->date_requested = new DateTime($row->date_requested);
                $row->datetime_preferred = new DateTime($row->datetime_preferred);

                $Subject = "[$row->status] DTI6 ISDS ICT REQUEST: " . $row->request_number;

                $Message = "";
                $Message .= "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p>";
                $Message .= "<hr>";
                $Message .= "<div>";
                $Message .= "<p>Good day $row->requested_by_name,</p>";
                $Message .= "<div>Thank you for reaching out to MIS.</div>";
                switch ($row->status) {
                    case 'Open':
                        $Message .= "<p>Your request ({$row->request_number}) has been successfully submitted. Our team will review it and get back to you soon.</p>";
                        break;
                    case 'Cancelled':
                        $Message .= "<p>Your request ({$row->request_number}) has been cancelled. If you need further assistance, please submit a new request or contact our support team.</p>";
                        break;
                    case 'Pending':
                        $Message .= "<p>Your request ({$row->request_number}) is currently pending. Please provide the required information to proceed.</p>";
                        break;
                    case 'Pre-repair':
                        $Message .= "<p>Your request ({$row->request_number}) is now scheduled for servicing. Our team will begin work on the assigned date.</p>";
                        break;
                    case 'Completed':
                        $Message .= "<p>Your request ({$row->request_number}) has been completed. Please take a moment to fill out our feedback form:</p>";
                        $Message .= "<p><a href='http://r6itbpm.site/isds/csf.php?reqno={$row->id}' style='font-size: 18pt;'>Online CSF Form</a></p>";
                        break;
                    case 'Unserviceable':
                        $Message .= "<p>We regret to inform you that your request ({$row->request_number}) has been marked as unserviceable. Please contact support for alternative solutions.</p>";
                        break;
                }
                $Message .= "<br>";
                $Message .= "<h3><strong>Request Details</strong></h3>";
                $Message .= "<ul>";
                $Message .= "<li><strong>Date of Request:</strong> " . $row->date_requested->format('d/m/Y') . "</li>";
                $Message .= "<li><strong>Type of Request:</strong> " . $row->request_type . "</li>";
                $Message .= "<li><strong>Category of Request:</strong> " . $row->category . "</li>";
                $Message .= "<li><strong>Sub-Category of Request:</strong> " . $row->sub_category . "</li>";
                $Message .= "<li><strong>Description:</strong> " . $row->complaint . "</li>";
                $Message .= "<li><strong>Preferred Date and Time:</strong> " . $row->datetime_preferred->format('d/m/Y h:i A') . "</li>";
                $Message .= "<li><strong>Status:</strong> <span style='color: " . $row->status_hex . "'>" . $row->status . "</span></li>";
                $Message .= "<li><strong>Serviced by:</strong> " . $row->serviced_by_name . "</li>";
                $Message .= "</ul>";
                $Message .= "<p>We will process your request and get back to you as soon as possible.</p>";
                $Message .= "<p>To access your account, please click the button below:</p>";
                $Message .= "<a href='http://r6itbpm.site/isds/login.php'><u>Click Here to Login</u></a>";
                $Message .= "<br><br>";
                $Message .= "<p>Best Regards,</p>";
                $Message .= "<div>DTI6 MIS Administrator</div>";
                $Message .= "<div>DTI Region VI</div>";
                $Message .= "<hr>";
                $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div>";
                $Message .= "</div>";

                sendEmail('dti6.mis@gmail.com', $Subject, $Message);

                $response = [
                    'status' => 'success',
                    'message' => 'Request submitted.',
                    'redirect' => '../user/helpdesks.php'
                ];
                break;
            case 'admin':
                $requested_by = !empty($_POST['requested_by']) ? $_POST['requested_by'] : $_SESSION['isds_id'];
                $offices_id = $_SESSION['offices_id'];
                $date_requested = $_POST['date_requested'];
                $request_types_id = $_POST['request_types_id'];
                $categories_id = $_POST['categories_id'];
                $sub_categories_id = $_POST['sub_categories_id'];
                $complaint = str_replace("'", "&apos;", $_POST['complaint']);
                $datetime_preferred = !empty($_POST['datetime_preferred']) ? $_POST['datetime_preferred'] : date('Y-m-d H:i:s');
                $h_statuses_id = !empty($_POST['h_statuses_id']) ? $_POST['h_statuses_id'] : 1;
                $property_number = $_POST['property_number'];
                $priority_levels_id = !empty($_POST['priority_levels_id']) ? $_POST['priority_levels_id'] : NULL;
                $repair_types_id = !empty($_POST['repair_types_id']) ? $_POST['repair_types_id'] : NULL;
                $repair_classes_id = !empty($_POST['repair_classes_id']) ? $_POST['repair_classes_id'] : NULL;
                $mediums_id = !empty($_POST['mediums_id']) ? $_POST['mediums_id'] : NULL;
                $serviced_by = (empty($h_statuses_id) || $h_statuses_id == 1) ? null : $_SESSION['isds_id'];
                $datetime_start = !empty($_POST['datetime_start']) ? $_POST['datetime_start'] : NULL;
                $is_pullout = isset($_POST['is_pullout']) ? 1 : NULL;
                $datetime_end = !empty($_POST['datetime_end']) ? $_POST['datetime_end'] : NULL;
                $is_turnover = isset($_POST['is_turnover']) ? 1 : NULL;
                $diagnosis = str_replace("'", "&apos;", $_POST['diagnosis']);
                $action_taken = str_replace("'", "&apos;", $_POST['action_taken']);
                $remarks = str_replace("'", "&apos;", $_POST['remarks']);

                $query = "INSERT INTO helpdesks(`requested_by`,`date_requested`,`request_types_id`,`categories_id`,`sub_categories_id`,`complaint`,`datetime_preferred`,`h_statuses_id`,`property_number`,`priority_levels_id`,`repair_types_id`,`repair_classes_id`,`mediums_id`,`serviced_by`,`datetime_start`,`is_pullout`,`datetime_end`,`is_turnover`,`diagnosis`,`action_taken`,`remarks`, `offices_id`) VALUE (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $result = $conn->execute_query($query, [$requested_by, $date_requested, $request_types_id, $categories_id, $sub_categories_id, $complaint, $datetime_preferred, $h_statuses_id, $property_number, $priority_levels_id, $repair_types_id, $repair_classes_id, $mediums_id, $serviced_by, $datetime_start, $is_pullout, $datetime_end, $is_turnover, $diagnosis, $action_taken, $remarks, $offices_id]);

                $helpdesks_id = $conn->insert_id;

                if (isset($_POST['send_email'])) {
                    $query = "SELECT * FROM `helpdesks_info` WHERE `id` = ?";
                    $result = $conn->execute_query($query, [$helpdesks_id]);

                    $row = $result->fetch_object();

                    $row->date_requested = new DateTime($row->date_requested);
                    $row->datetime_preferred = new DateTime($row->datetime_preferred);
                    $row->datetime_start = new DateTime($row->datetime_start);
                    $row->datetime_end = new DateTime($row->datetime_end);

                    $Subject = "[$row->status] DTI6 ISDS ICT REQUEST: " . $row->request_number;

                    $Message = "";
                    $Message .= "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p>";
                    $Message .= "<hr>";
                    $Message .= "<div>";
                    $Message .= "<p>Good day $row->requested_by_name,</p>";
                    $Message .= "<br>";
                    $Message .= "<div>Thank you for reaching out to MIS.</div>";
                    switch ($row->status) {
                        case 'Open':
                            $Message .= "<p>Your request ({$row->request_number}) has been successfully submitted. Our team will review it and get back to you soon.</p>";
                            break;
                        case 'Cancelled':
                            $Message .= "<p>Your request ({$row->request_number}) has been cancelled. If you need further assistance, please submit a new request or contact our support team.</p>";
                            break;
                        case 'Pending':
                            $Message .= "<p>Your request ({$row->request_number}) is currently pending. Please provide the required information to proceed.</p>";
                            break;
                        case 'Pre-repair':
                            $Message .= "<p>Your request ({$row->request_number}) is now scheduled for servicing. Our team will begin work on the assigned date.</p>";
                            break;
                        case 'Completed':
                            $Message .= "<p>Your request ({$row->request_number}) has been completed. Please take a moment to fill out our feedback form:</p>";
                            $Message .= "<p><a href='http://r6itbpm.site/isds/csf.php?reqno={$row->id}' style='font-size: 18pt;'>Online CSF Form</a></p>";
                            break;
                        case 'Unserviceable':
                            $Message .= "<p>We regret to inform you that your request ({$row->request_number}) has been marked as unserviceable. Please contact support for alternative solutions.</p>";
                            break;
                    }
                    $Message .= "<br>";
                    $Message .= "<h3><strong>Request Details</strong></h3>";
                    $Message .= "<ul>";
                    $Message .= "<li><strong>Date of Request:</strong> " . $row->date_requested->format('d/m/Y') . "</li>";
                    $Message .= "<li><strong>Type of Request:</strong> " . $row->request_type . "</li>";
                    $Message .= "<li><strong>Category of Request:</strong> " . $row->category . "</li>";
                    $Message .= "<li><strong>Sub-Category of Request:</strong> " . $row->sub_category . "</li>";
                    $Message .= "<li><strong>Description:</strong> " . $row->complaint . "</li>";
                    $Message .= "<li><strong>Preferred Date and Time:</strong> " . $row->datetime_preferred->format('d/m/Y h:i A') . "</li>";
                    $Message .= "</ul>";
                    $Message .= "<h3><strong>Action Details</strong></h3>";
                    $Message .= "<ul>";
                    $Message .= "<li><strong>Status:</strong> <span style='color: " . $row->status_hex . "'>" . $row->status . "</span></li>";
                    $Message .= "<li><strong>Property Number:</strong> " . $row->property_number . "</li>";
                    $Message .= "<li><strong>Urgency:</strong> " . $row->priority_level . "</li>";
                    $Message .= "<li><strong>Mode of Request:</strong> " . $row->medium . "</li>";
                    $Message .= "<li><strong>Date & Time Started:</strong> " . $row->datetime_start->format('d/m/Y h:i A') . "</li>";
                    $Message .= "<li><strong>Pulled Out:</strong> " . ($row->is_pullout != null ? 'Yes' : 'No') . "</li>";
                    $Message .= "<li><strong>Date & Time Finished:</strong> " . $row->datetime_end->format('d/m/Y h:i A') . "</li>";
                    $Message .= "<li><strong>Turned Over:</strong> " . ($row->is_turnover != null ? 'Yes' : 'No') . "</li>";
                    $Message .= "<li><strong>Diagnosis:</strong> " . $row->diagnosis . "</li>";
                    $Message .= "<li><strong>Action Taken:</strong> " . $row->action_taken . "</li>";
                    $Message .= "<li><strong>Remarks:</strong> " . $row->remarks . "</li>";
                    $Message .= "<li><strong>Serviced by:</strong> " . $row->serviced_by_name . "</li>";
                    $Message .= "</ul>";
                    $Message .= "<p>To access your account, please click the button below:</p>";
                    $Message .= "<a href='http://r6itbpm.site/isds/'><u>Click Here to Login</u></a>";
                    $Message .= "<br><br>";
                    $Message .= "<p>Best Regards,</p>";
                    $Message .= "<div>DTI6 MIS Administrator</div>";
                    $Message .= "<div>DTI Region VI</div>";
                    $Message .= "<hr>";
                    $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div>";
                    $Message .= "</div>";

                    sendEmail($row->requested_by_email, $Subject, $Message);
                }

                $response = [
                    'status' => 'success',
                    'message' => 'Request submitted.',
                    'redirect' => '../admin/helpdesks.php'
                ];
                break;
        }
    }

    if (isset($_POST['upd_helpdesk'])) {

        switch ($_SESSION['role']) {
            case 'employee':
            case 'VIP':
                $upd_helpdesk_id = $_POST['upd_helpdesk_id'];
                $date_requested = $_POST['date_requested'];
                $request_types_id = $_POST['request_types_id'];
                $categories_id = $_POST['categories_id'];
                $sub_categories_id = $_POST['sub_categories_id'];
                $complaint = str_replace("'", "&apos;", $_POST['complaint']);
                $datetime_preferred = !empty($_POST['datetime_preferred']) ? $_POST['datetime_preferred'] : date('Y-m-d H:i:s');

                $query = "UPDATE `helpdesks` SET `date_requested` = ?, `request_types_id` = ?, `categories_id` = ?, `sub_categories_id` = ?, `complaint` = ?, `datetime_preferred` = ? WHERE `id` = ?";
                $result = $conn->execute_query($query, [$date_requested, $request_types_id, $categories_id, $sub_categories_id, $complaint, $datetime_preferred, $upd_helpdesk_id]);

                $response = [
                    'status' => 'success',
                    'message' => 'Request updated.',
                    'redirect' => '../user/helpdesks.php'
                ];
                break;
            case 'admin':
                $helpdesks_id = $_POST['upd_helpdesk_id'];
                $requested_by = !empty($_POST['requested_by']) ? $_POST['requested_by'] : $_SESSION['isds_id'];
                $date_requested = $_POST['date_requested'];
                $request_types_id = $_POST['request_types_id'];
                $categories_id = $_POST['categories_id'];
                $sub_categories_id = $_POST['sub_categories_id'];
                $complaint = str_replace("'", "&apos;", $_POST['complaint']);
                $datetime_preferred = !empty($_POST['datetime_preferred']) ? $_POST['datetime_preferred'] : date('Y-m-d H:i:s');
                $h_statuses_id = !empty($_POST['h_statuses_id']) ? $_POST['h_statuses_id'] : 1;
                $property_number = $_POST['property_number'];
                $priority_levels_id = !empty($_POST['priority_levels_id']) ? $_POST['priority_levels_id'] : NULL;
                $repair_types_id = !empty($_POST['repair_types_id']) ? $_POST['repair_types_id'] : NULL;
                $repair_classes_id = !empty($_POST['repair_classes_id']) ? $_POST['repair_classes_id'] : NULL;
                $mediums_id = !empty($_POST['mediums_id']) ? $_POST['mediums_id'] : NULL;
                $serviced_by = ($h_statuses_id == 1) ? null : $_SESSION['isds_id'];
                $datetime_start = !empty($_POST['datetime_start']) ? $_POST['datetime_start'] : NULL;
                $is_pullout = isset($_POST['is_pullout']) ? 1 : NULL;
                $datetime_end = !empty($_POST['datetime_end']) ? $_POST['datetime_end'] : NULL;
                $is_turnover = isset($_POST['is_turnover']) ? 1 : NULL;
                $diagnosis = str_replace("'", "&apos;", $_POST['diagnosis']);
                $action_taken = str_replace("'", "&apos;", $_POST['action_taken']);
                $remarks = str_replace("'", "&apos;", $_POST['remarks']);


                $query = "UPDATE `helpdesks` SET `requested_by` = ?, `date_requested` = ?, `request_types_id` = ?, `categories_id` = ?, `sub_categories_id` = ?, `complaint` = ?, `datetime_preferred` = ?, `h_statuses_id` = ?, `property_number` = ?, `priority_levels_id` = ?, `repair_types_id` = ?, `repair_classes_id` = ?, `mediums_id` = ?, `datetime_start` = ?, `is_pullout` = ?, `datetime_end` = ?, `is_turnover` = ?, `diagnosis` = ?, `action_taken` = ?, `serviced_by` = ?, `remarks` = ? WHERE `id` = ?";
                $result = $conn->execute_query($query, [$requested_by, $date_requested, $request_types_id, $categories_id, $sub_categories_id, $complaint, $datetime_preferred, $h_statuses_id, $property_number, $priority_levels_id, $repair_types_id, $repair_classes_id, $mediums_id, $datetime_start, $is_pullout, $datetime_end, $is_turnover, $diagnosis, $action_taken, $serviced_by, $remarks, $helpdesks_id]);

                if (isset($_POST['send_email'])) {
                    $query = "SELECT * FROM `helpdesks_info` WHERE `id` = ?";
                    $result = $conn->execute_query($query, [$helpdesks_id]);

                    $row = $result->fetch_object();

                    $row->date_requested = new DateTime($row->date_requested);
                    $row->datetime_preferred = new DateTime($row->datetime_preferred);
                    $row->datetime_start = new DateTime($row->datetime_start);
                    $row->datetime_end = new DateTime($row->datetime_end);

                    $Subject = "[$row->status] DTI6 ISDS ICT REQUEST: " . $row->request_number;

                    $Message = "";
                    $Message .= "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p>";
                    $Message .= "<hr>";
                    $Message .= "<div>";
                    $Message .= "<p>Good day $row->requested_by_name,</p>";
                    $Message .= "<br>";
                    $Message .= "<div>Thank you for reaching out to MIS.</div>";
                    switch ($row->status) {
                        case 'Open':
                            $Message .= "<p>Your request {$row->request_number} has been successfully submitted. Our team will review it and get back to you soon.</p>";
                            break;
                        case 'Cancelled':
                            $Message .= "<p>Your request {$row->request_number} has been cancelled. If you need further assistance, please submit a new request or contact our support team.</p>";
                            break;
                        case 'Pending':
                            $Message .= "<p>Your request {$row->request_number} is pending and currently in progress.</p>";
                            break;
                        case 'Pre-repair':
                            $Message .= "<p>Your request {$row->request_number} is now scheduled for servicing. Our team will begin work on the assigned date.</p>";
                            break;
                        case 'Completed':
                            $Message .= "<p>Your request {$row->request_number} has been completed. Please take a moment to fill out our feedback form:</p>";
                            $Message .= "<p><a href='http://r6itbpm.site/isds/csf.php?reqno={$row->id}' style='font-size: 18pt;'>Online CSF Form</a></p>";
                            break;
                        case 'Unserviceable':
                            $Message .= "<p>We regret to inform you that your request {$row->request_number} has been marked as unserviceable. Please contact support for alternative solutions.</p>";
                            break;
                    }
                    $Message .= "<h3><strong>Request Details</strong></h3>";
                    $Message .= "<ul>";
                    $Message .= "<li><strong>Date of Request:</strong> " . $row->date_requested->format('d/m/Y') . "</li>";
                    $Message .= "<li><strong>Type of Request:</strong> " . $row->request_type . "</li>";
                    $Message .= "<li><strong>Category of Request:</strong> " . $row->category . "</li>";
                    $Message .= "<li><strong>Sub-Category of Request:</strong> " . $row->sub_category . "</li>";
                    $Message .= "<li><strong>Description:</strong> " . $row->complaint . "</li>";
                    $Message .= "<li><strong>Preferred Date and Time:</strong> " . $row->datetime_preferred->format('d/m/Y h:i A') . "</li>";
                    $Message .= "</ul>";
                    $Message .= "<h3><strong>Action Details</strong></h3>";
                    $Message .= "<ul>";
                    $Message .= "<li><strong>Status:</strong> <span style='color: " . $row->status_hex . "'>" . $row->status . "</span></li>";
                    $Message .= "<li><strong>Property Number:</strong> " . $row->property_number . "</li>";
                    $Message .= "<li><strong>Urgency:</strong> " . $row->priority_level . "</li>";
                    $Message .= "<li><strong>Mode of Request:</strong> " . $row->medium . "</li>";
                    $Message .= "<li><strong>Date & Time Started:</strong> " . $row->datetime_start->format('d/m/Y h:i A') . "</li>";
                    $Message .= "<li><strong>Pulled Out:</strong> " . ($row->is_pullout != null ? 'Yes' : 'No') . "</li>";
                    $Message .= "<li><strong>Date & Time Finished:</strong> " . $row->datetime_end->format('d/m/Y h:i A') . "</li>";
                    $Message .= "<li><strong>Turned Over:</strong> " . ($row->is_turnover != null ? 'Yes' : 'No') . "</li>";
                    $Message .= "<li><strong>Diagnosis:</strong> " . $row->diagnosis . "</li>";
                    $Message .= "<li><strong>Action Taken:</strong> " . $row->action_taken . "</li>";
                    $Message .= "<li><strong>Remarks:</strong> " . $row->remarks . "</li>";
                    $Message .= "<li><strong>Serviced by:</strong> " . $row->serviced_by_name . "</li>";
                    $Message .= "</ul>";
                    $Message .= "<p>To access your account, please click the button below:</p>";
                    $Message .= "<a href='http://r6itbpm.site/isds/'><u>Click Here to Login</u></a>";
                    $Message .= "<br><br>";
                    $Message .= "<p>Best Regards,</p>";
                    $Message .= "<div>DTI6 MIS Administrator</div>";
                    $Message .= "<div>DTI Region VI</div>";
                    $Message .= "<hr>";
                    $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div>";
                    $Message .= "</div>";

                    sendEmail($row->requested_by_email, $Subject, $Message);
                }

                $response = [
                    'status' => 'success',
                    'message' => 'Request updated.',
                    'redirect' => '../admin/helpdesks.php'
                ];
                break;
        }
    }

    if (isset($_POST['del_helpdesk'])) {
        $helpdesks_id = $_POST['helpdesks_id'];

        $conn->query("SET @audit_user_id = " . (int) $_SESSION['isds_id']);

        $query = "DELETE FROM helpdesks WHERE id = ?";
        $result = $conn->execute_query($query, [$helpdesks_id]);

        $response = [
            'status' => 'success',
            'message' => 'Request deleted.',
            'redirect' => '../' . ($_SESSION['role'] == 'admin' ? 'admin' : 'user') . '/helpdesks.php'
        ];
    }

    if (isset($_POST['add_meeting'])) {
        switch ($_SESSION['role']) {
            case 'employee':
            case 'VIP':
                $requested_by = $_SESSION['isds_id'];
                $date_requested = $_POST['date_requested'];
                $topic = str_replace("'", "&apos;", $_POST['topic']);
                $date_scheduled = $_POST['date_scheduled'];
                $time_start = $_POST['time_start'];
                $time_end = $_POST['time_end'];

                $query = "SELECT * FROM `meetings` 
                AND `date_scheduled` = ? 
                AND (
                    (? BETWEEN `time_start` AND `time_end`) -- New start time falls within an existing meeting
                    OR (? BETWEEN `time_start` AND `time_end`) -- New end time falls within an existing meeting
                    OR (`time_start` BETWEEN ? AND ?) -- Existing meeting starts during the new one
                    OR (`time_end` BETWEEN ? AND ?) -- Existing meeting ends during the new one
                )";

                $result = $conn->execute_query($query, [$meetings_id, $date_scheduled, $time_start, $time_end, $time_start, $time_end, $time_start, $time_end]);

                if ($result->num_rows == 0) {
                    $query = "INSERT INTO meetings (`requested_by`, `topic`, `date_requested`, `date_scheduled`, `time_start`, `time_end`)
                              VALUES (?, ?, ?, ?, ?, ?)";
                    $conn->execute_query($query, [$requested_by, $topic, $date_requested, $date_scheduled, $time_start, $time_end]);

                    $meetings_id = $conn->insert_id;

                    $query = "SELECT * FROM `meetings_info` WHERE `id` = ?";
                    $result = $conn->execute_query($query, [$meetings_id]);

                    $row = $result->fetch_object();

                    $row->date_requested = new DateTime($row->date_requested);
                    $row->date_scheduled = new DateTime($row->date_scheduled);
                    $row->time_start = new DateTime($row->time_start);
                    $row->time_end = new DateTime($row->time_end);

                    $Subject = "[$row->status] DTI6 ISDS ZOOM REQUEST: " . $row->request_number;

                    $Message = "";
                    $Message .= "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p>";
                    $Message .= "<hr>";
                    $Message .= "<div>";
                    $Message .= "<p>Good day $row->requested_by_name,</p>";
                    $Message .= "<div>Thank you for reaching out to MIS.</div>";
                    $Message .= "<p>Your meeting request ({$row->request_number}) is currently pending. Please await further confirmation or provide any required details.</p>";
                    $Message .= "<br>";
                    $Message .= "<h3><strong>Zoom Request</strong></h3>";
                    $Message .= "<ul>";
                    $Message .= "<li><strong>Date of Request:</strong> " . $row->date_requested->format('d/m/Y') . "</li>";
                    $Message .= "<li><strong>Topic or Title of meeting</strong> " . $row->topic . "</li>";
                    $Message .= "<li><strong>Date of Schedule</strong> " . $row->date_scheduled->format('d/m/Y') . "</li>";
                    $Message .= "<li><strong>Time of Schedule</strong> " . $row->time_start->format('h:i A') . " - " . $row->time_start->format('h:i A') . "</li>";
                    $Message .= "</ul>";
                    $Message .= "<br>";
                    $Message .= "<p>To access your account, please click the button below:</p>";
                    $Message .= "<a href='http://r6itbpm.site/isds/login.php'><u>Click Here to Login</u></a>";
                    $Message .= "<br><br>";
                    $Message .= "<p>Best Regards,</p>";
                    $Message .= "<div>DTI6 MIS Administrator</div>";
                    $Message .= "<div>DTI Region VI</div>";
                    $Message .= "<hr>";
                    $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div>";
                    $Message .= "</div>";

                    sendEmail($row->requested_by_email, $Subject, $Message);

                    $response = [
                        'status' => 'success',
                        'message' => 'Request submitted.',
                        'redirect' => '../user/meetings.php'
                    ];
                } else {
                    $response = [
                        'status' => 'warning',
                        'message' => 'Conflict meeting.'
                    ];
                }
                break;
            case 'admin':
                $requested_by = !empty($_POST['requested_by']) ? $_POST['requested_by'] : $_SESSION['isds_id'];
                $date_requested = $_POST['date_requested'];
                $topic = str_replace("'", "&apos;", $_POST['topic']);
                $date_scheduled = $_POST['date_scheduled'];
                $time_start = $_POST['time_start'];
                $time_end = $_POST['time_end'];
                $hosts_id = !empty($_POST['hosts_id']) ? $_POST['hosts_id'] : NULL;
                $m_statuses_id = !empty($_POST['m_statuses_id']) ? $_POST['m_statuses_id'] : 1;
                $meeting_details = str_replace("'", "&apos;", $_POST['meeting_details']);
                $generated_by = !empty($_POST['meeting_details']) ? $_SESSION['isds_id'] : null;

                $query = "SELECT * FROM `meetings` 
                AND `date_scheduled` = ? 
                AND (
                    (? BETWEEN `time_start` AND `time_end`) -- New start time falls within an existing meeting
                    OR (? BETWEEN `time_start` AND `time_end`) -- New end time falls within an existing meeting
                    OR (`time_start` BETWEEN ? AND ?) -- Existing meeting starts during the new one
                    OR (`time_end` BETWEEN ? AND ?) -- Existing meeting ends during the new one
                )";

                $result = $conn->execute_query($query, [$meetings_id, $date_scheduled, $time_start, $time_end, $time_start, $time_end, $time_start, $time_end]);

                if ($result->num_rows == 0) {
                    $query = "INSERT INTO meetings (`requested_by`, `topic`, `date_requested`, `date_scheduled`, `time_start`, `time_end`, `hosts_id`, `m_statuses_id`, `meeting_details`,`generated_by`)
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $conn->execute_query($query, [$requested_by, $topic, $date_requested, $date_scheduled, $time_start, $time_end, $hosts_id, $m_statuses_id, $meeting_details, $generated_by]);

                    $meetings_id = $conn->insert_id;

                    if (isset($_POST['send_email'])) {
                        $query = "SELECT * FROM `meetings_info` WHERE `id` = ?";
                        $result = $conn->execute_query($query, [$meetings_id]);

                        $row = $result->fetch_object();

                        $row->date_requested = new DateTime($row->date_requested);
                        $row->date_scheduled = new DateTime($row->date_scheduled);
                        $row->time_start = new DateTime($row->time_start);
                        $row->time_end = new DateTime($row->time_end);
                        $row->meeting_details = htmlspecialchars($row->meeting_details, ENT_QUOTES, 'UTF-8');

                        $Subject = "[$row->status] DTI6 ISDS ZOOM REQUEST: " . $row->request_number;

                        $Message = "";
                        $Message .= "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p>";
                        $Message .= "<hr>";
                        $Message .= "<div>";
                        $Message .= "<p>Good day $row->requested_by_name,</p>";
                        $Message .= "<div>Thank you for reaching out to MIS.</div>";
                        switch ($row->status) {
                            case 'Pending':
                                $Message .= "<p>Your meeting request ({$row->request_number}) is currently pending. Please await further confirmation or provide any required details.</p>";
                                break;
                            case 'Unavailable':
                                $Message .= "<p>Unfortunately, your requested meeting slot ({$row->request_number}) is unavailable. Please select a different time or contact the organizer.</p>";
                                break;
                            case 'Scheduled':
                                $Message .= "<p>Your meeting ({$row->request_number}) has been successfully scheduled. Please check your calendar for details.</p>";
                                break;
                            case 'Cancelled':
                                $Message .= "<p>Your meeting ({$row->request_number}) has been cancelled. If you need to reschedule, please submit a new request.</p>";
                                break;
                        }
                        $Message .= "<br>";
                        $Message .= "<h3><strong>Zoom Request</strong></h3>";
                        $Message .= "<ul>";
                        $Message .= "<li><strong>Date of Request:</strong> " . $row->date_requested->format('d/m/Y') . "</li>";
                        $Message .= "<li><strong>Topic or Title of meeting</strong> " . $row->topic . "</li>";
                        $Message .= "<li><strong>Date of Schedule</strong> " . $row->date_scheduled->format('d/m/Y') . "</li>";
                        $Message .= "<li><strong>Time of Schedule</strong> " . $row->time_start->format('h:i A') . " - " . $row->time_start->format('h:i A') . "</li>";
                        $Message .= "</ul>";
                        $Message .= "<h3><strong>Zoom Details</strong></h3>";
                        $Message .= "<ul>";
                        $Message .= "<li><strong>Status:</strong> <span style='color: " . $row->status_hex . "'>" . $row->status . "</span></li>";
                        $Message .= "<li><strong>Zoom Host:</strong> " . $row->host . "</li>";
                        $Message .= "<li><strong>Zoom Details:</strong><br>" . nl2br($row->meeting_details) . "</li>";
                        $Message .= "<li><strong>Generated by:</strong> " . $row->generated_by_name . "</li>";
                        $Message .= "</ul>";
                        $Message .= "<br>";
                        $Message .= "<p>To access your account, please click the button below:</p>";
                        $Message .= "<a href='http://r6itbpm.site/isds/login.php'><u>Click Here to Login</u></a>";
                        $Message .= "<br><br>";
                        $Message .= "<p>Best Regards,</p>";
                        $Message .= "<div>DTI6 MIS Administrator</div>";
                        $Message .= "<div>DTI Region VI</div>";
                        $Message .= "<hr>";
                        $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div>";
                        $Message .= "</div>";

                        sendEmail($row->requested_by_email, $Subject, $Message);
                    }

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

    if (isset($_POST['upd_meeting'])) {
        switch ($_SESSION['role']) {
            case 'employee':
            case 'VIP':
                $meetings_id = $_POST['meetings_id'];
                $date_requested = $_POST['date_requested'];
                $topic = str_replace("'", "&apos;", $_POST['topic']);
                $date_scheduled = $_POST['date_scheduled'];
                $time_start = $_POST['time_start'];
                $time_end = $_POST['time_end'];

                $query = "SELECT id FROM meetings 
                WHERE date_scheduled = ? 
                AND (
                    (time_start < ? AND time_end > ?)  
                    OR (time_start >= ? AND time_start < ?)  
                    OR (time_end > ? AND time_end <= ?)  
                    OR (time_start <= ? AND time_end >= ?) 
                )
                AND id != ?";

                $result = $conn->execute_query($query, [$date_scheduled, $time_end, $time_start, $time_start, $time_end, $time_start, $time_end, $time_start, $time_end, $meetings_id]);

                if ($result->num_rows > 0) {
                    $query = "UPDATE meetings SET date_requested = ?, topic = ?, date_scheduled = ?, time_start = ?, time_end = ? WHERE id = ?";
                    $conn->execute_query($query, [$date_requested, $topic, $date_scheduled, $time_start, $time_end, $meetings_id]);

                    $response = [
                        'status' => 'success',
                        'message' => 'Meeting request updated successfully.',
                        'reload' => true
                    ];
                } else {
                    $response = [
                        'status' => 'warning',
                        'message' => 'Conflict: Another meeting is scheduled at this time.'
                    ];
                }
                break;
            case 'admin':
                $meetings_id = $_POST['meetings_id'];
                $requested_by = !empty($_POST['requested_by']) ? $_POST['requested_by'] : $_SESSION['isds_id'];
                $date_requested = $_POST['date_requested'];
                $topic = str_replace("'", "&apos;", $_POST['topic']);
                $date_scheduled = $_POST['date_scheduled'];
                $time_start = $_POST['time_start'];
                $time_end = $_POST['time_end'];
                $hosts_id = !empty($_POST['hosts_id']) ? $_POST['hosts_id'] : NULL;
                $m_statuses_id = !empty($_POST['m_statuses_id']) ? $_POST['m_statuses_id'] : 1;
                $meeting_details = str_replace("'", "&apos;", $_POST['meeting_details']);
                $generated_by = $_POST['generated_by'];

                $query = "SELECT id FROM meetings 
                WHERE date_scheduled = ? 
                AND (
                    (time_start < ? AND time_end > ?)  
                    OR (time_start >= ? AND time_start < ?)  
                    OR (time_end > ? AND time_end <= ?)  
                    OR (time_start <= ? AND time_end >= ?) 
                )
                AND id != ?";

                $result = $conn->execute_query($query, [$date_scheduled, $time_end, $time_start, $time_start, $time_end, $time_start, $time_end, $time_start, $time_end, $meetings_id]);



                if ($result->num_rows > 0) {
                    // Update the meeting details
                    $query = "UPDATE `meetings` SET `requested_by` = ?, `topic` = ?, `date_requested` = ?, `date_scheduled` = ?, `time_start` = ?, `time_end` = ?, `hosts_id` = ?, `m_statuses_id` = ?, `meeting_details` = ?, `generated_by` = ? WHERE `id` = ?";
                    $conn->execute_query($query, [$requested_by, $topic, $date_requested, $date_scheduled, $time_start, $time_end, $hosts_id, $m_statuses_id, $meeting_details, $generated_by, $meetings_id]);

                    if (isset($_POST['send_email'])) {
                        $query = "SELECT * FROM `meetings_info` WHERE `id` = ?";
                        $result = $conn->execute_query($query, [$meetings_id]);

                        $row = $result->fetch_object();

                        $row->date_requested = new DateTime($row->date_requested);
                        $row->date_scheduled = new DateTime($row->date_scheduled);
                        $row->time_start = new DateTime($row->time_start);
                        $row->time_end = new DateTime($row->time_end);
                        $row->meeting_details = htmlspecialchars($row->meeting_details, ENT_QUOTES, 'UTF-8');

                        $Subject = "[$row->status] DTI6 ISDS ZOOM REQUEST: " . $row->request_number;

                        $Message = "";
                        $Message .= "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p>";
                        $Message .= "<hr>";
                        $Message .= "<div>";
                        $Message .= "<p>Good day $row->requested_by_name,</p>";
                        $Message .= "<div>Thank you for reaching out to MIS.</div>";
                        switch ($row->status) {
                            case 'Pending':
                                $Message .= "<p>Your meeting request ({$row->request_number}) is currently pending. Please await further confirmation or provide any required details.</p>";
                                break;
                            case 'Unavailable':
                                $Message .= "<p>Unfortunately, your requested meeting slot ({$row->request_number}) is unavailable. Please select a different time or contact the organizer.</p>";
                                break;
                            case 'Scheduled':
                                $Message .= "<p>Your meeting ({$row->request_number}) has been successfully scheduled. Please check your calendar for details.</p>";
                                break;
                            case 'Cancelled':
                                $Message .= "<p>Your meeting ({$row->request_number}) has been cancelled. If you need to reschedule, please submit a new request.</p>";
                                break;
                        }
                        $Message .= "<br>";
                        $Message .= "<h3><strong>Zoom Request</strong></h3>";
                        $Message .= "<ul>";
                        $Message .= "<li><strong>Date of Request:</strong> " . $row->date_requested->format('d/m/Y') . "</li>";
                        $Message .= "<li><strong>Topic or Title of meeting</strong> " . $row->topic . "</li>";
                        $Message .= "<li><strong>Date of Schedule</strong> " . $row->date_scheduled->format('d/m/Y') . "</li>";
                        $Message .= "<li><strong>Time of Schedule</strong> " . $row->time_start->format('h:i A') . " - " . $row->time_start->format('h:i A') . "</li>";
                        $Message .= "</ul>";
                        $Message .= "<h3><strong>Zoom Details</strong></h3>";
                        $Message .= "<ul>";
                        $Message .= "<li><strong>Status:</strong> <span style='color: " . $row->status_hex . "'>" . $row->status . "</span></li>";
                        $Message .= "<li><strong>Zoom Host:</strong> " . $row->host . "</li>";
                        $Message .= "<li><strong>Zoom Details:</strong><br>" . nl2br($row->meeting_details) . "</li>";
                        $Message .= "<li><strong>Generated by:</strong> " . $row->generated_by_name . "</li>";
                        $Message .= "</ul>";
                        $Message .= "<br>";
                        $Message .= "<p>To access your account, please click the button below:</p>";
                        $Message .= "<a href='http://r6itbpm.site/isds/login.php'><u>Click Here to Login</u></a>";
                        $Message .= "<br><br>";
                        $Message .= "<p>Best Regards,</p>";
                        $Message .= "<div>DTI6 MIS Administrator</div>";
                        $Message .= "<div>DTI Region VI</div>";
                        $Message .= "<hr>";
                        $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div>";
                        $Message .= "</div>";

                        sendEmail($row->requested_by_email, $Subject, $Message);
                    }

                    $response = [
                        'status' => 'success',
                        'message' => 'Meeting request updated successfully.',
                        'redirect' => '../admin/meetings.php'
                    ];
                } else {
                    $response = [
                        'status' => 'warning',
                        'message' => 'Conflict: Another meeting is scheduled at this time.'
                    ];
                }
                break;

        }
    }

    if (isset($_POST['del_meeting'])) {
        $meetings_id = $_POST['meetings_id'];

        $conn->query("SET @audit_user_id = " . (int) $_SESSION['isds_id']);

        $query = "DELETE FROM meetings WHERE id = ?";
        $result = $conn->execute_query($query, [$meetings_id]);

        $response = [
            'status' => 'success',
            'message' => 'Request deleted.',
            'reload' => true
        ];
    }

    if (isset($_POST['add_user'])) {
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

        $query = "SELECT * FROM `users_info` WHERE `username` = ? OR  `email` = ?";
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

    if (isset($_POST['upd_user'])) {
        $id = $_POST['id'];
        $id_number = $_POST['id_number'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $date_birth = $_POST['date_birth'];
        $sex = $_POST['sex'];
        $is_pwd = $_POST['is_pwd'] ?? 0;
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $designation = $_POST['designation'];
        $offices_id = $_POST['offices_id'];
        $divisions_id = $_POST['divisions_id'];
        $client_types_id = $_POST['client_types_id'];
        $roles_id = $_POST['roles_id'];

        // Check for existing username or email to avoid duplication
        $query = "SELECT * FROM `users_info` WHERE `email` = ? AND `id` != ?";
        $result = $conn->execute_query($query, [$email, $id]);

        if ($result && $result->num_rows < 1) {
            $query = "UPDATE `users` SET `id_number` = ?, `first_name` = ?, `middle_name` = ?, `last_name` = ?, `designation` = ?, `offices_id` = ?, `divisions_id` = ?, `client_types_id` = ?, `date_birth` = ?, `sex` = ?, `is_pwd` = ?, `phone` = ?, `email` = ?, `address` = ?, `roles_id` = ? WHERE `id` = ?";
            $result = $conn->execute_query($query, [$id_number, $first_name, $middle_name, $last_name, $designation, $offices_id, $divisions_id, $client_types_id, $date_birth, $sex, $is_pwd, $phone, $email, $address, $roles_id, $id]);

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

    if (isset($_POST['del_user'])) {
        $users_id = $_POST['users_id'];

        $query = "DELETE FROM users WHERE id = ?";
        $result = $conn->execute_query($query, [$users_id]);

        $response = [
            'status' => 'success',
            'message' => 'User deleted.',
            'redirect' => '../' . ($_SESSION['role'] == 'admin' ? 'admin' : 'user') . '/users.php'
        ];
    }

    if (isset($_POST['reset_password'])) {
        $users_id = $_POST['users_id'];

        $query = "SELECT * FROM `users_info` WHERE `id` = ?";
        $result = $conn->execute_query($query, [$users_id]);

        if ($result->num_rows) {
            $password = generatePassword();
            $password_hashed = password_hash($password, PASSWORD_ARGON2I);
            $password_exp = date("Y-m-d H:i:s", strtotime("+2 minutes"));

            $query2 = "UPDATE `users` SET `password` = ?, `password_exp` = ? WHERE `id` = ?";
            $result2 = $conn->execute_query($query2, [$password_hashed, $password_exp, $users_id]);

            $query3 = $conn->execute_query($query, [$users_id]);

            while ($acc = $query3->fetch_object()) {
                $Subject = "DTI6 ISDS: Reset Password";

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
                $Message .= "<div><a href='http://r6itbpm.site/isds/index.php'>Click here</a> to login. Thank you.</div>";
                $Message .= "<br><br>";
                $Message .= "<div>Best Regards,</div>";
                $Message .= "<br>";
                $Message .= "<div>DTI6 MIS Administrator</div>";
                $Message .= "<div>IT Support VIP</div>";
                $Message .= "<div>DTI Region VI</div>";
                $Message .= "<br><hr>";
                $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div>";
                $Message .= "</div>";

                sendEmail($acc->email, $Subject, $Message);
            }

            $response['status'] = 'success';
            $response['message'] = 'Reset password sent.';
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Email not found.'
            ];
        }
    }

    if (isset($_POST['quick_csf'])) {
        $helpdesks_id = $_POST['helpdesks_id'];
        $crit1 = $_POST['crit1'];
        $crit2 = $_POST['crit2'];
        $crit3 = $_POST['crit3'];
        $crit4 = $_POST['crit4'];
        $overall = $_POST['overall'];
        $reasons = $_POST['reasons'];
        $comments = $_POST['comments'];

        $query = "INSERT 
        INTO csf(`helpdesks_id`,`criteria_a`,`criteria_b`,`criteria_c`,`criteria_d`,`overall`,`reasons`,`comments`) 
    VALUES(?,?,?,?,?,?,?,?)";

        $result = $conn->execute_query($query, [$helpdesks_id, $crit1, $crit2, $crit3, $crit4, $overall, $reasons, $comments]);

        $response['status'] = 'success';
        $response['message'] = 'CSF submit successfully, Thank You!';
        $response['redirect'] = 'quick_csf.php?reqno=' . $helpdesks_id;
    }

} else {
    $response = [
        'status' => 'warning',
        'message' => 'something wen\'t wrong, please try again.',
        'reload' => true
    ];
}

$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
