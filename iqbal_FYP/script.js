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