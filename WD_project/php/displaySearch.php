<!DOCTYPE html>
<html>
<head>
    <title>Search for a Book</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
</head>

<body>

<nav class="navbar">
        
            <a href="displayReserved.php">Reserve</a>
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
    exit;
}

$username = $_SESSION['username']; 

// Create a connection to the MySQL database
$servername = "localhost";
$myusername = "root";
$password = ""; 
$dbname = "libraryWeb";

$conn = new mysqli($servername, $myusername, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserve'])) {
    $isbn = $_POST['reserve'];

    // Check if the book is already reserved
    $checkQuery = "SELECT * FROM `Reservations` WHERE ISBN = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='container'><p class='text-danger'>Book is already reserved!</p></div>";
    } else {
        // Reserve the book
        $reserveQuery = "INSERT INTO `Reservations` (ISBN, Username, ReservedDate) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($reserveQuery);
        $stmt->bind_param("ss", $isbn, $username);
        if ($stmt->execute()) {
            echo "<div class='container'><p class='text-success'>Book reserved successfully!</p></div>";
        } else {
            echo "<div class='container'><p class='text-danger'>Error reserving book: " . $conn->error . "</p></div>";
        }
    }
}

// Retrieve the search term
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$category = isset($_GET['category']) ? $conn->real_escape_string($_GET['category']) : '';
$results_html = ''; // To hold the HTML for search results

// Validate search input
if (!empty($search)) {
    $sql = "SELECT * FROM `Books` WHERE Author LIKE '%$search%' OR BookTitle LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $results_html .= '<div class="container">
                            <form method="POST">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>Edition</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

        while ($row = $result->fetch_assoc()) {
            $results_html .= '<tr>
                                <td>' . htmlspecialchars($row['BookTitle']) . '</td>
                                <td>' . htmlspecialchars($row['Author']) . '</td>
                                <td>' . htmlspecialchars($row['Category']) . '</td>
                                <td>' . htmlspecialchars($row['Edition']) . '</td>
                                <td>
                                    <button class="btn btn-primary" type="submit" name="reserve" value="' . htmlspecialchars($row['ISBN']) . '">Reserve</button>
                                </td>
                            </tr>';
        }

        $results_html .= '</tbody></table></form></div>';
    } else {
        $results_html = "<div class='container'><h2>No results found for '" . htmlspecialchars($search) . "'</h2></div>";
    }
} else {
    $results_html = "<div class='container'><h2>Invalid search query.</h2></div>";
}

echo $results_html; // Output the results
?>

<footer id="footer">
    ©2024 Created by <strong>Faith Omotayo</strong>
</footer>
</body>
</html>
