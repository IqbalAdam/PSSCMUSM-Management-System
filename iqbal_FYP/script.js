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

$(document).ready(function() {
    // Function to sort table data based on column index and order
    function sortTable(table, column, order) {
        var tbody = table.find('tbody');
        var rows = tbody.find('tr').toArray();

        rows.sort(function(a, b) {
            var aValue = $(a).find('td').eq(column).text();
            var bValue = $(b).find('td').eq(column).text();

            if (column === 2 || column === 4) { // Column index 2 is Date, 4 is Percentage
                // Date format: yyyy-mm-dd
                aValue = new Date(aValue);
                bValue = new Date(bValue);
            } else if (column === 3) { // Column index 3 is Overall Attendance
                // Parse integers from "x/y" format
                aValue = parseInt(aValue.split('/')[0]);
                bValue = parseInt(bValue.split('/')[0]);
            }

            if (order === 'asc') {
                return aValue > bValue ? 1 : -1;
            } else {
                return aValue < bValue ? 1 : -1;
            }
        });

        tbody.empty().append(rows);
    }

    // Sort table by date in descending order on page load
    var table = $('.table-container');
    sortTable(table, 2, 'desc');
    $('#dateSortBtn img').toggleClass('upside-down', true);

    // Event listener for date sort button
    $('#dateSortBtn').click(function() {
        var table = $('.table-container');
        var order = $(this).hasClass('asc') ? 'desc' : 'asc';

        sortTable(table, 2, order);
        $(this).toggleClass('asc', order === 'asc');
        $(this).toggleClass('desc', order === 'desc');
        $(this).find('img').toggleClass('upside-down', order === 'desc');
    }).click();

    // Event listener for percentage sort button
    $('#sortBtn').click(function() {
        var table = $('.table-container');
        var order = $(this).hasClass('asc') ? 'desc' : 'asc';

        sortTable(table, 4, order);
        $(this).toggleClass('asc', order === 'asc');
        $(this).toggleClass('desc', order === 'desc');
    });

    // Function to toggle sort button icons
    function toggleSortIcon(button) {
        button.find('.sort-icon').toggleClass('fa-chevron-up fa-chevron-down');
    }

    // Event listener for sort buttons
    $('.sortBtn').click(function() {
        toggleSortIcon($(this));
    });
});

//Change date format in record.html
// Get all table rows
const rows = document.querySelectorAll('.table-container tbody tr');

// Iterate through each row
rows.forEach(row => {
    // Get the date cell
    const dateCell = row.querySelector('td:nth-child(3)');
    // Extract the date value
    const dateValue = dateCell.textContent.trim();
    // Split the date by '-' to get year, month, and day
    const [year, month, day] = dateValue.split('-');
    // Format the date as DD/MM/YYYY
    const formattedDate = `${day}/${month}/${year}`;
    // Update the cell with the new date format
    dateCell.textContent = formattedDate;
});

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