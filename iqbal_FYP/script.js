// JavaScript code for navigation
document.addEventListener('DOMContentLoaded', function() {
    const attendanceBtn = document.querySelector('.tile[href="attendance.html"]');
    attendanceBtn.addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = "attendance.html";
    });
});
