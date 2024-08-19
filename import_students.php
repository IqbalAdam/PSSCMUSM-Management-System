<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['file']['name'])) {
    $file = $_FILES['file']['tmp_name'];

    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    $conn = new mysqli('localhost', 'root', '', 'pms');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($data as $row) {
        $name = $row[0];
        $ic_number = $row[1];
        $matric_id = $row[2];
        $school = $row[3];
        $program = $row[4];
        $email = $row[5];
        $phone = $row[6];
        $level = 200;

        $stmt = $conn->prepare("INSERT INTO student (full_name, ic_number, matric_id, school, program, email, phone, level) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $name, $ic_number, $matric_id, $school, $program, $email, $phone, $level);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    // Displaying a popup notification and redirecting to sdm.html
    echo "<script>
        alert('Students successfully imported!');
        window.location.href = 'sdm.html';
    </script>";
} else {
    echo "No file uploaded.";
}
?>
