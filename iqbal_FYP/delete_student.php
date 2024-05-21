<?php
include 'database.php';

if (isset($_POST['matric_id'])) {
    $matric_id = $_POST['matric_id'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM student WHERE matric_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "invalid";
}
?>
