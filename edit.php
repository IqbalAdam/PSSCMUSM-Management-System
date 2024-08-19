<?php
// This code is used to edit student test result in edit.php page
// Include the database connection file
include 'database.php';

$matric_id = $_GET['matric_id'];

// Fetch the student data based on matric_id
$sql = "SELECT full_name, matric_id, school, image, ic_number, u1_asas, u2_jatuh, u3_potong, theory, ko_k, ko_k_2, ko_k_3, u_usr, u_demo FROM student WHERE matric_id='$matric_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No results found";
    exit();
}

// Update the student data if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $test_1 = $_POST['u1_asas'];
    $test_2 = $_POST['u2_jatuh'];
    $test_3 = $_POST['u3_potong'];
    $theory = $_POST['theory'];
    $ko_k = $_POST['ko_k'];
    $ko_k_2 = $_POST['ko_k_2'];
    $ko_k_3 = $_POST['ko_k_3'];
    $u_usr = $_POST['u_usr'];
    $u_demo = $_POST['u_demo'];

    $update_sql = "UPDATE student SET u1_asas='$test_1', u2_jatuh='$test_2', u3_potong='$test_3', theory='$theory', ko_k='$ko_k', ko_k_2='$ko_k_2', ko_k_3='$ko_k_3', u_usr='$u_usr', u_demo='$u_demo' WHERE matric_id='$matric_id'";
    
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
    <style>
        /* Styles specific to edit.php */
        .edit-page .edit-form {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f9f9f9; 
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .edit-page .student-image {
        text-align: center;
        margin-bottom: -20px;
        }

        .edit-page .student-image img {
        max-width: 200px;
        max-height: 200px;
        margin-bottom: -60px;
        }

        .edit-page .student-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-left: -10px;
        margin-right: 10px;
        }

        .edit-page .student-details input {
        width: 100%;
        padding: 8px;    
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
        }

        .edit-page .test-scores {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        }

        .edit-page .test-score input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
        }

        .edit-page button[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #004080;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
        }

        .edit-page button[type="submit"]:hover {
        background-color: #002040;
        }

    </style>
</head>
<body class="edit-page">
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

    <!--Navigation header inside body-->
    <div class="navigation-text">
        Student Data Management > Student Results > Edit Result
    </div>

    <form method="POST" class="edit-form">
        <!-- Student Image -->
        <div class="student-image">
            <img src="<?php echo $row['image']; ?>" alt="Student Image">
        </div>
        <!-- Student Details -->
        <div class="student-details">
            <div class="student-detail">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>" readonly>
            </div>
            <div class="student-detail">
                <label for="matric_id">Matric ID:</label>
                <input type="text" id="matric_id" name="matric_id" value="<?php echo $row['matric_id']; ?>" readonly>
            </div>
            <div class="student-detail">
                <label for="ic_number">IC Number:</label>
                <input type="text" id="ic_number" name="ic_number" value="<?php echo $row['ic_number']; ?>" readonly>
            </div>
            <div class="student-detail">
                <label for="school">School:</label>
                <input type="text" id="school" name="school" value="<?php echo $row['school']; ?>" readonly>
            </div>
        </div>
        <!-- Test Scores -->
        <div class="test-scores">
            <div class="test-score">
                <label for="u1_asas"><br>Ujian Asas:</label>
                <input type="number" id="u1_asas" name="u1_asas" value="<?php echo $row['u1_asas']; ?>">
            </div>
            <div class="test-score">
                <label for="u2_jatuh"><br>Ujian Jatuh:</label>
                <input type="number" id="u2_jatuh" name="u2_jatuh" value="<?php echo $row['u2_jatuh']; ?>">
            </div>
            <div class="test-score">
                <label for="u3_potong"><br>Ujian Potong:</label>
                <input type="number" id="u3_potong" name="u3_potong" value="<?php echo $row['u3_potong']; ?>">
            </div>
            <div class="test-score">
                <label for="theory"><br>Ujian Teori:</label>
                <input type="number" id="theory" name="theory" value="<?php echo $row['theory']; ?>">
            </div>
            <div class="test-score">
                <label for="ko_k"><br>Penglibatan Ko-K 1:</label>
                <input type="number" id="ko_k" name="ko_k" value="<?php echo $row['ko_k']; ?>">
            </div>
            <div class="test-score">
                <label for="ko_k_2"><br>Penglibatan Ko-K 2:</label>
                <input type="number" id="ko_k_2" name="ko_k_2" value="<?php echo $row['ko_k_2']; ?>">
            </div>
            <div class="test-score">
                <label for="ko_k_3"><br>Penglibatan Ko-K 3:</label>
                <input type="number" id="ko_k_3" name="ko_k_3" value="<?php echo $row['ko_k_3']; ?>">
            </div>
            <div class="test-score">
                <label for="u_usr"><br>USR:</label>
                <input type="number" id="u_usr" name="u_usr" value="<?php echo $row['u_usr']; ?>">
            </div>
            <div class="test-score">
                <label for="u_demo"><br>Ujian Demo:</label>
                <input type="number" id="u_demo" name="u_demo" value="<?php echo $row['u_demo']; ?>">
            </div>
        </div>
        <button type="submit">Update</button>
        <button type="button" onclick="window.location.href='result.php'">Cancel</button> <!-- PENDING... -->
    </form>
    
    <script>
        // Add event listener to the logout button
        document.querySelector('.logout-btn').addEventListener('click', function() {
            // Redirect to login.html
            window.location.href = 'login.html';
        });
    </script>
</body>
</html>
