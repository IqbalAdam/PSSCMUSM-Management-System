<?php
// Include the database connection file
include 'database.php';

$matric_id = $_GET['matric_id'];

// Fetch the student data based on matric_id
$sql = "SELECT full_name, matric_id, test_1, test_2, theory FROM student WHERE matric_id='$matric_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No results found";
    exit();
}

// Update the student data if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $test_1 = $_POST['test_1'];
    $test_2 = $_POST['test_2'];
    $theory = $_POST['theory'];

    $update_sql = "UPDATE student SET test_1='$test_1', test_2='$test_2', theory='$theory' WHERE matric_id='$matric_id'";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Redirect to the result page after updating
    header("Location: result.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Results</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--Referring to external JavaScript file-->
    <script src="script.js" defer></script>
</head>
<body>
    <!--Header with title and PSSCMUSM logo-->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>
        <h1>PSSCMUSM Management System</h1>
    </header>
    

    <h1><br><br><br><br><br><br><br>Edit Student Results</h1>
    <form method="POST">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>" readonly><br><br>
        
        <label for="matric_id">Matric ID:</label>
        <input type="text" id="matric_id" name="matric_id" value="<?php echo $row['matric_id']; ?>" readonly><br><br>

        <label for="test_1">Test 1:</label>
        <input type="number" id="test_1" name="test_1" value="<?php echo $row['test_1']; ?>"><br><br>
        
        <label for="test_2">Test 2:</label>
        <input type="number" id="test_2" name="test_2" value="<?php echo $row['test_2']; ?>"><br><br>

        <label for="theory">Theory Test:</label>
        <input type="number" id="theory" name="theory" value="<?php echo $row['theory']; ?>"><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
