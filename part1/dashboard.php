<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM bookmarks WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <ul>
            <button><a href="add_bookmark.php">Add Bookmark</a></button> 
            <button><a href="logout.php">Logout</a></button>
        </ul>
        <h2>My Bookmarks</h2>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <p>
                        <a href="<?php echo $row['url']; ?>" target="_blank">
                            <?php echo $row['title'];?>
                        </a>
                    </p>
                    <button><a href="edit_bookmark.php?id=<?php echo $row['id']; ?>">Edit</a></button>
                    <button><a href="delete_bookmark.php?id=<?php echo $row['id']; ?>">Delete</a></button>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>