<?php
class DB
{
    // Database credentials
    private $dbHost = "localhost";
    private $dbUsername = "zoomrequestadmin";
    private $dbPassword = "!r7TG4WuxCRJUgoo";
    private $dbName = "zoom_tokens";

    public function __construct()
    {
        if (!isset($this->db)) {
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die("Failed to connect with MySQL: " . $conn->connect_error);
            } else {
                $this->db = $conn;
            }
        }
    }

    // Check is table empty
    public function is_table_empty()
    {
        $result = $this->db->query("SELECT id FROM `RO`");
        if ($result->num_rows) {
            return false;
        }

        return true;
    }

    // Get access token
    public function get_access_token()
    {
        $sql = $this->db->query("SELECT access_token FROM `RO`");
        $result = $sql->fetch_assoc();
        return json_decode($result['access_token']);
    }

    // Get referesh token
    public function get_refersh_token()
    {
        $result = $this->get_access_token();
        return $result->refresh_token;
    }

    // Update access token
    public function update_access_token($token)
    {
        if ($this->is_table_empty()) {
            $this->db->query("INSERT INTO `RO`(access_token) VALUES('$token')");
        } else {
            $sql = "UPDATE `RO` SET access_token = '$token' WHERE id = 1";
           // echo $sql;
            if ($this->db->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $this->db->error;
            }
        }
    }
}