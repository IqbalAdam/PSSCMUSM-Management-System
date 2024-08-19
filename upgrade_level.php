<?php
// This code is used when students in each level are proceeding to the next academic session
// Include the database connection file
include 'database.php';

// Start a transaction
$conn->begin_transaction();

try {
    // Get the current year
    $currentYear = date("Y");

    // Use a temporary value for level shifting
    $conn->query("UPDATE student SET level = 0, end_year = $currentYear WHERE level = 300");
    $conn->query("UPDATE student SET level = 300 WHERE level = 200");
    $conn->query("UPDATE student SET level = 200 WHERE level = 100");

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
