<?php
// Include the database connection file
include 'database.php';

// Start a transaction
$conn->begin_transaction();

try {
    // Use a temporary value for level shifting
    $conn->query("UPDATE student SET level = 500 WHERE level = 300");
    $conn->query("UPDATE student SET level = 300 WHERE level = 200");
    $conn->query("UPDATE student SET level = 200 WHERE level = 100");
    $conn->query("DELETE FROM student WHERE level = 400");
    $conn->query("UPDATE student SET level = 400 WHERE level = 500");

    // Commit the transaction
    $conn->commit();

    echo "Level upgrade successful.";
} catch (Exception $e) {
    // Rollback the transaction if something failed
    $conn->rollback();

    echo "Level upgrade failed: " . $e->getMessage();
}

// Close the database connection
$conn->close();
?>
