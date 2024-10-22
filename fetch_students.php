<?php
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "pms"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT full_name, matric_id, gender, ic_number FROM student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $no = 1;
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no . "</td>";
        echo "<td>" . $row["full_name"] . "</td>";
        echo "<td>" . $row["matric_id"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["ic_number"] . "</td>";
        echo '<td>
                <button class="edit-btn">Edit</button>
                <button class="delete-btn">Delete</button>
              </td>';
        echo "</tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='6'>No students found</td></tr>";
}
$conn->close();
?>
