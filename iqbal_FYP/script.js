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

let dateFilterAscending = true;
let percentageFilterAscending = true;

function toggleDateFilter() {
    const rows = [...document.querySelectorAll("#recordTable tbody tr")];
    const sortedRows = rows.sort((a, b) => {
        const dateA = new Date(a.children[2].textContent.split('/').reverse().join('/'));
        const dateB = new Date(b.children[2].textContent.split('/').reverse().join('/'));
        if (dateFilterAscending) {
            return dateA - dateB;
        } else {
            return dateB - dateA;
        }
    });
    renderSortedRows(sortedRows);
    dateFilterAscending = !dateFilterAscending;
    rotateIcon(this);
}

function togglePercentageFilter() {
    const rows = [...document.querySelectorAll("#recordTable tbody tr")];
    const sortedRows = rows.sort((a, b) => {
        const percentageA = parseFloat(a.children[4].textContent);
        const percentageB = parseFloat(b.children[4].textContent);
        if (percentageFilterAscending) {
            return percentageA - percentageB;
        } else {
            return percentageB - percentageA;
        }
    });
    renderSortedRows(sortedRows);
    percentageFilterAscending = !percentageFilterAscending;
    rotateIcon(this);
}

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
    