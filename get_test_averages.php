<?php
// This code is used to get the average test results in test_avg.html
include 'database.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch test averages if the request is made
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT AVG(test_1) AS avg_test_1, AVG(test_2) AS avg_test_2, AVG(theory) AS avg_theory FROM student";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }

    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSSCMUSM Management System</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body id="anr">
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
                <li><a href="sdm.html">Student Data Management</a></li>
                <li><a href="visual.html" class="active">Data Visualization</a></li>
            </ul>
            <button class="logout-btn">Logout</button>
        </nav>
    </div>

    <!--Navigation header inside body-->
    <div class="navigation-text">
        Data Visualization > Overall Data > Results Data
    </div>

    <!--Canvas for the bar chart-->
    <div class="chart-container">
        <canvas id="testAvgChart"></canvas>
    </div>

    <!--Referring to external JavaScript file-->
    <script>
        $(document).ready(function() {
            // Fetch the test averages from the PHP script
            $.ajax({
                url: 'overall_test.php',
                method: 'GET',
                success: function(data) {
                    const testAverages = JSON.parse(data);
                    const avgTest1 = parseFloat(testAverages.avg_test_1).toFixed(2);
                    const avgTest2 = parseFloat(testAverages.avg_test_2).toFixed(2);
                    const avgTheory = parseFloat(testAverages.avg_theory).toFixed(2);

                    // Create the bar chart using Chart.js
                    const ctx = document.getElementById('testAvgChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Test 1', 'Test 2', 'Theory Test'],
                            datasets: [{
                                label: 'Average Test Scores (%)',
                                data: [avgTest1, avgTest2, avgTheory],
                                backgroundColor: [
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Average Score (%)'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Tests'
                                    }
                                }
                            }
                        }
                    });
                }
            });
        });

        // Add event listener to the logout button
        document.querySelector('.logout-btn').addEventListener('click', function() {
            // Redirect to login.html
            window.location.href = 'login.html';
        });
    </script>
</body>
</html>
