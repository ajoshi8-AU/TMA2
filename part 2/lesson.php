<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
    require_once 'db.php';
    require_once 'parse_eml.php';

    if (isset($_GET['id'])) {
        $lesson_id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM lessons WHERE lesson_id = ?");
        $stmt->execute([$lesson_id]);
        $lesson = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($lesson) {
            $html_content = parseEML($lesson['eml_content']);
            $lesson_title = htmlspecialchars($lesson['title']);
        } else {
            $lesson_title = 'Lesson Not Found';
            $html_content = '<p>The requested lesson could not be found.</p>';
        }
    } else {
        header('Location: dashboard.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lesson_title; ?> - Online Learning Platform</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><?php echo $lesson_title; ?></h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <main>
        <section class="lesson-content">
            <?php echo $html_content; ?>
            <div class="quiz-button">
                <a href="quiz.php?lesson_id=<?php echo $lesson_id; ?>">Take Quiz</a>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Online Learning Platform</p>
    </footer>
</body>
</html>
./part2/parse_eml.php
<?php
function parseEML($eml_content) {
    $html = '';
    $lines = explode("\n", trim($eml_content));
    foreach ($lines as $line) {
        $line = trim($line);
        if (strpos($line, '<h>') === 0) {
            $level = strlen(strstr($line, ' ', true)) - 1;
            $text = trim(substr(strstr($line, ' '), 1));
            $html .= "<h" . ($level + 1) . ">" . htmlspecialchars($text) . "</h" . ($level + 1) . ">\n";
        } elseif (strpos($line, '<p>') === 0) {
            $text = trim(substr($line, 3, -4));
            $html .= "<p>" . htmlspecialchars($text) . "</p>\n";
        } elseif (strpos($line, '<ul>') === 0) {
            $html .= "<ul>\n";
        } elseif (strpos($line, '</ul>') === 0) {
            $html .= "</ul>\n";
        } elseif (strpos($line, '<li>') === 0) {
            $text = trim(substr($line, 4, -5));
            $html .= "<li>" . htmlspecialchars($text) . "</li>\n";
        } elseif (strpos($line, '<code>') === 0) {
            $text = trim(substr($line, 6, -7));
            $html .= "<code>" . htmlspecialchars($text) . "</code>\n";
        } elseif (strpos($line, '<important>') === 0) {
            $text = trim(substr($line, 11, -12));
            $html .= "<strong class=\"important\">" . htmlspecialchars($text) . "</strong>\n";
        }
        // Add more EML tag parsing logic as needed [6, 7]
    }
    return $html;
}
?>