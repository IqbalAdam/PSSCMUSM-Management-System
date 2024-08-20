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
        $level = 300;

        // Set gender based on the name
        $gender = 'male';
        if (stripos($name, 'Binti') !== false || stripos($name, 'Nur') !== false || stripos($name, 'Siti') !== false || stripos($name, 'Nurul') !== false) {
            $gender = 'female';
        } elseif (stripos($name, 'Muhammad') !== false || stripos($name, 'Ahmad') !== false) {
            $gender = 'male';
        }

        $stmt = $conn->prepare("INSERT INTO student (full_name, ic_number, matric_id, school, program, email, phone, level, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $ic_number, $matric_id, $school, $program, $email, $phone, $level, $gender);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    // Displaying a popup notification and redirecting to sdm.html
    echo "<script>
        alert('Students successfully imported! Please check gender as the system assigned them automatically.');
        window.location.href = 'sdm.html';
    </script>";
} else {
    echo "No file uploaded.";
}
?>
