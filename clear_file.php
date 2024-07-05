<?php
// This code is used to clear content of latest_message.txt after user click Start Session button in attend.html
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Path to the file
    $filePath = 'C:\xampp\htdocs\iqbal_FYP\latest_message.txt';
    
    // Clear the content of the file
    file_put_contents($filePath, '');
    
    // Respond with a success message
    echo json_encode(['status' => 'success']);
}
?>
