<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSSCMUSM Management System</title>
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

    <!--Navigation header inside body-->
    <div class="navigation-text">
        Student Data Management > Student List<br><br>
        List of Student Currently Enrolled this Course
    </div>

    <!-- Search box -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search by Name or Matric ID">
        <button onclick="searchTable()">Search</button>
        <button class="clear-button" onclick="clearSearch()">Clear</button> 
        <button onclick="registerStudent()">Register Student</button>
    </div>

    <!-- Table box container -->
    <div class="table-box">
        <!-- Table container -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Matric ID</th>
                        <th>Gender</th>
                        <th>IC No.</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php include 'fetch_students.php'; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!--Referring to external JavaScript file-->
    <script src="script.js" defer></script>
</body>
</html>
