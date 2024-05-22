<?php

// Database configuration
define('servername', 'localhost');
define('username', 'root');
define('password', 'Password@123!');
define('dbname', 'dti6db');
define('website', 'DTI6 ISDS');
define('website_name', 'DTI6 ICT Service Desk System (ISDS)');

// Encryption
define('encryptionkey', 'dti2024mis');

// reCAPTCHA
define('sitekey', '6Lft7NwpAAAAAM3QW8pbRWyI7ncR3RlYr_49MP0H');
define('secretkey', '6Lft7NwpAAAAAPdcd9QTOk4d5Jh8Ra8tFY71p7Zm');

// root
define('root', 'isds');

// Establishing connection
$conn = new mysqli(servername, username, password, dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}