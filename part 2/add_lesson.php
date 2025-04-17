<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
    require_once 'db.php';

    $message = '';
    if (isset($_POST['add_lesson'])) {
        $title = $_POST['title'];
        $eml_content = $_POST['eml_content'];

        $stmt = $pdo->prepare("INSERT INTO lessons (title, eml_content) VALUES (?, ?)");
        try {
            $stmt->execute([$title, $eml_content]);
            $message = 'Lesson added successfully.';
        } catch (PDOException $e) {
            $message = 'Error adding lesson: ' . $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Lesson - Online Learning Platform</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Add a New Lesson</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <main>
        <section class="add-lesson-form">
            <h2>Create a New Lesson</h2>
            <?php if ($message): ?>
                <p class="<?php echo (strpos($message, 'success') !== false) ? 'success' : 'error'; ?>"><?php echo $message; ?></p>
            <?php endif; ?>
            <form method="post">
                <label for="title">Lesson Title:</label>
                <input type="text" id="title" name="title" required><br><br>
                <label for="eml_content">EML Content:</label><br>
                <textarea id="eml_content" name="eml_content" rows="15" cols="80" placeholder="Start your lesson content here using EML tags like <h>Title</h>, <p>Paragraph</p>, <ul><li>Item</li></ul>, <code>Code</code>, <important>Important Text</important>"></textarea><br><br>
                <button type="submit" name="add_lesson">Add Lesson</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Online Learning Platform</p>
    </footer>
</body>
</html>
./part2/db.php
<?php
$host = 'localhost';
$dbname = 'learning_platform';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?><h>Introduction to HTML5</h>
<p>HTML5 is the latest evolution of the standard that defines the structure of web pages [3, 5]. It introduces many new features and improvements over previous versions.</p>
<h>Page Structure Elements</h>
<p>HTML5 provides semantic elements to better describe the structure of your document. Here are five important page-structure elements [4]:</p>
<ul>
    <li><important>&lt;header&gt;</important>: Represents the introductory content, usually containing the site's logo or main heading.</li>
    <li><important>&lt;nav&gt;</important>: Defines a section of navigation links.</li>
    <li><important>&lt;main&gt;</important>: Represents the dominant content of the document.</li>
    <li><important>&lt;article&gt;</important>: A self-contained composition in a document, page, application, or site.</li>
    <li><important>&lt;aside&gt;</important>: Content loosely related to the main content of the page.</li>
    <li><important>&lt;footer&gt;</important>: Typically contains information about the author, copyright data, links to terms of use, etc.</li>
</ul>
<h>New Input Types</h>
<p>HTML5 introduces several new input types for forms, providing better user interfaces and built-in validation [4, 8, 9]:</p>
<ul>
    <li><important>email</important>: For email addresses.</li>
    <li><important>url</important>: For URLs.</li>
    <li><important>number</important>: For numeric input.</li>
    <li><important>range</important>: For a slider control.</li>
    <li><important>date</important>: For selecting a date.</li>
    <li><important>time</important>: For selecting a time.</li>
    <li><important>color</important>: For a color picker.</li>
</ul>
<p>Example of a new input type:</p>
<code>
    &lt;input type="email" name="user_email"&gt;
</code>
./part2/eml/css3.eml
<h>Introduction to CSS3</h>
<p>CSS3 is the latest standard for styling web pages, building upon CSS2 with new modules and features [3, 5, 10]. It allows for more sophisticated and visually appealing designs.</p>
<h>Key Features of CSS3</h>
<ul>
    <li><important>Selectors</important>: More powerful ways to target HTML elements.</li>
    <li><important>Box Model</important>: Enhancements like `box-sizing`.</li>
    <li><important>Backgrounds and Borders</important>: Rounded corners, shadows, and more.</li>
    <li><important>Text Effects</important>: Shadows and other text manipulations.</li>
    <li><important>Transitions and Animations</important>: Creating dynamic visual effects.</li>
    <li><important>Transforms</important>: Rotating, scaling, skewing elements.</li>
    <li><important>Layout Modules</important>: Flexbox and Grid for advanced layouts.</li>
    <li><important>Media Queries</important>: Applying different styles for different screen sizes [10].</li>
</ul>
<p>Example of CSS3 rounded corners:</p>
<code>
    .rounded-box {
        border-radius: 10px;
    }
</code>
<p>Example of a media query:</p>
<code>
    @media (max-width: 600px) {
        body {
            font-size: 14px;
        }
    }
</code>
./part2/eml/javascript.eml
<h>Introduction to JavaScript</h>
<p>JavaScript is a client-side scripting language that adds interactivity to web pages [3, 5, 10-13]. It allows you to manipulate the Document Object Model (DOM), handle events, and make asynchronous requests.</p>
<h>Core Concepts</h>
<ul>
    <li><important>Variables and Data Types</important>: Storing and manipulating different kinds of data.</li>
    <li><important>Operators</important>: Performing operations on data.</li>
    <li><important>Control Structures</important>: `if/else`, `for`, `while` to control the flow of execution [11].</li>
    <li><important>Functions</important>: Reusable blocks of code [11].</li>
    <li><important>Arrays</important>: Collections of data [11].</li>
    <li><important>Objects</important>: Entities with properties and methods [11].</li>
    <li><important>DOM Manipulation</important>: Accessing and modifying HTML elements [11, 14].</li>
    <li><important>Events</important>: Responding to user interactions [11, 15].</li>
    <li><important>Ajax</important>: Making asynchronous requests to the server [11, 16].</li>
</ul>
<p>Example of JavaScript DOM manipulation:</p>
<code>
    document.getElementById("myElement").innerHTML = "Hello JavaScript!";
</code>
<p>Example of an event listener:</p>
<code>
    document.getElementById("myButton").addEventListener("click", function() {
        alert("Button clicked!");
    });
</code>