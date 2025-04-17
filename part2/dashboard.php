<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT id, title FROM lessons ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Learning Platform</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div class="container">
        <h2>Welcome to Your Dashboard</h2>
        <button><a href="logout.php">Logout</a></button>
        <button><a href="add_lesson.php">Add New Lesson</a></button>


        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($lesson = $result->fetch_assoc()): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($lesson['title']); ?></strong>
                        <button><a href="lesson.php?id=<?php echo $lesson['id']; ?>">View</a></button>
                        <button><a href="edit_lesson.php?id=<?php echo $lesson['id']; ?>">Edit</a> </button>
                        <button><a href="delete_lesson.php?id=<?php echo $lesson['id']; ?>" onclick="return confirm('Are you sure you want to delete this lesson?');">Delete</a></button>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No lessons found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
