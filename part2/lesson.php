<?php
session_start();
require_once 'db.php';
require_once 'parse_eml.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$lesson_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT title, eml_content FROM lessons WHERE id = ?");
$stmt->bind_param("i", $lesson_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $lesson_title = "Lesson Not Found";
    $html_content = "<p>The requested lesson could not be found.</p>";
    $quiz_html = "";
} else {
    $lesson = $result->fetch_assoc();
    $lesson_title = htmlspecialchars($lesson['title']);
    $html_content = parseEML($lesson['eml_content'], false);
    $quiz_html = parseEML($lesson['eml_content'], true, true); // quiz-only
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $lesson_title; ?> - Lesson</title>
    <link rel="stylesheet" href="styles.css">
    <script src="js/ajax.js" defer></script>
</head>
<body>
    <div class="container">
        <button><a href="dashboard.php">Back to Dashboard</a></button>
        <h2><?php echo $lesson_title; ?></h2>
        <div class="lesson-content">
            <?php echo $html_content; ?>
        </div>

        <button id="toggleQuizBtn" class="button" onclick="toggleQuiz()">Take Quiz</button>

        <div id="quizContainer" class="quiz" style="display: none;">
            <?php echo $quiz_html; ?>
            <div id="quizResult"></div>
        </div>


    </div>
</body>
</html>
