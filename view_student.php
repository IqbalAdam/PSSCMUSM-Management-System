<?php
// This code is used to edit student data in edit_student.php page
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
    <link rel="stylesheet" href="styles.css">
    <title>View Student Details</title>
    <style>
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        .content {
            margin-top: 190px;
            margin-left: 300px;
            width: 75%;
            padding: 20px;
            background-color: #f8f8f8;
            border: 2px solid #ccc;
        }

        .edit-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .student-image img {
            width: 150px;
            height: 150px;
            border-radius: 5%;
            margin-top: 25px;
            margin-bottom: 5px;
            margin-left: 70px;
        
        }

        .student-details, .test-scores {
            display: flex;
            flex-wrap: wrap;
            margin-left: 40px;
            margin-top: -5px;
            width: 75%;
            justify-content: space-between;
        }

        .student-detail, .test-score {
            width: 48%;
            margin-bottom: 15px;
        }

        label {
            display: block;
            width: 190px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #003366;
        }

        input[type="text"], input[type="email"] {
            width: calc(100% - 10px);
            padding: 8px 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .test-scores {
            margin-top: 20px;
            margin-left: 280px;
            padding: 15px;
            background-color: #f4f4f4;
            border: 2px solid #ccc;
            border-radius: 10px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .test-score label {
            color: ##003366;
        }

        .test-score input {
            background-color: #fff;
        }

        .student-detail input[type="text"] {
        text-transform: uppercase;
        }
    </style>
</head>
<body class="edit-page">
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>
        <h1>PSSCMUSM Management System</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="sdm.html" class="active" >Student Data Management</a></li>
            <li><a href="test_class.html">Test Result</a></li>
            <li><a href="anr.html">Attendance & Records</a></li>
            <li><a href="visual.html">Data Visualization</a></li>
        </ul>
        <button class="logout-btn">Logout</button>
    </nav>

        <div class="content">
            <form method="POST" class="edit-form">
                <!-- Student Image -->
                <div class="student-image">
                    <img src="<?php echo $row['image']; ?>" alt="Student Image">
                </div>
                <!-- Student Details -->
                <div class="student-details">
                    <div class="student-detail">
                        <label for="full_name">Name:</label>
                        <input type="text" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>" readonly>
                    </div>
                    <div class="student-detail">
                        <label for="gender">Gender:</label>
                        <input type="text" id="gender" name="gender" value="<?php echo $row['gender']; ?>" readonly>
                    </div>
                    <div class="student-detail">
                        <label for="school">School:</label>
                        <input type="text" id="school" name="school" value="<?php echo $row['school']; ?>" readonly>
                    </div>
                    <div class="student-detail">
                        <label for="program">Program:</label>
                        <input type="text" id="program" name="program" value="<?php echo $row['program']; ?>" readonly>
                    </div>
                </div>

                <!-- Test Scores -->
                <div class="test-scores">
                    <div class="test-score">
                        <label for="u1_asas">Ujian Asas:</label>
                        <input value="<?php echo $row['u1_asas']; ?>" readonly>
                    </div>
                    <div class="test-score">
                        <label for="u2_jatuh">Ujian Jatuh:</label>
                        <input value="<?php echo $row['u2_jatuh']; ?>" readonly>
                    </div>
                    <div class="test-score">
                        <label for="u3_potong">Ujian Potong:</label>
                        <input value="<?php echo $row['u3_potong']; ?>" readonly>
                    </div>
                    <div class="test-score">
                        <label for="theory">Ujian Teori:</label>
                        <input value="<?php echo $row['theory']; ?>" readonly>
                    </div>
                    <div class="test-score">
                        <label for="ko_k">Penglibatan Ko-K:</label>
                        <input value="<?php echo $row['ko_k']; ?>" readonly>
                    </div>
                    <div class="test-score">
                        <label for="ko_k_2">Penglibatan Ko-K 2:</label>
                        <input value="<?php echo $row['ko_k_2']; ?>" readonly>
                    </div>
                    <div class="test-score">
                        <label for="ko_k_3">Penglibatan Ko-K 3:</label>
                        <input value="<?php echo $row['ko_k_3']; ?>" readonly>
                    </div>
                    <div class="test-score">
                        <label for="u_usr">Ujian Usr:</label>
                        <input value="<?php echo $row['u_usr']; ?>" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Add event listener to the logout button
        document.querySelector('.logout-btn').addEventListener('click', function() {
            // Redirect to login.html
            window.location.href = 'login.html';
        });
    </script>
</body>
</html>
