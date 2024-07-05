<?php
// This code is used to get the student list in individual.php (Individual Sub-module)
include 'database.php';

if (isset($_GET['matric_id'])) {
    $matric_id = $_GET['matric_id'];

    // Prepare the SQL statement to get student details
    $sql = $conn->prepare("SELECT id, image, full_name, matric_id, gender, ic_number, school, test_1, test_2, theory FROM student WHERE matric_id = ?");
    $sql->bind_param("s", $matric_id);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        // Fetch the result into an associative array
        $student = $result->fetch_assoc();
        $student_id = $student['id'];
    } else {
        echo "No student found with Matric ID: $matric_id";
        exit;
    }

    // Get the total number of classes conducted
    $sql = "SELECT COUNT(*) AS total_classes FROM class";
    $result = $conn->query($sql);
    $total_classes = $result->fetch_assoc()['total_classes'];

    // Get the number of classes attended by the student
    $sql = $conn->prepare("SELECT COUNT(*) AS attended_classes FROM attendance WHERE student_id = ?");
    $sql->bind_param("i", $student_id);
    $sql->execute();
    $result = $sql->get_result();
    $attended_classes = $result->fetch_assoc()['attended_classes'];

    // Calculate attendance percentage
    $attendance_percentage = ($total_classes > 0) ? ($attended_classes / $total_classes) * 100 : 0;

    // Function to calculate grade
    function calculate_grade($score) {
        if ($score >= 80) {
            return 'A';
        } elseif ($score >= 60) {
            return 'B';
        } elseif ($score >= 40) {
            return 'C';
        } else {
            return 'F';
        }
    }

    // Calculate grades for each test
    $grade_test_1 = calculate_grade($student['test_1']);
    $grade_test_2 = calculate_grade($student['test_2']);
    $grade_theory = calculate_grade($student['theory']);
    // Calculate average score and grade
    $average_score = number_format(($student['test_1'] + $student['test_2'] + $student['theory']) / 3, 1);
    $grade_average = calculate_grade($average_score);

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .graph-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
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
                <li><a href="sdm.html">Student Data Management</a></li>
                <li><a href="visual.html"class="active">Data Visualization</a></li>
            </ul>
            <button class="logout-btn">Logout</button>
        </nav>
    </div>

    <div class="navigation-text">
        Data Visualization > Individual Data > Student Data & Summary
    </div>

    <div class="view-stat">
        <div class="student-details">
            <div class="student-info">
                <img src="<?php echo $student['image']; ?>" alt="Student Image" class="student-image">
                <table class="info-table">
                    <tr>
                        <th>Name:</th>
                        <td><?php echo $student['full_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Matric ID:</th>
                        <td><?php echo $student['matric_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td><?php echo strtoupper($student['gender']); ?></td>
                    </tr>
                    <tr>
                        <th>IC No.:</th>
                        <td><?php echo $student['ic_number']; ?></td>
                    </tr>
                    <tr>
                        <th>School:</th>
                        <td><?php echo $student['school']; ?></td>
                    </tr>
                </table>
            </div>

            <div class="results-attendance">
                <table class="scores-table">
                    <tr>
                        <th>Test 1:</th>
                        <td><?php echo $student['test_1']; ?>%</td>
                        <td><?php echo $grade_test_1; ?></td>
                    </tr>
                    <tr>
                        <th>Test 2:</th>
                        <td><?php echo $student['test_2']; ?>%</td>
                        <td><?php echo $grade_test_2; ?></td>
                    </tr>
                    <tr>
                        <th>Theory:</th>
                        <td><?php echo $student['theory']; ?>%</td>
                        <td><?php echo $grade_theory; ?></td>
                    </tr>
                    <tr>
                        <th>Average:</th>
                        <td><?php echo $average_score; ?>%</td>
                        <td><?php echo $grade_average; ?></td>
                    </tr>
                </table>
                <table class="attendance-table">
                    <tr>
                        <th>Attendance:</th>
                        <td><?php echo $attended_classes . '/' . $total_classes; ?></td>
                    </tr>
                    <tr>
                        <th>Percentage:</th>
                        <td><?php echo number_format($attendance_percentage, 1); ?>%</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="graph-container">
        <canvas id="studentResultsChart"></canvas>
    </div>

    <div class="graph-container">
        <canvas id="studentAttendanceChart"></canvas>
    </div>

    <a href="individual.php" class="back-link">Back to Student List</a>

    <script>
        var ctx = document.getElementById('studentResultsChart').getContext('2d');
        var studentResultsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Test 1', 'Test 2', 'Theory', 'Average'],
                datasets: [{
                    label: 'Student Marks',
                    data: [<?php echo $student['test_1']; ?>, <?php echo $student['test_2']; ?>, <?php echo $student['theory']; ?>, <?php echo $average_score; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        var ctx2 = document.getElementById('studentAttendanceChart').getContext('2d');
        var studentAttendanceChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Present', 'Absent'],
                datasets: [{
                    label: 'Attendance Data',
                    data: [<?php echo $attended_classes; ?>, <?php echo $total_classes - $attended_classes; ?>],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: <?php echo $total_classes; ?>
                    }
                }
            }
        });

        // Add event listener to the logout button
        document.querySelector('.logout-btn').addEventListener('click', function() {
            // Redirect to login.html
            window.location.href = 'login.html';
        })
    </script>
</body>
</html>
