<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $url = $_POST['url'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO bookmarks (user_id, title, url) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $user_id, $title, $url);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bookmark</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Add New Bookmark</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php else: ?>
            <form method="post" onsubmit="return validateURL()">
                <label for="title">Title:</label>
                <input type="text" name="title" placeholder="Bookmark Title" required>
                <label for="url">URL:</label>
                <input type="url" name="url" id="url" placeholder="Bookmark URL  Use 'https://'" required>
                <button type="submit">Add Bookmark</button>
            </form>
        <?php endif; ?>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
    <script src="validate.js"></script>
</body>
</html>