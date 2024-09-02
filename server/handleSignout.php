<?php
// Start the session
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Destroy the session to log the user out
    session_destroy();

    // Return a JSON response indicating success
    echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
} else {
    // If the request method is not POST, return an error
    http_response_code(405); // Method not allowed
    echo json_encode(['error' => 'Invalid request method']);
}
?>
