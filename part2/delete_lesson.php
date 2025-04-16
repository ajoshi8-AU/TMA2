<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$lesson_id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM lessons WHERE id = ?");
$stmt->bind_param("i", $lesson_id);
$stmt->execute();

header("Location: dashboard.php");
exit();
?>
