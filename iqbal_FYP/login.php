<?php
session_start();

// Establish database connection
$servername = "localhost";
$username_db = "root"; // Assuming you are using the default root user
$password_db = ""; // Assuming no password is set
$database = "pms";

$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username and password from POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Sanitize input
$username = $conn->real_escape_string($username);

// Query the database using prepared statement to check if the username exists
$sql = "SELECT username, password FROM pms.admin WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Username exists, now fetch the hashed password and verify
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Password is correct, set session variables
        $_SESSION['username'] = $username;

        // Redirect to index.html
        header("Location: index.html");
        exit();
    } else {
        // Password is incorrect, redirect back to login page with an error message
        header("Location: login.html?error=1");
        exit();
    }
} else {
    // Username doesn't exist, redirect back to login page with an error message
    header("Location: login.html?error=1");
    exit();
}

$stmt->close();
$conn->close();
?>
