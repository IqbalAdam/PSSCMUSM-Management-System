<?php
    $file = 'latest_message.txt';
    if (file_exists($file)) {
        // Open the file for writing and truncate it to zero length
        $handle = fopen($file, 'w');
        if ($handle) {
            fclose($handle);
        } else {
            echo "Error: Could not open file for writing.";
        }
    } else {
        echo "Error: File does not exist.";
    }
?>
