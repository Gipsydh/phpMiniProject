<?php
// Database credentials
$dsn = "mysql:host=localhost;dbname=doctor_appointment"; // Data Source Name
$username = "root";   // Default username for XAMPP
$password = "";       // Default password for XAMPP (empty string)

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO($dsn, $username, $password);
    
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully";
} catch (PDOException $e) {
    // If connection fails, output error
    echo "Connection failed: " . $e->getMessage();
}
?>
