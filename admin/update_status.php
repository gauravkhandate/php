<?php
include 'config.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required parameters are present
    if (isset($_POST['status']) && isset($_POST['pdf_id'])) {
        // Sanitize input to prevent SQL injection
        $status = mysqli_real_escape_string($connection, $_POST['status']);
        $pdfId = mysqli_real_escape_string($connection, $_POST['pdf_id']);

        // Update the status in the database
        $updateQuery = "UPDATE payment_screenshots SET status = '$status' WHERE user_id = '$pdfId'";
        if (mysqli_query($connection, $updateQuery)) {
            // Status updated successfully
            http_response_code(200); // OK status
            echo "Status updated successfully";
        } else {
            // Error updating status
            http_response_code(500); // Internal Server Error status
            echo "Error updating status: " . mysqli_error($connection);
        }
    } else {
        // Required parameters are missing
        http_response_code(400); // Bad Request status
        echo "Missing parameters";
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed status
    echo "Invalid request method";
}

// Close database connection
mysqli_close($connection);
?>
