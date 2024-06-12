<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['class_id'])) {
        $class_id = intval($_POST['class_id']);
        $_SESSION['class_id'] = $class_id;
        echo "Class ID stored in session.";
    } elseif (isset($_POST['class_date'])) {
        $class_date = $_POST['class_date'];

        // Connect to the database
        $mysqli = new mysqli("localhost", "root", "", "pms");

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Insert a new class and get the class_id
        $stmt = $mysqli->prepare("INSERT INTO class (class_date) VALUES (?)");
        $stmt->bind_param("s", $class_date);
        $stmt->execute();
        $class_id = $stmt->insert_id;
        $stmt->close();
        $mysqli->close();

        // Store class_id in session
        $_SESSION['class_id'] = $class_id;
        echo $class_id;
    }
}
?>
