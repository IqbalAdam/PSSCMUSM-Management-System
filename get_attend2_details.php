<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);

    // Connect to the database
    $mysqli = new mysqli("localhost", "root", "", "pms");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Fetch student details based on the ID
    $stmt = $mysqli->prepare("SELECT full_name, matric_id, gender, school, image FROM student WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    echo json_encode($student);

    $stmt->close();
    $mysqli->close();
}
?>
