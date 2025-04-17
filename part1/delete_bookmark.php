<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
require_once 'db.php';

// Validate bookmark ID from GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $bookmark_id = (int) $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Delete bookmark only if it belongs to the current user
    $stmt = $conn->prepare("DELETE FROM bookmarks WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $bookmark_id, $user_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php?message=Bookmark+deleted+successfully");
        exit();
    } else {
        header("Location: dashboard.php?error=Failed+to+delete+bookmark");
        exit();
    }
} else {
    header("Location: dashboard.php?error=Invalid+bookmark+ID");
    exit();
}
?>
