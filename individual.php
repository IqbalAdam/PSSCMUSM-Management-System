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
                <li><a href="sdm.html">Student Data Management</a></li>
                <li><a href="visual.html" class="active">Data Visualization</a></li>
            </ul>
            <button class="logout-btn">Logout</button>
        </nav>
    </div>

    <!--Navigation header inside body-->
    <div class="navigation-text">
        Data Visualization > Individual Data<br><br>
        Select a student to view their attendance record and test results
    </div>

    <!-- Search box -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search by Name or Matric ID or IC No.">
        <button onclick="searchTable()">Search</button>
        <button class="clear-button" onclick="clearSearch()">Clear</button> 
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
                    <?php
                        // Include the database connection file
                        include 'database.php';
    
                        // Create a query to fetch the required data
                        $sql = "SELECT full_name, matric_id, gender, ic_number FROM student";
                        $result = $conn->query($sql);
    
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            $counter = 1;
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $counter++ . "</td>
                                        <td>" . $row["full_name"] . "</td> 
                                        <td>" . $row["matric_id"] . "</td>
                                        <td>" . strtoupper($row["gender"]) . "</td>
                                        <td>" . $row["ic_number"] . "</td>
                                        <td class='actions'>
                                            <a href='view_stat.php?matric_id=" . $row["matric_id"] . "'><button class='view_statistic_btn'>View Data</button></a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No results found</td></tr>";
                        }
    
                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!--Referring to external JavaScript file-->
    <script src="script.js" defer></script>
    <script>
        function clearSearch() {
            document.getElementById("searchInput").value = ""; // Clear the search input value
            searchTable(); // Optionally, you can call the searchTable() function to reset the search results
        }

        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableBody");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                let found = false;
                for (var j = 0; j < td.length; j++) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        // Add event listener to the logout button
        document.querySelector('.logout-btn').addEventListener('click', function() {
            // Redirect to login.html
            window.location.href = 'login.html';
        });
    </script>
</body>
</html>
