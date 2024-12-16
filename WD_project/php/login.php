<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/style.css">
    
</head>

<body>
<nav class="navbar">
        
        <h2> Reader's Corner</h2>

</nav>
    <!--Start php -->
    <?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['username'])) {
    header('Location: index.php'); // Redirect to home if already logged in
    exit;
}

// Process login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "libraryWeb";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Validate credentials
    $sql = "SELECT * FROM Users WHERE Username = '$username' AND Password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $_SESSION['username'] = $username; // Store username in session
        header('Location: index.php'); // Redirect to home page
        exit;
    } else {
        $_SESSION['error'] = "Invalid username or password.";
    }

    $conn->close();
}
?>
    <!-- Display Error Message -->
    <?php if (isset($_SESSION["error"])): ?>
        <div class="error">
            <p style="color: red;"><?= $_SESSION["error"]; ?></p>
        </div>
        <?php unset($_SESSION["error"]); // Clear the error after displaying ?>
    <?php endif; ?>

        <!--End php -->

    <form action="login.php" method="post">
        <div class="login-box">
        <h2>Login</h2>

        <label> Username</label>
        <input type="text" name="username" placeholder="Username" required>
        <br>

        <label> Password </label>
        <input type="password" name="password" placeholder="Password" required>
        <br>

        <button type="submit"> Login </button>

    </div>
    </form>
     <!-- Sign-Up Link -->
     <p class="signup-link">
            Don't have an account? <a href="register.php">Sign Up</a>
        </p>
    <footer id="footer">
    ©2024 Created by <strong>Faith Omotayo</strong>
</footer>

</body>
</html>