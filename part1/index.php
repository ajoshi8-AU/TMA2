<?php
session_start();
include "db.php";

$query = "SELECT * FROM bookmarks ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookmarking Service</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
         <?php if (isset($_SESSION['user_id'])): ?>
            <header>
                <h1>Welcome <?php echo $_SESSION['username']; ?>!</h1>
                <button><a href="logout.php">Logout</a></button>
                <button><a href="dashboard.php">Go to Dashboard</a></button>
            </header>
            <h2>Popular Bookmarks</h2>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li><a href="<?php echo $row['url']; ?>" target="_blank"><?php echo $row['title']; ?></a></li>
                <?php endwhile; ?>
            </ul>
    <?php else: ?>

        <header>
            <button><a href="login.php">Login</a></button>
            <button><a href="register.php">Register</a></button>
            <h1>Welcome to Our Online Bookmarking Service</h1>
        </header>
        <p>Organize your favorite websites in one place!</p>
        <h2>Popular Bookmarks</h2>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li><a href="<?php echo $row['url']; ?>" target="_blank"><?php echo $row['title']; ?></a></li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>



    </div>
</body>
</html>