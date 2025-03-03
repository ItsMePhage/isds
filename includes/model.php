<?php
require_once 'conn.php';
require_once 'common_functions.php';

class Model
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM `users_info` WHERE `username` = ? OR `id_number` = ? OR `email` = ?";
        $result = $this->conn->execute_query($query, [$username, $username, $username]);
        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_object();
            if (password_verify($password, $row->password)) {
                if ($row->is_active == 1) {
                    if (!empty($row->password_exp)) {
                        $current = new DateTime();
                        $expiry = new DateTime($row->password_exp);
                        if ($current > $expiry) {
                            return ['status' => 'warning', 'message' => 'Password has expired.'];
                        }
                        $this->conn->query('UPDATE `users` SET `password_exp` = NULL WHERE `id` = ' . $row->id);
                    }
                    return [
                        'status' => 'success',
                        'message' => 'Login successful.',
                        'redirect' => ($row->roles_id == 1 ? 'admin' : 'user') . '/dashboard.php',
                        'id' => $row->id,
                        'role' => $row->role
                    ];
                }
                return ['status' => 'warning', 'message' => 'Account not activated!'];
            }
            return ['status' => 'warning', 'message' => 'Invalid password!'];
        }
        return ['status' => 'warning', 'message' => 'Username or Email not found!'];
    }

    public function register($data)
    {
        $query = "SELECT * FROM `users_info` WHERE `username` = ? OR `email` = ?";
        $result = $this->conn->execute_query($query, [$data['username'], $data['email']]);
        if ($result && $result->num_rows < 1) {
            $password = password_hash($data['password'], PASSWORD_ARGON2I);
            $query = "INSERT INTO `users` (`id_number`,`first_name`,`middle_name`,`last_name`,`designation`,`offices_id`,`divisions_id`,`client_types_id`,`date_birth`,`sex`,`is_pwd`,`phone`,`email`,`address`,`username`,`password`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->conn->execute_query($query, [
                $data['id_number'],
                $data['first_name'],
                $data['middle_name'],
                $data['last_name'],
                $data['designation'],
                $data['offices_id'],
                $data['divisions_id'],
                $data['client_types_id'],
                $data['date_birth'],
                $data['sex'],
                $data['is_pwd'],
                $data['phone'],
                $data['email'],
                $data['address'],
                $data['username'],
                $password
            ]);
            return [
                'status' => 'success',
                'message' => 'Register successful.',
                'redirect' => 'user/dashboard.php',
                'id' => $this->conn->insert_id
            ];
        }
        return ['status' => 'warning', 'message' => 'Username or Email already exist.'];
    }

    public function forgotPassword($username)
    {
        $query = "SELECT * FROM `users_info` WHERE `username` = ? OR `email` = ?";
        $result = $this->conn->execute_query($query, [$username, $username]);
        if ($result->num_rows) {
            $password = generatePassword();
            $password_hashed = password_hash($password, PASSWORD_ARGON2I);
            $password_exp = date("Y-m-d H:i:s", strtotime("+2 minutes"));
            $query2 = "UPDATE `users` SET `password` = ?, `password_exp` = ? WHERE `email` = ?";
            $this->conn->execute_query($query2, [$password_hashed, $password_exp, $username]);
            $user = $result->fetch_object();
            sendEmail($user->email, "DTI6 ISDS: Temporary Password", $this->buildForgotPasswordEmail($user->username, $password));
            return ['status' => 'success', 'message' => 'Temporary password sent.', 'redirect' => 'login.php'];
        }
        return ['status' => 'warning', 'message' => 'Email not found!'];
    }

    public function changeUsername($username, $userId)
    {
        $query = "SELECT * FROM `users_info` WHERE `username` = ? AND `id` != ?";
        $result = $this->conn->execute_query($query, [$username, $userId]);
        if ($result && $result->num_rows == 0) {
            $query = "UPDATE `users` SET `username` = ? WHERE `id` = ?";
            $this->conn->execute_query($query, [$username, $userId]);
            return ['status' => 'success', 'message' => 'Username updated.'];
        }
        return ['status' => 'warning', 'message' => 'Username already exist.'];
    }

    public function changePassword($data, $userId)
    {
        if ($data['new_password'] == $data['password']) {
            return ['status' => 'warning', 'message' => 'Current and New passwords should not be the same.'];
        }
        if ($data['ver_password'] != $data['new_password']) {
            return ['status' => 'warning', 'message' => 'Password don\'t match.'];
        }
        $query = "SELECT * FROM `users_info` WHERE `id` = ?";
        $result = $this->conn->execute_query($query, [$userId]);
        $row = $result->fetch_object();
        if (password_verify($data['password'], $row->password)) {
            $hashed_password = password_hash($data['new_password'], PASSWORD_ARGON2I);
            $query = "UPDATE `users` SET `password` = ? WHERE `id` = ?";
            $this->conn->execute_query($query, [$hashed_password, $userId]);
            return ['status' => 'success', 'message' => 'Password updated.'];
        }
        return ['status' => 'warning', 'message' => 'Invalid current password.'];
    }

    public function updateProfile($data, $userId)
    {
        $query = "SELECT * FROM `users_info` WHERE `id_number` = ? AND `id` != ?";
        $result = $this->conn->execute_query($query, [$data['id_number'], $userId]);
        if (!$result->num_rows) {
            $query = "SELECT * FROM `users_info` WHERE `email` = ? AND `id` != ?";
            $result = $this->conn->execute_query($query, [$data['email'], $userId]);
            if (!$result->num_rows) {
                $query = "UPDATE `users` SET `id_number` = ?, `first_name` = ?, `middle_name` = ?, `last_name` = ?, `date_birth` = ?, `sex` = ?, `is_pwd` = ?, `phone` = ?, `email` = ?, `address` = ?, `designation` = ?, `offices_id` = ?, `divisions_id` = ?, `client_types_id` = ? WHERE `id` = ?";
                $this->conn->execute_query($query, [$data['id_number'], $data['first_name'], $data['middle_name'], $data['last_name'], $data['date_birth'], $data['sex'], $data['is_pwd'], $data['phone'], $data['email'], $data['address'], $data['designation'], $data['offices_id'], $data['divisions_id'], $data['client_types_id'], $userId]);
                return ['status' => 'success', 'message' => 'User updated successfully.'];
            }
            return ['status' => 'warning', 'message' => 'Email already exist.'];
        }
        return ['status' => 'warning', 'message' => 'ID Number already exist.'];
    }

    public function addHelpdesk($data, $role, $userId)
    {
        if ($role == 'employee' || $role == 'VIP') {
            $query = "INSERT INTO helpdesks(`requested_by`,`date_requested`,`request_types_id`,`categories_id`,`sub_categories_id`,`complaint`,`datetime_preferred`,`offices_id`) VALUE (?,?,?,?,?,?,?,?)";
            $this->conn->execute_query($query, [$userId, $data['date_requested'], $data['request_types_id'], $data['categories_id'], $data['sub_categories_id'], $data['complaint'], $data['datetime_preferred'], $data['offices_id']]);
            $helpdesks_id = $this->conn->insert_id;
            $this->sendHelpdeskEmail($helpdesks_id, 'Open');
            return ['status' => 'success', 'message' => 'Request submitted.', 'redirect' => '../user/helpdesks.php'];
        } elseif ($role == 'admin') {
            $query = "INSERT INTO helpdesks(`requested_by`,`date_requested`,`request_types_id`,`categories_id`,`sub_categories_id`,`complaint`,`datetime_preferred`,`h_statuses_id`,`property_number`,`priority_levels_id`,`repair_types_id`,`repair_classes_id`,`mediums_id`,`serviced_by`,`datetime_start`,`is_pullout`,`datetime_end`,`is_turnover`,`diagnosis`,`action_taken`,`remarks`,`offices_id`) VALUE (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->conn->execute_query($query, [$data['requested_by'], $data['date_requested'], $data['request_types_id'], $data['categories_id'], $data['sub_categories_id'], $data['complaint'], $data['datetime_preferred'], $data['h_statuses_id'], $data['property_number'], $data['priority_levels_id'], $data['repair_types_id'], $data['repair_classes_id'], $data['mediums_id'], $data['serviced_by'], $data['datetime_start'], $data['is_pullout'], $data['datetime_end'], $data['is_turnover'], $data['diagnosis'], $data['action_taken'], $data['remarks'], $data['offices_id']]);
            $helpdesks_id = $this->conn->insert_id;
            if (isset($data['send_email'])) $this->sendHelpdeskEmail($helpdesks_id, 'admin');
            return ['status' => 'success', 'message' => 'Request submitted.', 'redirect' => '../admin/helpdesks.php'];
        }
    }

    public function updateHelpdesk($data, $role, $userId)
    {
        if ($role == 'employee' || $role == 'VIP') {
            $query = "UPDATE `helpdesks` SET `date_requested` = ?, `request_types_id` = ?, `categories_id` = ?, `sub_categories_id` = ?, `complaint` = ?, `datetime_preferred` = ? WHERE `id` = ?";
            $this->conn->execute_query($query, [$data['date_requested'], $data['request_types_id'], $data['categories_id'], $data['sub_categories_id'], $data['complaint'], $data['datetime_preferred'], $data['upd_helpdesk_id']]);
            return ['status' => 'success', 'message' => 'Request updated.', 'redirect' => '../user/helpdesks.php'];
        } elseif ($role == 'admin') {
            $query = "UPDATE `helpdesks` SET `requested_by` = ?, `date_requested` = ?, `request_types_id` = ?, `categories_id` = ?, `sub_categories_id` = ?, `complaint` = ?, `datetime_preferred` = ?, `h_statuses_id` = ?, `property_number` = ?, `priority_levels_id` = ?, `repair_types_id` = ?, `repair_classes_id` = ?, `mediums_id` = ?, `datetime_start` = ?, `is_pullout` = ?, `datetime_end` = ?, `is_turnover` = ?, `diagnosis` = ?, `action_taken` = ?, `serviced_by` = ?, `remarks` = ? WHERE `id` = ?";
            $this->conn->execute_query($query, [$data['requested_by'], $data['date_requested'], $data['request_types_id'], $data['categories_id'], $data['sub_categories_id'], $data['complaint'], $data['datetime_preferred'], $data['h_statuses_id'], $data['property_number'], $data['priority_levels_id'], $data['repair_types_id'], $data['repair_classes_id'], $data['mediums_id'], $data['datetime_start'], $data['is_pullout'], $data['datetime_end'], $data['is_turnover'], $data['diagnosis'], $data['action_taken'], $data['serviced_by'], $data['remarks'], $data['upd_helpdesk_id']]);
            if (isset($data['send_email'])) $this->sendHelpdeskEmail($data['upd_helpdesk_id'], 'admin');
            return ['status' => 'success', 'message' => 'Request updated.', 'redirect' => '../admin/helpdesks.php'];
        }
    }

    public function deleteHelpdesk($helpdesks_id, $role, $userId)
    {
        $this->conn->query("SET @audit_user_id = " . (int)$userId);
        $query = "DELETE FROM helpdesks WHERE id = ?";
        $this->conn->execute_query($query, [$helpdesks_id]);
        return ['status' => 'success', 'message' => 'Request deleted.', 'redirect' => '../' . ($role == 'admin' ? 'admin' : 'user') . '/helpdesks.php'];
    }

    public function addMeeting($data, $role, $userId)
    {
        $conflictQuery = "SELECT * FROM `meetings` WHERE `date_scheduled` = ? AND ((? BETWEEN `time_start` AND `time_end`) OR (? BETWEEN `time_start` AND `time_end`) OR (`time_start` BETWEEN ? AND ?) OR (`time_end` BETWEEN ? AND ?))";
        $result = $this->conn->execute_query($conflictQuery, [$data['date_scheduled'], $data['time_start'], $data['time_end'], $data['time_start'], $data['time_end'], $data['time_start'], $data['time_end']]);
        if ($result->num_rows == 0) {
            if ($role == 'employee' || $role == 'VIP') {
                $query = "INSERT INTO meetings (`requested_by`, `topic`, `date_requested`, `date_scheduled`, `time_start`, `time_end`) VALUES (?, ?, ?, ?, ?, ?)";
                $this->conn->execute_query($query, [$userId, $data['topic'], $data['date_requested'], $data['date_scheduled'], $data['time_start'], $data['time_end']]);
                $meetings_id = $this->conn->insert_id;
                $this->sendMeetingEmail($meetings_id, 'Pending');
                return ['status' => 'success', 'message' => 'Request submitted.', 'redirect' => '../user/meetings.php'];
            } elseif ($role == 'admin') {
                $query = "INSERT INTO meetings (`requested_by`, `topic`, `date_requested`, `date_scheduled`, `time_start`, `time_end`, `hosts_id`, `m_statuses_id`, `meeting_details`, `generated_by`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $this->conn->execute_query($query, [$data['requested_by'], $data['topic'], $data['date_requested'], $data['date_scheduled'], $data['time_start'], $data['time_end'], $data['hosts_id'], $data['m_statuses_id'], $data['meeting_details'], $data['generated_by']]);
                $meetings_id = $this->conn->insert_id;
                if (isset($data['send_email'])) $this->sendMeetingEmail($meetings_id, 'admin');
                return ['status' => 'success', 'message' => 'Request submitted.', 'redirect' => '../admin/meetings.php'];
            }
        }
        return ['status' => 'warning', 'message' => 'Conflict meeting.'];
    }

    public function updateMeeting($data, $role, $userId)
    {
        $conflictQuery = "SELECT * FROM `meetings` WHERE `date_scheduled` = ? AND `id` != ? AND ((? BETWEEN `time_start` AND `time_end`) OR (? BETWEEN `time_start` AND `time_end`) OR (`time_start` BETWEEN ? AND ?) OR (`time_end` BETWEEN ? AND ?))";
        $result = $this->conn->execute_query($conflictQuery, [$data['date_scheduled'], $data['meetings_id'], $data['time_start'], $data['time_end'], $data['time_start'], $data['time_end'], $data['time_start'], $data['time_end']]);
        if ($result->num_rows == 0) {
            if ($role == 'employee' || $role == 'VIP') {
                $query = "UPDATE meetings SET `requested_by` = ?, `topic` = ?, `date_requested` = ?, `date_scheduled` = ?, `time_start` = ?, `time_end` = ? WHERE `id` = ?";
                $this->conn->execute_query($query, [$userId, $data['topic'], $data['date_requested'], $data['date_scheduled'], $data['time_start'], $data['time_end'], $data['meetings_id']]);
                $this->sendMeetingEmail($data['meetings_id'], 'Pending', true);
                return ['status' => 'success', 'message' => 'Meeting updated successfully.', 'redirect' => '../user/meetings.php'];
            } elseif ($role == 'admin') {
                $query = "UPDATE meetings SET `requested_by` = ?, `topic` = ?, `date_requested` = ?, `date_scheduled` = ?, `time_start` = ?, `time_end` = ?, `hosts_id` = ?, `m_statuses_id` = ?, `meeting_details` = ?, `generated_by` = ? WHERE `id` = ?";
                $this->conn->execute_query($query, [$data['requested_by'], $data['topic'], $data['date_requested'], $data['date_scheduled'], $data['time_start'], $data['time_end'], $data['hosts_id'], $data['m_statuses_id'], $data['meeting_details'], $data['generated_by'], $data['meetings_id']]);
                if (isset($data['send_email'])) $this->sendMeetingEmail($data['meetings_id'], 'admin', true);
                return ['status' => 'success', 'message' => 'Meeting updated successfully.', 'redirect' => '../admin/meetings.php'];
            }
        }
        return ['status' => 'warning', 'message' => 'Conflict with another meeting.'];
    }

    public function deleteMeeting($meetings_id, $userId)
    {
        $this->conn->query("SET @audit_user_id = " . (int)$userId);
        $query = "DELETE FROM meetings WHERE id = ?";
        $this->conn->execute_query($query, [$meetings_id]);
        return ['status' => 'success', 'message' => 'Request deleted.', 'reload' => true];
    }

    public function addUser($data)
    {
        $query = "SELECT * FROM `users_info` WHERE `username` = ? OR `email` = ?";
        $result = $this->conn->execute_query($query, [$data['username'], $data['email']]);
        if ($result && $result->num_rows < 1) {
            $password_hashed = password_hash($data['password'], PASSWORD_ARGON2I);
            $query = "INSERT INTO `users` (`id_number`,`first_name`,`middle_name`,`last_name`,`designation`,`offices_id`,`divisions_id`,`client_types_id`,`date_birth`,`sex`,`is_pwd`,`phone`,`email`,`address`,`username`,`password`,`roles_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->conn->execute_query($query, [$data['id_number'], $data['first_name'], $data['middle_name'], $data['last_name'], $data['designation'], $data['offices_id'], $data['divisions_id'], $data['client_types_id'], $data['date_birth'], $data['sex'], $data['is_pwd'], $data['phone'], $data['email'], $data['address'], $data['username'], $password_hashed, $data['roles_id']]);
            return ['status' => 'success', 'message' => 'Register successful.', 'redirect' => 'users.php'];
        }
        return ['status' => 'warning', 'message' => 'Username or Email already exist.'];
    }

    public function updateUser($data)
    {
        $query = "SELECT * FROM `users_info` WHERE `email` = ? AND `id` != ?";
        $result = $this->conn->execute_query($query, [$data['email'], $data['id']]);
        if ($result && $result->num_rows < 1) {
            $query = "UPDATE `users` SET `id_number` = ?, `first_name` = ?, `middle_name` = ?, `last_name` = ?, `designation` = ?, `offices_id` = ?, `divisions_id` = ?, `client_types_id` = ?, `date_birth` = ?, `sex` = ?, `is_pwd` = ?, `phone` = ?, `email` = ?, `address` = ?, `roles_id` = ? WHERE `id` = ?";
            $this->conn->execute_query($query, [$data['id_number'], $data['first_name'], $data['middle_name'], $data['last_name'], $data['designation'], $data['offices_id'], $data['divisions_id'], $data['client_types_id'], $data['date_birth'], $data['sex'], $data['is_pwd'], $data['phone'], $data['email'], $data['address'], $data['roles_id'], $data['id']]);
            return ['status' => 'success', 'message' => 'Update successful.', 'redirect' => 'users.php'];
        }
        return ['status' => 'warning', 'message' => 'Email already exists.'];
    }

    public function deleteUser($users_id)
    {
        $query = "DELETE FROM users WHERE id = ?";
        $this->conn->execute_query($query, [$users_id]);
        return ['status' => 'success', 'message' => 'User deleted.', 'redirect' => '../' . ($_SESSION['role'] == 'admin' ? 'admin' : 'user') . '/users.php'];
    }

    public function resetPassword($users_id)
    {
        $query = "SELECT * FROM `users_info` WHERE `id` = ?";
        $result = $this->conn->execute_query($query, [$users_id]);
        if ($result->num_rows) {
            $password = generatePassword();
            $password_hashed = password_hash($password, PASSWORD_ARGON2I);
            $password_exp = date("Y-m-d H:i:s", strtotime("+2 minutes"));
            $query2 = "UPDATE `users` SET `password` = ?, `password_exp` = ? WHERE `id` = ?";
            $this->conn->execute_query($query2, [$password_hashed, $password_exp, $users_id]);
            $acc = $result->fetch_object();
            sendEmail($acc->email, "DTI6 ISDS: Reset Password", $this->buildForgotPasswordEmail($acc->username, $password));
            return ['status' => 'success', 'message' => 'Reset password sent.'];
        }
        return ['status' => 'warning', 'message' => 'Email not found.'];
    }

    public function quickCsf($data)
    {
        $query = "INSERT INTO csf(`helpdesks_id`,`criteria_a`,`criteria_b`,`criteria_c`,`criteria_d`,`overall`,`reasons`,`comments`) VALUES(?,?,?,?,?,?,?,?)";
        $this->conn->execute_query($query, [$data['helpdesks_id'], $data['crit1'], $data['crit2'], $data['crit3'], $data['crit4'], $data['overall'], $data['reasons'], $data['comments']]);
        return ['status' => 'success', 'message' => 'CSF submit successfully, Thank You!', 'redirect' => 'view_csf.php?reqno=' . $data['helpdesks_id']];
    }

    private function buildForgotPasswordEmail($username, $password)
    {
        $Message = "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p><hr><div>";
        $Message .= "<div>Good day!,</div><br><div>You have requested a temporary password. Please use the temporary password below to login:</div><br><br>";
        $Message .= "<div>Username: $username</div><div>Password: $password</div><br><br>";
        $Message .= "<div>For security reasons, we recommend that you change your password after your first login.</div>";
        $Message .= "<div><a href='" . base_url . "/isds/index.php'>Click here</a> to login. Thank you.</div><br><br>";
        $Message .= "<div>Best Regards,</div><br><div>DTI6 MIS Administrator</div><div>IT Support VIP</div><div>DTI Region VI</div><br><hr>";
        $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div></div>";
        return $Message;
    }

    private function sendHelpdeskEmail($helpdesks_id, $statusType)
    {
        $query = "SELECT * FROM `helpdesks_info` WHERE `id` = ?";
        $result = $this->conn->execute_query($query, [$helpdesks_id]);
        $row = $result->fetch_object();
        $row->date_requested = new DateTime($row->date_requested);
        $row->datetime_preferred = new DateTime($row->datetime_preferred);
        if ($statusType == 'admin') {
            $row->datetime_start = new DateTime($row->datetime_start);
            $row->datetime_end = new DateTime($row->datetime_end);
        }

        $Subject = "[$row->status] DTI6 ISDS ICT REQUEST: $row->request_number";
        $Message = "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p><hr><div>";
        $Message .= "<p>Good day $row->requested_by_name,</p><div>Thank you for reaching out to MIS.</div>";
        switch ($row->status) {
            case 'Open':
                $Message .= "<p>Your request ($row->request_number) has been successfully submitted. Our team will review it and get back to you soon.</p>";
                break;
            case 'Cancelled':
                $Message .= "<p>Your request ($row->request_number) has been cancelled. If you need further assistance, please submit a new request or contact our support team.</p>";
                break;
            case 'Pending':
                $Message .= "<p>Your request ($row->request_number) is currently pending. Please provide the required information to proceed.</p>";
                break;
            case 'Pre-repair':
                $Message .= "<p>Your request ($row->request_number) is now scheduled for servicing. Our team will begin work on the assigned date.</p>";
                break;
            case 'Completed':
                $Message .= "<p>Your request ($row->request_number) has been completed. Please take a moment to fill out our feedback form:</p><p><a href='" . base_url . "/isds/csf.php?reqno=$row->id' style='font-size: 18pt;'>Online CSF Form</a></p>";
                break;
            case 'Unserviceable':
                $Message .= "<p>We regret to inform you that your request ($row->request_number) has been marked as unserviceable. Please contact support for alternative solutions.</p>";
                break;
        }
        $Message .= "<br><h3><strong>Request Details</strong></h3><ul>";
        $Message .= "<li><strong>Date of Request:</strong> " . $row->date_requested->format('d/m/Y') . "</li>";
        $Message .= "<li><strong>Type of Request:</strong> $row->request_type</li>";
        $Message .= "<li><strong>Category of Request:</strong> $row->category</li>";
        $Message .= "<li><strong>Sub-Category of Request:</strong> $row->sub_category</li>";
        $Message .= "<li><strong>Description:</strong> $row->complaint</li>";
        $Message .= "<li><strong>Preferred Date and Time:</strong> " . $row->datetime_preferred->format('d/m/Y h:i A') . "</li>";
        if ($statusType == 'admin') {
            $Message .= "</ul><h3><strong>Action Details</strong></h3><ul>";
            $Message .= "<li><strong>Status:</strong> <span style='color: $row->status_hex'>$row->status</span></li>";
            $Message .= "<li><strong>Property Number:</strong> $row->property_number</li>";
            $Message .= "<li><strong>Urgency:</strong> $row->priority_level</li>";
            $Message .= "<li><strong>Mode of Request:</strong> $row->medium</li>";
            $Message .= "<li><strong>Date & Time Started:</strong> " . $row->datetime_start->format('d/m/Y h:i A') . "</li>";
            $Message .= "<li><strong>Pulled Out:</strong> " . ($row->is_pullout ? 'Yes' : 'No') . "</li>";
            $Message .= "<li><strong>Date & Time Finished:</strong> " . $row->datetime_end->format('d/m/Y h:i A') . "</li>";
            $Message .= "<li><strong>Turned Over:</strong> " . ($row->is_turnover ? 'Yes' : 'No') . "</li>";
            $Message .= "<li><strong>Diagnosis:</strong> $row->diagnosis</li>";
            $Message .= "<li><strong>Action Taken:</strong> $row->action_taken</li>";
            $Message .= "<li><strong>Remarks:</strong> $row->remarks</li>";
            $Message .= "<li><strong>Serviced by:</strong> $row->serviced_by_name</li>";
        }
        $Message .= "</ul><p>To access your account, please click the button below:</p><a href='" . base_url . "/isds/login.php'><u>Click Here to Login</u></a><br><br>";
        $Message .= "<p>Best Regards,</p><div>DTI6 MIS Administrator</div><div>DTI Region VI</div><hr>";
        $Message .= "<div>&copy; Copyright&nbsp;<strong>DTI6 MIS&nbsp;</strong>2024. All Rights Reserved</div></div>";
        sendEmail($statusType == 'Open' ? 'dti6.mis@gmail.com' : $row->requested_by_email, $Subject, $Message);
    }

    private function sendMeetingEmail($meetings_id, $statusType, $isUpdate = false)
    {
        $query = "SELECT * FROM `meetings_info` WHERE `id` = ?";
        $result = $this->conn->execute_query($query, [$meetings_id]);
        $row = $result->fetch_object();
        $row->date_requested = new DateTime($row->date_requested);
        $row->date_scheduled = new DateTime($row->date_scheduled);
        $row->time_start = new DateTime($row->time_start);
        $row->time_end = new DateTime($row->time_end);

        $Subject = "[$row->status] DTI6 ISDS ZOOM REQUEST" . ($isUpdate ? " UPDATED" : "") . ": $row->request_number";
        $Message = "<p><img src='https://upload.wikimedia.org/wikipedia/commons/1/14/DTI_Logo_2019.png' alt='' width='58' height='55'></p><hr>";
        $Message .= "<p>Good day $row->requested_by_name,</p><div>" . ($isUpdate ? "Your meeting request has been updated." : "Thank you for reaching out to MIS.") . "</div>";
        if ($statusType == 'Pending') {
            $Message .= "<p>Your meeting request ($row->request_number) is currently pending" . ($isUpdate ? " with updated details" : "") . ". Please " . ($isUpdate ? "review the changes" : "await further confirmation") . ".</p>";
        } elseif ($statusType == 'admin') {
            switch ($row->status) {
                case 'Pending':
                    $Message .= "<p>Your " . ($isUpdate ? "updated " : "") . "meeting request ($row->request_number) is currently pending.</p>";
                    break;
                case 'Unavailable':
                    $Message .= "<p>Unfortunately, your " . ($isUpdate ? "updated " : "") . "meeting slot ($row->request_number) is unavailable.</p>";
                    break;
                case 'Scheduled':
                    $Message .= "<p>Your " . ($isUpdate ? "updated " : "") . "meeting ($row->request_number) has been successfully scheduled.</p>";
                    break;
                case 'Cancelled':
                    $Message .= "<p>Your " . ($isUpdate ? "updated " : "") . "meeting ($row->request_number) has been cancelled.</p>";
                    break;
            }
        }
        $Message .= "<br><h3><strong>" . ($isUpdate ? "Updated " : "") . "Zoom Request</strong></h3><ul>";
        $Message .= "<li><strong>Date of Request:</strong> " . $row->date_requested->format('d/m/Y') . "</li>";
        $Message .= "<li><strong>Topic:</strong> " . htmlspecialchars($row->topic) . "</li>";
        $Message .= "<li><strong>Date of Schedule:</strong> " . $row->date_scheduled->format('d/m/Y') . "</li>";
        $Message .= "<li><strong>Time of Schedule:</strong> " . $row->time_start->format('h:i A') . " - " . $row->time_end->format('h:i A') . "</li>";
        if ($statusType == 'admin') {
            $Message .= "</ul><h3><strong>Zoom Details</strong></h3><ul>";
            $Message .= "<li><strong>Status:</strong> <span style='color: " . ($row->status_hex ?? '#000000') . "'>$row->status</span></li>";
            $Message .= "<li><strong>Zoom Host:</strong> " . ($row->host ?? 'Not assigned') . "</li>";
            $Message .= "<li><strong>Generated by:</strong> " . ($row->generated_by_name ?? 'N/A') . "</li>";
            $Message .= "<li><strong>Zoom Details:</strong><br>" . nl2br(htmlspecialchars($row->meeting_details)) . "</li>";
        }
        $Message .= "</ul><br><p>To access your account, please click the button below:</p><a href='" . base_url . "/isds/login.php'><u>Click Here to Login</u></a><br><br>";
        $Message .= "<p>Best Regards,</p><div>DTI6 MIS Administrator</div><div>DTI Region VI</div><hr>";
        $Message .= "<div>© Copyright <strong>DTI6 MIS</strong> 2024. All Rights Reserved</div>";
        sendEmail($row->requested_by_email, $Subject, $Message);
    }
}
