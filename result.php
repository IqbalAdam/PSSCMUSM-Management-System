<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSSCMUSM Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Custom CSS for the table */
        .container {
            margin-top: 20px;
            overflow-x: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-left: 370px;
            margin-right: 150px;
            margin-top: -40px;
            margin-bottom: 50px;
            border: 2px solid #000000; 
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #000000;
            border-right: 1px solid #000000; 
        }

        th:first-child,
        td:first-child {
            border-left: 1px solid #ddd; 
        }

        th {
            background-color: #004080;
            color: #ffffff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        td:nth-child(2) {
            text-align: left;
        }

        .table-img {
            width: 20px;
            height: 20px;
        }

        .actions {
            text-align: center;
        }

        /* Custom CSS for search box */
        .search-container {
            margin-top: -20px;
            margin-left: 261px;
        }

        input[type="text"] {
            padding: 10px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 2px;
        }

        button.clear {
            background-color: #000000;
        }

        .search-container button:last-child {
            margin-right: 0;
            background-color: #ec0202;
        }
    </style>
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
        Student Data Management > Student Results
    </div>

    <!-- Search box -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search by Name or Matric ID or Scores">
        <button onclick="searchTable()">Search</button>
        <button class="clear-red-button" onclick="clearSearch()">Clear</button>
    </div>

    <!-- Container for the result table -->
    <div class="container">
        <table id="tableBody">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Matric ID</th>
                    <th>Test 1</th>
                    <th>Test 2</th>
                    <th>Theory Test</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Include the database connection file
                    include 'database.php';

                    // Create a query to fetch the required data
                    $sql = "SELECT full_name, matric_id, test_1, test_2, theory FROM student";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        $counter = 1;
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $counter++ . "</td>
                                    <td>" . $row["full_name"] . "</td>
                                    <td>" . $row["matric_id"] . "</td>
                                    <td>" . $row["test_1"] . "</td>
                                    <td>" . $row["test_2"] . "</td>
                                    <td>" . $row["theory"] . "</td>
                                    <td class='actions'><a href='edit.php?matric_id=" . $row["matric_id"] . "'><img src='images/pencil.png' alt='Edit' class='table-img'></a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No results found</td></tr>";
                    }

                    $conn->close();
                ?>
            </tbody>
        </table>
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
