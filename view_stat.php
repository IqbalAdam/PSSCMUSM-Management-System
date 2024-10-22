<?php
include 'database.php';

if (isset($_GET['matric_id'])) {
    $matric_id = $_GET['matric_id'];

    // Prepare the SQL statement
    $sql = $conn->prepare("SELECT image, full_name, matric_id, gender, ic_number, school, test_1, test_2, theory FROM student WHERE matric_id = ?");
    $sql->bind_param("s", $matric_id);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        // Fetch the result into an associative array
        $student = $result->fetch_assoc();
    } else {
        echo "No student found with Matric ID: $matric_id";
        exit;
    }

    $conn->close();
} else {
    echo "No Matric ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Data</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>
        <h1>Student Details</h1>
    </header>
    <div class="container">
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="anr.html">Attendance & Records</a></li>
                <li><a href="sdm.html">Student Data Management</a></li>
                <li><a href="visual.html" class="active">Data Visualization</a></li>
            </ul>
            <button class="logout-btn">Logout</button>
        </nav>
    </div>

    <div class="student-details">
        <h2>Student Information</h2>
        <img src="<?php echo 'images/' . $student['image']; ?>" alt="Student Image">
        <p><strong>Name:</strong> <?php echo $student['full_name']; ?></p>
        <p><strong>Matric ID:</strong> <?php echo $student['matric_id']; ?></p>
        <p><strong>Gender:</strong> <?php echo $student['gender']; ?></p>
        <p><strong>IC No.:</strong> <?php echo $student['ic_number']; ?></p>
        <p><strong>School:</strong> <?php echo $student['school']; ?></p>
        <h3>Test Scores</h3>
        <p><strong>Test 1:</strong> <?php echo $student['test_1']; ?></p>
        <p><strong>Test 2:</strong> <?php echo $student['test_2']; ?></p>
        <p><strong>Theory:</strong> <?php echo $student['theory']; ?></p>
    </div>

    <a href="individual.php">Back to Student List</a>
</body>
</html>
