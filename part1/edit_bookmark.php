<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

$error = '';
$success = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $bookmark_id = (int) $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Fetch bookmark
    $stmt = $conn->prepare("SELECT id, url, title FROM bookmarks WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $bookmark_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookmark = $result->fetch_assoc();

    if (!$bookmark) {
        die("Bookmark not found or unauthorized access.");
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $url = trim($_POST['url']);
        $title = trim($_POST['title']);

        if (empty($url)) {
            $error = "URL is required.";
        } else {
            $stmt = $conn->prepare("UPDATE bookmarks SET url = ?, title = ? WHERE id = ? AND user_id = ?");
            $stmt->bind_param("ssii", $url, $title, $bookmark_id, $user_id);

            if ($stmt->execute()) {
                $success = "Bookmark updated successfully!";
                $bookmark['url'] = $url;
                $bookmark['title'] = $title;
            } else {
                $error = "Failed to update bookmark. Please try again.";
            }
        }
    }
} else {
    die("Invalid bookmark ID.");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Bookmark</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Bookmark</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php else: ?>
            <form method="post" onsubmit="return validateURL('url')">
                <label for="url">URL:</label>
                <input type="text" id="url" name="url" value="<?php echo htmlspecialchars($bookmark['url']); ?>" required>

                <label for="title">Title (Optional):</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($bookmark['title']); ?>">

                <button type="submit">Update Bookmark</button>
            </form>
        <?php endif; ?>

        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>

    <script src="validate.js"></script>
</body>
</html>
