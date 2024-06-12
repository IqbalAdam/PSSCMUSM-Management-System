<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$class_id = $input['class_id'];

if (!$class_id) {
    echo json_encode(['success' => false, 'message' => 'Invalid class ID']);
    exit;
}

include 'database.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

$conn->begin_transaction();

try {
    // Delete from attendance table
    $stmt = $conn->prepare("DELETE FROM attendance WHERE class_id = ?");
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $stmt->close();

    // Delete from class table
    $stmt = $conn->prepare("DELETE FROM class WHERE class_id = ?");
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $stmt->close();

    $conn->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Transaction failed: ' . $e->getMessage()]);
}

$conn->close();
?>
