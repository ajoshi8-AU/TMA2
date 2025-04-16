<?php
$host = 'tmamysqlserver.mysql.database.azure.com';
$user = 'server_admin';
$password = 'login_TMA2';
$database = 'lms_db';
$ssl_cert ='/../DigiCertGlobalRootG2.crt.pem';

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, $ssl_cert, NULL, NULL);

if (!mysqli_real_connect($conn, $host, $user, $password, $database, 3306, NULL, MYSQLI_CLIENT_SSL)) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
