<?php
// search_doctor.php (Search for doctors by email only)
include './dbconnect.php';
session_start(); // Start the session
if (!isset($_SESSION['admin_email'])) {
    echo json_encode(['error' => 'Unauthorized access. Please log in.']);
    header('Location: ../client/adminLogin.php');

    exit;
}

if (isset($_GET['search'])) {
  $search = "%" . $_GET['search'] . "%";  // Wrapping search term for LIKE query

  // Search doctors by Email only
  $sql = "SELECT * FROM doctors WHERE Email LIKE :search";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":search", $search, PDO::PARAM_STR); // Only bind the email search term

  // Execute the statement
  $stmt->execute();

  // Fetch the results
  $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($doctors) {
    echo json_encode($doctors);
  } else {
    echo json_encode(['message' => 'No doctor found with that email']);
  }

  $stmt->closeCursor();
} else {
  echo json_encode(['message' => 'No search query provided']);
}

$pdo = null;  // Close the PDO connection
?>
