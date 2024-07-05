<?php
// This code handle process of fetching student details in database and display in attend2.html
if (isset($_POST['id'])) {
    $hex_id = $_POST['id'];
    $id = hexdec($hex_id); // Convert the hexadecimal ID to decimal

    // Log the received hexadecimal and converted decimal ID
    error_log("Received hex ID: " . $hex_id);
    error_log("Converted decimal ID: " . $id);

    // Connect to the database
    $mysqli = new mysqli("localhost", "root", "", "pms");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Fetch student details based on the ID
    $stmt = $mysqli->prepare("SELECT full_name, matric_id, gender, school, image FROM student WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
        $stmt->close();

        // Log the fetched student details
        error_log("Student details fetched: " . json_encode($student));

        // Get the class ID from the URL
        $class_id = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY) : '';
        parse_str($class_id, $query_params);
        $class_id = isset($query_params['class_ID']) ? $query_params['class_ID'] : '';

        if ($student) {
            // Check if the class ID and student ID combination already exists in the attendance table
            $check_stmt = $mysqli->prepare("SELECT * FROM attendance WHERE class_id = ? AND student_id = ?");
            if ($check_stmt) {
                $check_stmt->bind_param("ii", $class_id, $id);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();

                if ($check_result->num_rows == 0) {
                    // Insert the class ID and student ID into the attendance table
                    $insert_stmt = $mysqli->prepare("INSERT INTO attendance (class_id, student_id) VALUES (?, ?)");
                    if ($insert_stmt) {
                        $insert_stmt->bind_param("ii", $class_id, $id);
                        $insert_stmt->execute();
                        $insert_stmt->close();
                    } else {
                        error_log("Insert statement preparation failed: " . $mysqli->error);
                    }
                }
                $check_stmt->close();
            } else {
                error_log("Check statement preparation failed: " . $mysqli->error);
            }

            echo json_encode($student);
        } else {
            error_log("No student found with the provided ID.");
            echo json_encode([]);
        }
    } else {
        error_log("Statement preparation failed: " . $mysqli->error);
    }

    $mysqli->close();
} else {
    error_log("No ID received.");
}
?>
