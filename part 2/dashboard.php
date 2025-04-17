<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
    require_once 'db.php';

    $stmt = $pdo->prepare("SELECT * FROM lessons");
    $stmt->execute();
    $lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Online Learning Platform</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome to Your Dashboard</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <main>
        <section class="dashboard">
            <h2>Available Lessons</h2>
            <?php if (empty($lessons)): ?>
                <p>No lessons are currently available.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($lessons as $lesson): ?>
                        <li><a href="lesson.php?id=<?php echo $lesson['lesson_id']; ?>"><?php echo htmlspecialchars($lesson['title']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Online Learning Platform</p>
    </footer>
</body>
</html>