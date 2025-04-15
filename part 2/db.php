<?php
$host = 'tmamysqlserver.mysql.database.azure.com';
$user = 'server_admin@tmamysqlserver';
$password = 'login_TMA2';
$database = 'lms_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>