<?php
if (isset($_POST['id'])) {
    $hex_id = $_POST['id'];
    $id = hexdec($hex_id); // Convert the hexadecimal ID to decimal

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

    // Get the class ID from the URL
    $class_id = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY) : '';
    parse_str($class_id, $query_params);
    $class_id = isset($query_params['class_ID']) ? $query_params['class_ID'] : '';

    // Check if the class ID and student ID combination already exists in the attendance table
    $check_stmt = $mysqli->prepare("SELECT * FROM attendance WHERE class_id = ? AND student_id = ?");
    $check_stmt->bind_param("ii", $class_id, $id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows == 0) {
        // Insert the class ID and student ID into the attendance table
        $insert_stmt = $mysqli->prepare("INSERT INTO attendance (class_id, student_id) VALUES (?, ?)");
        $insert_stmt->bind_param("ii", $class_id, $id);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    // Return student details as JSON
    echo json_encode($student);

    $stmt->close();
    $check_stmt->close();
    $mysqli->close();
}
?>
