<?php
$host = 'localhost';
$user = 'root';
$password = 'nraspberrypi$';
$database = 'lms_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>