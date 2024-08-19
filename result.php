<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSSCMUSM Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
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
            padding: 10px 10px;
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

    <div class="navigation-text">
        Student Data Management > Student Results
    </div>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search by Name or Matric ID or Scores">
        <button onclick="searchTable()">Search</button>
        <button class="clear-red-button" onclick="clearSearch()">Clear</button>
    </div>

    <div class="container">
        <table id="tableBody">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Matric ID</th>
                    <?php
                        include 'database.php';

                        $level = isset($_GET['level']) ? $_GET['level'] : '100';
                        $columns = [];

                        switch ($level) {
                            case '100':
                                $columns = ['u1_asas', 'u2_jatuh', 'u3_potong', 'theory', 'ko_k'];
                                $columnNames = ['Ujian Asas', 'Ujian Jatuh', 'Ujian Potong', 'Ujian Teori', 'Penglibatan Ko-K'];
                                break;
                            case '200':
                                $columns = ['u_usr', 'ko_k_2'];
                                $columnNames = ['USR', 'Penglibatan Ko-K'];
                                break;
                            case '300':
                                $columns = ['ko_k_3', 'u_demo'];
                                $columnNames = ['Penglibatan Ko-K', 'Ujian Demo'];
                                break;
                            case '0':
                                $columns = ['u1_asas', 'u2_jatuh', 'u3_potong', 'theory', 'ko_k', 'ko_k_2', 'ko_k_3','u_usr','u_demo'];
                                $columnNames = ['Ujian Asas', 'Ujian Jatuh', 'Ujian Potong', 'Ujian Teori', 'Penglibatan Ko-K 1' , 'Penglibatan Ko-K 2', 'Penglibatan Ko-K 3', 'USR', 'Ujian Demo'];
                                break;
                            default:
                                $columns = ['u1_asas', 'u2_jatuh', 'u3_potong', 'theory', 'ko_k'];
                                $columnNames = ['Ujian Asas', 'Ujian Jatuh', 'Ujian Potong', 'Ujian Teori', 'Penglibatan Ko-K'];
                                break;
                        }

                        foreach ($columnNames as $columnName) {
                            echo "<th>{$columnName}</th>";
                        }
                        
                        // Only display "Actions" column if level is not 0
                        if ($level != '0') {
                            echo "<th class='actions'>Actions</th>";
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT full_name, matric_id, " . implode(", ", $columns) . " FROM student WHERE level=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $level);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $counter++ . "</td>
                                    <td>" . $row["full_name"] . "</td>
                                    <td>" . $row["matric_id"] . "</td>";

                            foreach ($columns as $column) {
                                echo "<td>" . $row[$column] . "</td>";
                            }

                            // Only display "Actions" column if level is not 0
                            if ($level != '0') {
                                echo "<td class='actions'><a href='edit.php?matric_id=" . $row["matric_id"] . "'><img src='images/pencil.png' alt='Edit' class='table-img'></a></td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='" . (3 + count($columns)) . "'>No results found</td></tr>";
                    }

                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="script.js" defer></script>

    <script>
        function clearSearch() {
            document.getElementById("searchInput").value = "";
            searchTable(); 
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

        document.querySelector('.logout-btn').addEventListener('click', function() {
            window.location.href = 'login.html';
        });
    </script>
</body>
</html>
