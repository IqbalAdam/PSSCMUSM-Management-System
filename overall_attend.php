<?php
// Establish connection to MySQL database
include 'database.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If POST request is made, process the data fetch
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve selected month and year from POST request
    $selectedMonth = $_POST['selectedMonth'];
    $selectedYear = $_POST['selectedYear'];

    // Get total number of students
    $studentQuery = "SELECT COUNT(*) as total_students FROM student";
    $studentResult = $conn->query($studentQuery);
    $studentRow = $studentResult->fetch_assoc();
    $totalStudents = $studentRow['total_students'];

    // Query to retrieve data for the selected month and year
    $sql = "SELECT c.class_date AS date, COUNT(a.student_id) AS present
            FROM class c
            LEFT JOIN attendance a ON c.class_id = a.class_id
            WHERE MONTH(c.class_date) = $selectedMonth AND YEAR(c.class_date) = $selectedYear 
            GROUP BY c.class_date";
    $result = $conn->query($sql);

    $data = array();
    // Fetch data and format it for JavaScript
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Calculate the number of absent students
            $absent = $totalStudents - $row['present'];
            $data[] = array(
                "date" => $row['date'],
                "present" => $row['present'],
                "absent" => $absent
            );
        }
    }

    // Return JSON response
    echo json_encode($data);
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visual</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <div class="container">
        <nav>
            <ul>
                <li><a href="index.html" class="active">Home</a></li>
                <li><a href="anr.html">Attendance & Records</a></li>
                <li><a href="sdm.html">Student Data Management</a></li>
                <li><a href="visual.html">Data Visualization</a></li>
            </ul>
            <button class="logout-btn">Logout</button>
        </nav>
    </div>
    
    <div class="navigation-text">
        Data Visualization > Overall Data > Attendance Data
    </div>

    <!-- Dropdown menus and button -->
    <div class="container dropdown-container">
        <label for="monthSelect">Choose Month:</label>
        <select id="monthSelect">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>

        <label for="yearSelect">Choose Year:</label>
        <select id="yearSelect">
            <!-- JavaScript will populate this with a range of years -->
        </select>

        <button id="displayDataBtn">View Data</button>
    </div>

    <!-- Graph container -->
    <div class="container attend-cont graph-container">
        <canvas id="attendanceChart" class="graph-canvas"></canvas>
    </div>

    <script>
        // Options for the attendance chart
        var attendanceOptions = {
            scales: {
                xAxes: [{
                    stacked: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Class Date',
                        fontSize: 16,
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return value;
                        }
                    }
                }],
                yAxes: [{
                    stacked: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Number of Students',
                        fontSize: 16,
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return value;
                        }
                    }
                }]
            },
            legend: {
                position: 'top',
                align: 'end'
            },
            title: {
                display: true,
                text: 'Graph of Student Attendance',
                fontSize: 20,
                padding: 20
            }
        };
    
        // Get the canvas element
        var ctx = document.getElementById('attendanceChart').getContext('2d');
    
        // Create the attendance chart with empty data
        var attendanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: []
            },
            options: attendanceOptions
        });

        // Populate year dropdown with a range of years
        const currentYear = new Date().getFullYear();
        const yearSelect = document.getElementById('yearSelect');
        for (let year = currentYear; year <= currentYear + 20; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
    
        // Add event listener to the button
        document.getElementById('displayDataBtn').addEventListener('click', function() {
            const selectedMonth = document.getElementById('monthSelect').value;
            const selectedYear = document.getElementById('yearSelect').value;
            // Update the chart data based on the selected month and year
            updateChartData(selectedMonth, selectedYear);
        });
    
        function updateChartData(month, year) {
            // Send AJAX request to fetch data from PHP script
            $.ajax({
                url: 'overall_attend.php',
                type: 'POST',
                data: { selectedMonth: month, selectedYear: year },
                dataType: 'json',
                success: function(data) {
                    // Update chart with fetched data
                    updateChartWithData(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        function updateChartWithData(data) {
            // Extracting dates and attendance from fetched data
            var dates = data.map(function(item) {
                return item.date;
            });
            var present = data.map(function(item) {
                return item.present;
            });
            var absent = data.map(function(item) {
                return item.absent;
            });

            // Update chart data
            attendanceChart.data.labels = dates;
            attendanceChart.data.datasets = [{
                label: 'Present',
                data: present,
                backgroundColor: 'green'
            }, {
                label: 'Absent',
                data: absent,
                backgroundColor: 'red'
            }];

            // Update chart options (optional)
            attendanceChart.options.title.text = 'Graph of Student Attendance';
            attendanceChart.update();
        }

        // Add event listener to the logout button
        document.querySelector('.logout-btn').addEventListener('click', function() {
            // Redirect to login.html
            window.location.href = 'login.html';
        });
    </script>
</body>
</html>
