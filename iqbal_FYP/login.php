<?php
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

// Hash the password
$password_hashed = md5($password); // You should use stronger hashing algorithms like bcrypt or argon2

// Query the database using prepared statement
$sql = "SELECT username, password FROM pms.admin WHERE username=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password_hashed);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Login successful, redirect to index.html
    header("Location: index.html");
    exit();
} else {
    // Invalid credentials, redirect back to login page with an error message
    header("Location: login.html?error=1");
    exit();
}

$stmt->close();
$conn->close();
?>