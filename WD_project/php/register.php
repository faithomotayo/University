<!DOCTYPE html>
<html>
<head>
    <title>Signup Page</title>
    <link rel="stylesheet" href="../css/style.css">
    
</head>

<body>

<nav class="navbar">
        
        <h2> Reader's Corner</h2>

</nav>
    <!--Start php -->
    <?php

        // This creates a connection to the MySQL database
        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "libraryWeb";



        $conn = new mysqli($servername, $username, $password, $dbname);

        

        // Check connection

        if ($conn->connect_error)
        {

            die("Connection failed: " . $conn->connect_error);

        }


        if ($_SERVER["REQUEST_METHOD"] === "POST") 
        {
            // Validate that all required fields exist and are not empty
            $required_fields = ['username', 'firstname', 'surname', 'password', 'addressline1', 'city', 'telephone', 'mobile'];
            foreach ($required_fields as $field) 
            {
                if (empty($_POST[$field])) 
                {
                    echo "<p style='color: red;'>Error: $field is required.</p>";
                    exit;
                }
            }

        
        $stmt = $conn->prepare("INSERT INTO Users (Username, FirstName, Surname, Password, AddressLine1, AddressLine2, City, Telephone, Mobile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "sssssssss", 
            $_POST['username'], 
            $_POST['firstname'], 
            $_POST['surname'], 
            $_POST['password'], 
            $_POST['addressline1'], 
            $_POST['addressline2'], 
            $_POST['city'], 
            $_POST['telephone'], 
            $_POST['mobile']
        );



        if ($stmt->execute()) {
            echo "<p style='font-size: 22px; color: green; text-align: center;'>Your account has been created successfully!</p>";
        } else {
            echo "<p style='font-size: 22px; color: red; text-align: center;'>Error: " . $stmt->error . "</p>";
        }

    
        

        // I am closing the connection and the statement 

        $stmt->close();

    }

        $conn->close();

    ?>

        <!--End php -->

    <form action="register.php" method="post">
        <h2>Sign up</h2>

        <label> Username</label>
        <input type="text" name="username" placeholder="Username" required>
        <br>

        <label> First name </label>
        <input type="text" name="firstname" placeholder="First Name" required>
        <br>

        <label> Surname </label>
        <input type="text" name="surname" placeholder="Surname" required>
        <br>

        <label> Password </label>
        <input type="password" name="password" placeholder="Password" required>
        <br>

        <label> Address line 1 </label>
        <input type="text" name="addressline1" placeholder="Address Line 1.." required>
        <br>

        <label> Address line 2 </label>
        <input type="text" name="addressline2" placeholder="Address Line 2.." >
        <br>

        <label> City </label>
        <input type="text" name="city" placeholder="City" required>
        <br>

        <label> Telephone </label>
        <input type="text" name="telephone" placeholder="Telephone no." required>
        <br>
        
        <label> Mobile </label>
        <input type="text" name="mobile" placeholder="Mobile no." required>
        <br>


        <button type="submit"> Signup </button>

    </form>
     <!-- Sign-Up Link -->
    <p class="signup-link">
            Have an account? <a href="login.php">Sign Up</a>
        </p>
    <footer id="footer">
    ©2024 Created by <strong>Faith Omotayo</strong>
</footer>
</body>
</html>