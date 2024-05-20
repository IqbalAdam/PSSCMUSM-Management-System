<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSSCMUSM Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body id="index">
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
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="anr.html">Attendance & Records</a></li>
                <li><a href="sdm.html">Student Data Management</a></li>
                <li><a href="visual.html">Data Visualization</a></li>
            </ul>
            <button class="logout-btn">Logout</button>
        </nav>
    </div>
    <div class="navigation-text">
        Home
    </div>
    <main>
        <a href="anr.html" class="box anr">
            <h2>Attendance <br>& Records</h2>
            <img src="images/module1.png" alt="Attendance & Records Icon">
            <p><br>Start class to record attendance & <br> view or update past attendance records</p>
        </a>
        <a href="sdm.html" class="box sdm">
            <h2>Student Data Management</h2>
            <img src="images/module2.png" alt="Student Data Management Icon">
            <p><br>Manage student data <br>including test results</p>
        </a>
        <a href="visual.html" class="box visual">
            <h2>Data Visualization</h2>
            <img src="images/module3.png" alt="Data Visualization Icon">
            <p><br>View data in graphical format</p>
        </a>
    </main>
    <script src="script.js" defer></script>
    <script>
        document.querySelector('.logout-btn').addEventListener('click', function() {
            window.location.href = 'logout.php';
        });
    </script>
</body>
</html>
