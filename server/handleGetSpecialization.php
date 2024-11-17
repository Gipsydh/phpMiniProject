<?php
include './dbconnect.php';
header('Content-Type: application/json');
session_start(); // Start the session
if (!isset($_SESSION['admin_email'])) {
       header('Location: ../client/adminLogin.php');

    exit;
}
try {
    // Prepare the SQL statement
    $sql = "SELECT SpecializationID, SpecializationName FROM specializations";
    $stmt = $pdo->prepare($sql);

    // Execute the statement
    $stmt->execute();

    // Fetch all results as an associative array
    $specializations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the results as JSON
    echo json_encode($specializations);
} catch (PDOException $e) {
    // Handle any errors
    echo json_encode(['error' => $e->getMessage()]);
}
?>
