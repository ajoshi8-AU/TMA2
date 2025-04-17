<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $course = trim($_POST['course']);
    $eml_content = trim($_POST['eml_content']);

    if (empty($title) || empty($course) || empty($eml_content)) {
        $error = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO lessons (title, course, eml_content) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $course, $eml_content);

        if ($stmt->execute()) {
            $success = "Lesson added successfully.";
        } else {
            $error = "Failed to add lesson.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Lesson</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <div class= "container">
            <h1>Add New Lesson</h1>
            <button><a href="dashboard.php">Dashboard</a></button>
            <section class="form-section">
                <?php if ($error): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
                <?php if ($success): ?>
                    <p class="success"><?php echo $success; ?></p>
                <?php endif; ?>

                <form method="post">
                    <label for="title">Lesson Title:</label>
                    <input type="text" name="title" id="title" required>

                    <label for="course">Course Name:</label>
                    <input type="text" name="course" id="course" required>

                    <label for="eml_content">EML Content:</label>
                    <textarea name="eml_content" id="eml_content" rows="10" required></textarea>

                    <button>Add Lesson</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
