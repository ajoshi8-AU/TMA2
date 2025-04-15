<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$lesson_id = intval($_GET['id']);
$success = '';
$error = '';

// Fetch lesson to pre-fill the form
$stmt = $conn->prepare("SELECT title, course, eml_content FROM lessons WHERE id = ?");
$stmt->bind_param("i", $lesson_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $error = "Lesson not found.";
} else {
    $lesson = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_title = $_POST['title'];
    $new_course = $_POST['course'];
    $new_content = $_POST['eml_content'];

    $update_stmt = $conn->prepare("UPDATE lessons SET title = ?, course = ?, eml_content = ? WHERE id = ?");
    $update_stmt->bind_param("sssi", $new_title, $new_course, $new_content, $lesson_id);

    if ($update_stmt->execute()) {
        $success = "Lesson updated successfully.";
        // Refresh lesson content
        $lesson = ['title' => $new_title, 'course' => $new_course, 'eml_content' => $new_content];
    } else {
        $error = "Failed to update lesson.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Lesson</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <button><a href="dashboard.php">Back to Dashboard</a></button>
    <h2>Edit Lesson</h2>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>

    <?php if (!empty($lesson)): ?>
        <form method="POST">
            <label for="title">Lesson Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($lesson['title']); ?>" required>

            <label for="course">Course Name:</label>
            <input type="text" id="course" name="course" value="<?php echo htmlspecialchars($lesson['course']); ?>" required>

            <label for="eml_content">EML Content:</label>
            <textarea id="eml_content" name="eml_content" rows="15" cols="80"><?php echo htmlspecialchars($lesson['eml_content']); ?></textarea>

            <button type="submit">Update Lesson</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
