<?php
include './dbconnect.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    echo json_encode(['error' => 'Unauthorized access. Please log in.']);
    header('Location: ../client/adminLogin.php');
    exit;
}

// Capture POST data (email of the doctor to be deleted)
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Prepare SQL query to delete the doctor by email
    $sql = "DELETE FROM doctors WHERE Email = :email";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the email parameter to the prepared statement
    $stmt->bindValue(':email', $email);

    // Execute the statement and check for success or error
    if ($stmt->execute()) {
        echo json_encode(['success' => 'Doctor deleted successfully!']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->errorInfo()[2]]);
    }
}
?>
