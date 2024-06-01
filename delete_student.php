<?php
// This code will handle operation to delete student from the system in manage.php
include 'database.php';

if (isset($_POST['matric_id'])) {
    $matric_id = $_POST['matric_id'];

    // Prepare and execute the delete query for related entries in the attendance table
    $sql_delete_attendance = "DELETE FROM attendance WHERE student_id IN (SELECT id FROM student WHERE matric_id = ?)";
    $stmt_delete_attendance = $conn->prepare($sql_delete_attendance);
    $stmt_delete_attendance->bind_param("s", $matric_id);
    $stmt_delete_attendance->execute();

    // Prepare and execute the delete query for the student record
    $sql_delete_student = "DELETE FROM student WHERE matric_id = ?";
    $stmt_delete_student = $conn->prepare($sql_delete_student);
    $stmt_delete_student->bind_param("s", $matric_id);

    if ($stmt_delete_student->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt_delete_attendance->close();
    $stmt_delete_student->close();
    $conn->close();
} else {
    echo "invalid";
}
?>
