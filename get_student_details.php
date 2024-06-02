<?php
include 'database.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "SELECT * FROM student WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
  } else {
    echo json_encode([]);
  }
}

$conn->close();
?>
