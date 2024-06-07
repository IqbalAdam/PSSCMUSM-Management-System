//---------------------------------------------------------------------------------------------------------------------------
//                                                 Script in attend2.html
//---------------------------------------------------------------------------------------------------------------------------

document.addEventListener("DOMContentLoaded", function() {
    // Select the end session button
    const endSessionBtn = document.querySelector('.end-session-btn');

    // Add click event listener to the end session button
    endSessionBtn.addEventListener('click', function() {
        // Show confirmation dialog
        const confirmation = confirm("End Session will stop taking attendance for today's class. \nAre you sure want to stop taking attendance?");
    
        // If user clicks OK (true), redirect to anr.html
        if (confirmation) {
            window.location.href = "anr.html";
        }
    });
});

//---------------------------------------------------------------------------------------------------------------------------
//                                                 Script in record.html
//---------------------------------------------------------------------------------------------------------------------------

function renderSortedRows(sortedRows) {
    const tableBody = document.getElementById("recordTableBody");
    tableBody.innerHTML = "";
    sortedRows.forEach(row => {
        tableBody.appendChild(row);
    });
}

function rotateIcon(button) {
    button.classList.toggle("rotate180");
}

// Add event listeners to filter buttons
document.getElementById("dateFilterBtn").addEventListener("click", toggleDateFilter);
document.getElementById("percentageFilterBtn").addEventListener("click", togglePercentageFilter);

//---------------------------------------------------------------------------------------------------------------------------
//                                                 Script in manage.html
//---------------------------------------------------------------------------------------------------------------------------

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
        for (var j = 0; j < td.length; j++) {
            txtValue = td[j].textContent || td[j].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                break;
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function registerStudent() {
    // Redirect to manage2.html
    window.location.href = "manage2.html";
}

document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        const deleteId = this.getAttribute('data-id');
        if (confirm("Are you sure you want to delete this student?")) {
            // Send AJAX request to delete_student.php
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Update table or show a message
                        // For simplicity, you can reload the page
                        location.reload();
                    } else {
                        console.error('Error:', xhr.statusText);
                    }
                }
            };
            xhr.open('POST', 'delete_student.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('delete_id=' + deleteId);
        }
    });
});

//---------------------------------------------------------------------------------------------------------------------------
//                                                 Script in manage2.html
//---------------------------------------------------------------------------------------------------------------------------

// Function to preview image before uploading
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
    var imagePreview = document.getElementById('imagePreview');
    imagePreview.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
    }

// Attach event listener to image input
    document.getElementById('image').addEventListener('change', previewImage);

    document.addEventListener("DOMContentLoaded", function() {
        // Get the form and submit button
        const form = document.getElementById("studentForm");
        const submitBtn = document.getElementById("submitBtn");

    // Add event listener to the form submit button
    document.getElementById("myForm").addEventListener("submit", function(event) {
        // Prevent the default form submission
        event.preventDefault();
        });
    });
    
//---------------------------------------------------------------------------------------------------------------------------
//                                                 Script in visual.html
//---------------------------------------------------------------------------------------------------------------------------

    document.addEventListener("DOMContentLoaded", function() {
        const yearSelect = document.getElementById('year-select');
        const currentYear = new Date().getFullYear();
        const startYear = 2000; // Adjust as needed
    
        for (let year = startYear; year <= currentYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
    
        document.getElementById('display-data-btn').addEventListener('click', function() {
            const month = document.getElementById('month-select').value;
            const year = document.getElementById('year-select').value;
            // Implement the logic to display data based on the selected month and year
            console.log(`Displaying data for ${month} ${year}`);
        });
    });
    
//---------------------------------------------------------------------------------------------------------------------------
//                                                 Script in view_stat.php
//---------------------------------------------------------------------------------------------------------------------------

    document.addEventListener("DOMContentLoaded", function () {
        const statusCells = document.querySelectorAll(".status-cell");
    
        statusCells.forEach(cell => {
            cell.addEventListener("click", function () {
                const dropdown = cell.nextElementSibling;
                dropdown.style.display = "inline";
                cell.style.display = "none";
                dropdown.value = cell.textContent;
    
                dropdown.addEventListener("change", function () {
                    const selectedStatus = dropdown.value;
                    const matricId = dropdown.getAttribute("data-matric-id");
    
                    // Update status in the database using AJAX
                    updateStatus(matricId, selectedStatus).then(() => {
                        cell.textContent = selectedStatus;
                        cell.style.display = "inline";
                        dropdown.style.display = "none";
                    });
                });
            });
        });
    });
    
    function updateStatus(matricId, status) {
        return fetch('update_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `matric_id=${matricId}&status=${status}`
        });
    }

    // Add event listener to the logout button
    document.querySelector('.logout-btn').addEventListener('click', function() {
        // Redirect to login.html
        window.location.href = 'login.php';
    });




    


    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const class_id = urlParams.get('class_id');
    
        fetch(`view_record.php?class_id=${class_id}`)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the data to the console
                const tbody = document.getElementById('attendanceTableBody');
                tbody.innerHTML = '';
    
                let index = 1;
    
                data.present.forEach(student => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${index}</td>
                        <td>${student.full_name}</td>
                        <td>${student.matric_ID}</td>
                        <td>${student.gender.toUpperCase()}</td>
                        <td class="status" data-student-id="${student.id}" data-status="PRESENT">
                            <span class="status-text">PRESENT</span>
                            <select class="status-dropdown">
                                <option value="PRESENT">Mark as PRESENT</option>
                                <option value="ABSENT">Mark as ABSENT</option>
                            </select>
                        </td>
                    `;
                    tbody.appendChild(row);
                    index++;
                });
    
                data.absent.forEach(student => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${index}</td>
                        <td>${student.full_name}</td>
                        <td>${student.matric_ID}</td>
                        <td>${student.gender.toUpperCase()}</td>
                        <td class="status" data-student-id="${student.id}" data-status="ABSENT">
                            <span class="status-text">ABSENT</span>
                            <select class="status-dropdown">
                                <option value="PRESENT">Mark as PRESENT</option>
                                <option value="ABSENT">Mark as ABSENT</option>
                            </select>
                        </td>
                    `;
                    tbody.appendChild(row);
                    index++;
                });
    
                // Add event listener to handle status change
                document.querySelectorAll('.status-dropdown').forEach(dropdown => {
                    dropdown.addEventListener('change', function() {
                        const cell = this.closest('.status');
                        const studentId = cell.dataset.studentId;
                        const newStatus = this.value;
                        updateStatus(class_id, studentId, newStatus, cell);
                    });
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });
    
    function updateStatus(classId, studentId, status, cell) {
        fetch('update_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ class_id: classId, student_id: studentId, status: status }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                cell.querySelector('.status-text').textContent = status;
                cell.dataset.status = status;
                if (status === 'PRESENT') {
                    cell.classList.remove('status-absent');
                    cell.classList.add('status-present');
                } else {
                    cell.classList.remove('status-present');
                    cell.classList.add('status-absent');
                }
            } else {
                alert('Error updating status: ' + data.message);
            }
        })
        .catch(error => console.error('Error updating status:', error));
    }
    