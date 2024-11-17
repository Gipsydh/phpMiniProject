<?php
include './dbconnect.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    echo json_encode(['error' => 'Unauthorized access. Please log in.']);
    header('Location: ../client/adminLogin.php');
    exit;
}

// Capture POST data
if (isset($_POST['SpecializationName'])) {
    // Collect form data
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $specializationID = $_POST['SpecializationID'];
    $specializationName = $_POST['SpecializationName'];
    $contactNumber = $_POST['ContactNumber'];
    $email = $_POST['Email'];
    $address = $_POST['Address'];

    // Prepare SQL query to insert data
    $sql = "INSERT INTO doctors 
            (FirstName, LastName, Specialization, ContactNumber, Email, Address, CreatedAt, UpdatedAt, SpecializationID) 
        VALUES 
            (:firstName, :lastName, :specializationName, :contactNumber, :email, :address, NOW(), NOW(), :specializationID)";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind values to the prepared statement
    $stmt->bindValue(':firstName', $firstName);
    $stmt->bindValue(':lastName', $lastName);
    $stmt->bindValue(':specializationName', $specializationName);  // Bind SpecializationName
    $stmt->bindValue(':contactNumber', $contactNumber);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':address', $address);
    $stmt->bindValue(':specializationID', $specializationID);

    // Execute the statement and check for success or error
    if ($stmt->execute()) {
        echo json_encode(['success' => 'Doctor added successfully!']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->errorInfo()[2]]);
    }
}
?>
