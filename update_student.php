<?php
include 'database.php';

if (isset($_GET['matric_id'])) {
    $matric_id = $_GET['matric_id'];

    // Fetch student data based on the matric_id
    $sql = "SELECT * FROM student WHERE matric_id='$matric_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No student found with the given Matric ID.";
        exit();
    }
} else {
    echo "Matric ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!--Header with title and PSSCMUSM logo-->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>
        <h1>PSSCMUSM Management System</h1>
    </header>
    <div class="container">
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="anr.html">Attendance & Records</a></li>
                <li><a href="sdm.html" class="active">Student Data Management</a></li>
                <li><a href="visual.html">Data Visualization</a></li>
            </ul>
            <button class="logout-btn">Logout</button>
        </nav>
    </div>

    <!-- Navigation text -->
    <div class="navigation-text">
        Student Data Management > Edit Student Details
    </div>

    <div class="student-details-container">
        <form id="studentForm" action="update_student.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="matric_id" value="<?php echo $row['matric_id']; ?>">
            <div class="form-group">
                <label for="fullName">Full Name as in IC</label>
                <input type="text" id="fullName" name="fullName" value="<?php echo $row['full_name']; ?>" oninput="this.value = this.value.toUpperCase()" required>
            </div>
            <div class="form-group inline">
                <label for="matricID">Matric ID</label>
                <input type="text" id="matricID" name="matricID" value="<?php echo $row['matric_id']; ?>" maxlength="10" required readonly>
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="male" <?php echo ($row['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo ($row['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="icNumber">IC Number:</label>
                <input type="text" id="icNumber" name="icNumber" value="<?php echo $row['ic_number']; ?>" placeholder="Enter IC Number" maxlength="12">
            </div>
            
            <div class="form-group">
                <label for="school">School</label>
                <input type="text" id="school" name="school" value="<?php echo $row['school']; ?>" oninput="this.value = this.value.toUpperCase()" required>
            </div>
            <div class="form-group">
                <label for="image">Image (.png format)</label>
                <input type="file" id="image" name="image" accept=".png">
            </div>
            <button type="submit" class="submit-btn">Update</button>
        </form>
    </div>

    <!--Referring to external JavaScript file-->
    <script src="script.js" defer></script>
</body>
</html>
