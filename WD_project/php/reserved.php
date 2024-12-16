
<?php
//this starts my session
session_start();

 // This creates a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "libraryWeb";



$conn = new mysqli($servername, $username, $password, $dbname);




if ($conn->connect_error)
{

    die("Connection failed: " . $conn->connect_error);

}


if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] =='POST') 
{
    $isbn = $_POST['isbn'];
    $username = $_SESSION['username'];

    // Check if the book is already reserved by the user
    $checkBookSQL = "SELECT * FROM Reservations WHERE ISBN = ? ";
    $stmt = $conn -> prepare($checkBookSQL);
    $stmt ->bind_param("s", $isbn);
    $stmt -> execute();
    $result = $stmt ->get_result();

    if ($result->num_rows > 0) 
    {
        echo"<p> Book has already been reserved! </p>";
    } else {
        // Insert reservation
        $sql = "INSERT INTO Reservations (ISBN, Username, ReservedDate) VALUES ('?', '?', NOW())";
        $stmt = $conn ->prepare($reserveQuery);
        $stmt ->bind_param("ss", $isbn, $username);

        if ($stmt->execute()) {
            echo"<p> Book has been reserved successfully! </p>";
        } else {
            echo"<p> Error reserving book:" . $conn -> error . " </p>";
        }
    }
}


?>


