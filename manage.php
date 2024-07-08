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
            border: 2px solid #000000; /* Add border to the table */
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #000000;
            border-right: 1px solid #000000; /* Add right border to cells */
        }

        th:first-child,
        td:first-child {
            border-left: 1px solid #ddd; /* Add left border to first cell in each row */
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
            white-space: nowrap; /* Prevent buttons from stacking */
        }

        .action-button {
            padding: 5px 10px; /* Smaller padding for smaller buttons */
            margin: 2px;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px; /* Smaller font size */
        }

        .edit-button {
            background-color: #4CAF50; /* Green */
        }

        .delete-button {
            background-color: #f44336; /* Red */
        }

        /* Custom CSS for search box */
        .search-container {
            margin-top: -40px;
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
        Student Data Management > Student List<br><br>
        Current student enrolled in The Art of Silat Cekak Course
    </div>

    <!-- Search box -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search by Name or Matric ID">
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
                    <th>Gender</th>
                    <th>IC Number</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // This part is using database.php + edit_student.php + delete_student.php
                    // Include the database connection file
                    include 'database.php';

                    // Get the category from the URL
                    $category = isset($_GET['category']) ? $_GET['category'] : 'overall';

                    // Create a query to fetch the required data
                    if ($category == 'overall') {
                        $sql = "SELECT full_name, matric_id, gender, ic_number FROM student";
                    } else {
                        $level = intval($category);
                        $sql = "SELECT full_name, matric_id, gender, ic_number FROM student WHERE level = $level";
                    }

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
                                        <a href='edit_student.php?matric_id=" . $row["matric_id"] . "'><button class='action-button edit-button'>Edit</button></a>
                                        <button class='action-button delete-button' onclick='deleteStudent(\"" . $row["matric_id"] . "\")'>Delete</button>
                                    </td>
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

        function deleteStudent(matric_id) {
            if (confirm("Are you sure you want to delete this student?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_student.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if (xhr.responseText === "success") {
                            location.reload(); // Reload the page to see the changes
                        } else {
                            alert("Error deleting student.");
                        }
                    }
                };

                xhr.send("matric_id=" + matric_id);
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
