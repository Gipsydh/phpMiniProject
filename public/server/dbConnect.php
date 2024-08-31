<?php
// Database credentials
$dsn = "mysql:host=localhost;dbname=your_database"; // Data Source Name
$username = "root";   // Default username for XAMPP
$password = "";       // Default password for XAMPP (empty string)

try {
    $pdo = new PDO($dsn, $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
