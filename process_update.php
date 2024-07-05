<?php
// This code is used to update student details in edit_studnet.php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric_id = $_POST['matric_id'];
    $full_name = $_POST['fullName'];
    $gender = $_POST['gender'];
    $ic_number = $_POST['icNumber'];
    $school = $_POST['school'];

    // Handle file upload
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "UPDATE student SET full_name='$full_name', gender='$gender', ic_number='$ic_number', school='$school', image='$image' WHERE matric_id='$matric_id'";
    } else {
        $sql = "UPDATE student SET full_name='$full_name', gender='$gender', ic_number='$ic_number', school='$school' WHERE matric_id='$matric_id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: manage.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
