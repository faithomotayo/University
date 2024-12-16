<!DOCTYPE html>
<html>
<head>
    <title>My Reserved Books</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
</head>

<body>
<nav class="navbar">
        
            <a href="index.php">Home</a>
            <a href="search.php">Search</a>
            <a href="logout.php">Log out</a>

</nav>
<div class="library-content">
            <h1>Reader's Corner</h1>
            <img src="../images/people.jpeg" alt="People reading" width="1000" height="400" class="header-img">
</div>
<?php
session_start(); // Start the session to track the logged-in user

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

$username = $_SESSION['username']; // Retrieve the logged-in user's username

// Create a connection to the MySQL database
$servername = "localhost";
$dbUsername = "root";
$password = ""; 
$dbname = "libraryWeb";

$conn = new mysqli($servername, $dbUsername, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch reserved books with details
$sql = "SELECT * FROM `Reservations` 
        JOIN `Books` ON Reservations.ISBN = Books.ISBN 
        WHERE `Username` = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container">
    <h2>My Reserved Books</h2>
    <?php if ($result && $result->num_rows > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Edition</th>
                    <th>Year</th>
                    <th>Reserved Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ISBN']); ?></td>
                        <td><?php echo htmlspecialchars($row['BookTitle']); ?></td>
                        <td><?php echo htmlspecialchars($row['Author']); ?></td>
                        <td><?php echo htmlspecialchars($row['Edition']); ?></td>
                        <td><?php echo htmlspecialchars($row['Year']); ?></td>
                        <td><?php echo htmlspecialchars($row['ReservedDate']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-warning">You have not reserved any books.</p>
    <?php endif; ?>
</div>
<footer id="footer">
    ©2024 Created by <strong>Faith Omotayo</strong>
</footer>
</body>
</html>
