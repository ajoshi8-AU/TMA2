<?php
$host = 'tmamysqlserver.mysql.database.azure.com';
$user = 'server_admin';
$password = 'login_TMA2';
$database = 'lms_db';
$ssl_cert ='/../DigiCertGlobalRootG2.crt.pem';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
?>
