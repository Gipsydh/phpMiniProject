<?php
// Database credentials
$dsn = "mysql:host=localhost;dbname=doctor_appointment"; // Data Source Name
$username = "root";   // Default username for XAMPP
$password = "";       // Default password for XAMPP (empty string)
date_default_timezone_set('Asia/Kolkata');

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO($dsn, $username, $password);
    
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // If connection fails, output error
    echo "Connection failed: " . $e->getMessage();
}
?>
