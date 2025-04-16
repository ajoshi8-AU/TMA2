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
            <?php if (isset($_SESSION['user_id'])): ?>
                <button><a href="dashboard.php">Dashboard</a></button>
                <button><a href="logout.php">Logout</a></button>
            <?php else: ?>
                <button><a href="register.php">Register</a></button>
                <button><a href="login.php">Login</a></button>
            <?php endif; ?>
        </ul>
    </nav>
    <main>
        <section class="welcome">
            <h2>About This Platform</h2>
            <p>This web application is designed to help you learn various web technologies covered in our course, including HTML5, CSS3, and JavaScript.</p>
            <p>Here, you will find tutorials for each of these technologies, followed by quizzes to test your understanding. Our goal is to provide a user-friendly and effective learning experience.</p>
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