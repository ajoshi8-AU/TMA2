<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Learning Platform</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome to Our Learning Platform</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <main>
        <section class="welcome">
            <h2>About This Platform</h2>
            <p>This web application is designed to help you learn various web technologies covered in our course, including HTML5, CSS3, and JavaScript [2, 3].</p>
            <p>Here, you will find tutorials for each of these technologies, followed by quizzes to test your understanding [3, 4]. Our goal is to provide a user-friendly and effective learning experience [5].</p>
            <h3>Getting Started</h3>
            <?php if (isset($_SESSION['user_id'])): ?>
                <p>You are logged in. Proceed to your <a href="dashboard.php">Dashboard</a> to access the lessons.</p>
            <?php else: ?>
                <p>To get started, please <a href="register.php">register</a> for a new account or <a href="login.php">login</a> if you already have one.</p>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Online Learning Platform</p>
    </footer>
</body>
</html>