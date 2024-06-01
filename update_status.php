<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'database.php';

    $matric_id = $_POST['matric_id'];
    $status = $_POST['status'];

    $sql = "UPDATE student SET status = ? WHERE matric_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $status, $matric_id);

    if ($stmt->execute()) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
