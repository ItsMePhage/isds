<?php
require_once 'model.php';

session_start();

class Controller
{
    private $model;
    private $response = [];

    public function __construct()
    {
        $this->model = new Model();
    }

    public function handleRequest()
    {
        if (isset($_POST['captcha-token']) && !empty($_POST['captcha-token'])) {
            $g_response = verifyCaptcha($_POST['captcha-token'], secretkey);
            if ($g_response == 1) {
                $this->processRequest();
            } else {
                $this->response = ['status' => 'warning', 'message' => 'Captcha verification failed.'];
            }
        } else {
            $this->response = ['status' => 'warning', 'message' => 'Something went wrong, please try again.', 'reload' => true];
        }
        $this->sendResponse();
    }

    private function processRequest()
    {
        if (isset($_POST['login'])) {
            $result = $this->model->login(trim($_POST['username']), trim($_POST['password']));
            if ($result['status'] === 'success') {
                $_SESSION['id'] = $result['id'];
                $_SESSION['role'] = $result['role'];
            }
            $this->response = $result;
        }

        if (isset($_POST['register'])) {
            $data = [
                'id_number' => $_POST['id_number'],
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'last_name' => $_POST['last_name'],
                'date_birth' => $_POST['date_birth'],
                'sex' => $_POST['sex'],
                'is_pwd' => $_POST['is_pwd'] ?? null,
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'designation' => $_POST['designation'],
                'offices_id' => $_POST['offices_id'],
                'divisions_id' => $_POST['divisions_id'],
                'client_types_id' => $_POST['client_types_id'],
                'username' => $_POST['username'],
                'password' => $_POST['password']
            ];
            $result = $this->model->register($data);
            if ($result['status'] === 'success') $_SESSION['id'] = $result['id'];
            $this->response = $result;
        }

        if (isset($_POST['forgot_password'])) {
            $this->response = $this->model->forgotPassword($_POST['username']);
        }

        if (isset($_POST['change_username'])) {
            $this->response = $this->model->changeUsername($_POST['username'], $_SESSION['id']);
        }

        if (isset($_POST['change_password'])) {
            $data = ['password' => $_POST['password'], 'new_password' => $_POST['new_password'], 'ver_password' => $_POST['ver_password']];
            $this->response = $this->model->changePassword($data, $_SESSION['id']);
        }

        if (isset($_POST['update_profile'])) {
            $data = [
                'id_number' => $_POST['id_number'],
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'last_name' => $_POST['last_name'],
                'date_birth' => $_POST['date_birth'],
                'sex' => $_POST['sex'],
                'is_pwd' => isset($_POST['is_pwd']) ? 1 : 0,
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'designation' => $_POST['designation'],
                'offices_id' => $_POST['offices_id'],
                'divisions_id' => $_POST['divisions_id'],
                'client_types_id' => $_POST['client_types_id']
            ];
            $this->response = $this->model->updateProfile($data, $_SESSION['id']);
        }

        if (isset($_POST['add_helpdesk'])) {
            $data = [
                'date_requested' => $_POST['date_requested'],
                'request_types_id' => $_POST['request_types_id'],
                'categories_id' => $_POST['categories_id'],
                'sub_categories_id' => $_POST['sub_categories_id'],
                'complaint' => str_replace("'", "&apos;", $_POST['complaint']),
                'datetime_preferred' => !empty($_POST['datetime_preferred']) ? $_POST['datetime_preferred'] : date('Y-m-d H:i:s'),
                'offices_id' => $_SESSION['offices_id']
            ];
            if ($_SESSION['role'] == 'admin') {
                $data = array_merge($data, [
                    'requested_by' => !empty($_POST['requested_by']) ? $_POST['requested_by'] : $_SESSION['id'],
                    'h_statuses_id' => !empty($_POST['h_statuses_id']) ? $_POST['h_statuses_id'] : 1,
                    'property_number' => $_POST['property_number'],
                    'priority_levels_id' => $_POST['priority_levels_id'] ?? null,
                    'repair_types_id' => $_POST['repair_types_id'] ?? null,
                    'repair_classes_id' => $_POST['repair_classes_id'] ?? null,
                    'mediums_id' => $_POST['mediums_id'] ?? null,
                    'serviced_by' => $_POST['serviced_by'] ?? null,
                    'datetime_start' => $_POST['datetime_start'] ?? null,
                    'is_pullout' => isset($_POST['is_pullout']) ? 1 : null,
                    'datetime_end' => $_POST['datetime_end'] ?? null,
                    'is_turnover' => isset($_POST['is_turnover']) ? 1 : null,
                    'diagnosis' => str_replace("'", "&apos;", $_POST['diagnosis']),
                    'action_taken' => str_replace("'", "&apos;", $_POST['action_taken']),
                    'remarks' => str_replace("'", "&apos;", $_POST['remarks']),
                    'send_email' => $_POST['send_email'] ?? null
                ]);
            }
            $this->response = $this->model->addHelpdesk($data, $_SESSION['role'], $_SESSION['id']);
        }

        if (isset($_POST['upd_helpdesk'])) {
            $data = [
                'upd_helpdesk_id' => $_POST['upd_helpdesk_id'],
                'date_requested' => $_POST['date_requested'],
                'request_types_id' => $_POST['request_types_id'],
                'categories_id' => $_POST['categories_id'],
                'sub_categories_id' => $_POST['sub_categories_id'],
                'complaint' => str_replace("'", "&apos;", $_POST['complaint']),
                'datetime_preferred' => !empty($_POST['datetime_preferred']) ? $_POST['datetime_preferred'] : date('Y-m-d H:i:s')
            ];
            if ($_SESSION['role'] == 'admin') {
                $data = array_merge($data, [
                    'requested_by' => !empty($_POST['requested_by']) ? $_POST['requested_by'] : $_SESSION['id'],
                    'h_statuses_id' => !empty($_POST['h_statuses_id']) ? $_POST['h_statuses_id'] : 1,
                    'property_number' => $_POST['property_number'],
                    'priority_levels_id' => $_POST['priority_levels_id'] ?? null,
                    'repair_types_id' => $_POST['repair_types_id'] ?? null,
                    'repair_classes_id' => $_POST['repair_classes_id'] ?? null,
                    'mediums_id' => $_POST['mediums_id'] ?? null,
                    'serviced_by' => $_POST['serviced_by'] ?? null,
                    'datetime_start' => $_POST['datetime_start'] ?? null,
                    'is_pullout' => isset($_POST['is_pullout']) ? 1 : null,
                    'datetime_end' => $_POST['datetime_end'] ?? null,
                    'is_turnover' => isset($_POST['is_turnover']) ? 1 : null,
                    'diagnosis' => str_replace("'", "&apos;", $_POST['diagnosis']),
                    'action_taken' => str_replace("'", "&apos;", $_POST['action_taken']),
                    'remarks' => str_replace("'", "&apos;", $_POST['remarks']),
                    'send_email' => $_POST['send_email'] ?? null
                ]);
            }
            $this->response = $this->model->updateHelpdesk($data, $_SESSION['role'], $_SESSION['id']);
        }

        if (isset($_POST['del_helpdesk'])) {
            $this->response = $this->model->deleteHelpdesk($_POST['helpdesks_id'], $_SESSION['role'], $_SESSION['id']);
        }

        if (isset($_POST['add_meeting'])) {
            $data = [
                'date_requested' => $_POST['date_requested'],
                'topic' => htmlspecialchars($_POST['topic'], ENT_QUOTES, 'UTF-8'),
                'date_scheduled' => $_POST['date_scheduled'],
                'time_start' => $_POST['time_start'],
                'time_end' => $_POST['time_end']
            ];
            if ($_SESSION['role'] == 'admin') {
                $data = array_merge($data, [
                    'requested_by' => !empty($_POST['requested_by']) ? $_POST['requested_by'] : $_SESSION['id'],
                    'hosts_id' => $_POST['hosts_id'] ?? null,
                    'm_statuses_id' => $_POST['m_statuses_id'] ?? 1,
                    'meeting_details' => htmlspecialchars($_POST['meeting_details'], ENT_QUOTES, 'UTF-8'),
                    'generated_by' => !empty($_POST['meeting_details']) ? $_SESSION['id'] : null,
                    'send_email' => $_POST['send_email'] ?? null
                ]);
            }
            $this->response = $this->model->addMeeting($data, $_SESSION['role'], $_SESSION['id']);
        }

        if (isset($_POST['upd_meeting'])) {
            $data = [
                'meetings_id' => $_POST['meetings_id'],
                'date_requested' => $_POST['date_requested'],
                'topic' => htmlspecialchars($_POST['topic'], ENT_QUOTES, 'UTF-8'),
                'date_scheduled' => $_POST['date_scheduled'],
                'time_start' => $_POST['time_start'],
                'time_end' => $_POST['time_end']
            ];
            if ($_SESSION['role'] == 'admin') {
                $data = array_merge($data, [
                    'requested_by' => !empty($_POST['requested_by']) ? $_POST['requested_by'] : $_SESSION['id'],
                    'hosts_id' => $_POST['hosts_id'] ?? null,
                    'm_statuses_id' => $_POST['m_statuses_id'] ?? 1,
                    'meeting_details' => htmlspecialchars($_POST['meeting_details'], ENT_QUOTES, 'UTF-8'),
                    'generated_by' => !empty($_POST['meeting_details']) ? $_SESSION['id'] : null,
                    'send_email' => $_POST['send_email'] ?? null
                ]);
            }
            $this->response = $this->model->updateMeeting($data, $_SESSION['role'], $_SESSION['id']);
        }

        if (isset($_POST['del_meeting'])) {
            $this->response = $this->model->deleteMeeting($_POST['meetings_id'], $_SESSION['id']);
        }

        if (isset($_POST['add_user'])) {
            $data = [
                'id_number' => $_POST['id_number'],
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'last_name' => $_POST['last_name'],
                'date_birth' => $_POST['date_birth'],
                'sex' => $_POST['sex'],
                'is_pwd' => $_POST['is_pwd'] ?? null,
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'designation' => $_POST['designation'],
                'offices_id' => $_POST['offices_id'],
                'divisions_id' => $_POST['divisions_id'],
                'client_types_id' => $_POST['client_types_id'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'roles_id' => $_POST['roles_id']
            ];
            $this->response = $this->model->addUser($data);
        }

        if (isset($_POST['upd_user'])) {
            $data = [
                'id' => $_POST['id'],
                'id_number' => $_POST['id_number'],
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'last_name' => $_POST['last_name'],
                'date_birth' => $_POST['date_birth'],
                'sex' => $_POST['sex'],
                'is_pwd' => $_POST['is_pwd'] ?? 0,
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'designation' => $_POST['designation'],
                'offices_id' => $_POST['offices_id'],
                'divisions_id' => $_POST['divisions_id'],
                'client_types_id' => $_POST['client_types_id'],
                'roles_id' => $_POST['roles_id']
            ];
            $this->response = $this->model->updateUser($data);
        }

        if (isset($_POST['del_user'])) {
            $this->response = $this->model->deleteUser($_POST['users_id']);
        }

        if (isset($_POST['reset_password'])) {
            $this->response = $this->model->resetPassword($_POST['users_id']);
        }

        if (isset($_POST['quick_csf'])) {
            $data = [
                'helpdesks_id' => $_POST['helpdesks_id'],
                'crit1' => $_POST['crit1'],
                'crit2' => $_POST['crit2'],
                'crit3' => $_POST['crit3'],
                'crit4' => $_POST['crit4'],
                'overall' => $_POST['overall'],
                'reasons' => $_POST['reasons'],
                'comments' => $_POST['comments']
            ];
            $this->response = $this->model->quickCsf($data);
        }
    }

    private function sendResponse()
    {
        header('Content-Type: application/json');
        echo json_encode($this->response);
        exit;
    }
}

$controller = new Controller();
$controller->handleRequest();
