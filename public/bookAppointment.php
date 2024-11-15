<?php
// Start the session
include '../server/dbConnect.php'; // Ensure this path is correct
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Ensure category is numeric (if it's an ID)
if (is_numeric($category)) {
    try {
        // Prepare the SQL query to fetch the specialization based on SpecializationID
        $stmt = $pdo->prepare("SELECT * FROM Specializations WHERE SpecializationID = :category");
        // Bind the category parameter
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        // Execute the query
        $stmt->execute();
        // Fetch the result
        $specialization = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare(
            "SELECT *
            FROM doctors d 
            JOIN specializations s ON d.SpecializationID = s.SpecializationID 
            WHERE s.SpecializationID = :category"
        );
        
        // Bind the category parameter to the query
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the results
        $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);


         if ($doctors) {
            echo "<h2>Doctors specializing in " . htmlspecialchars($category) . ":</h2>";
            echo "<ul>";
            foreach ($doctors as $doctor) {
                echo "<li>";
                echo "Name: " . htmlspecialchars($doctor['FirstName']) . "<br>";
                echo "Email: " . htmlspecialchars($doctor['Email']) . "<br>";
                
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "No doctors found for this specialization.";
        }
        

    } catch (PDOException $e) {
        // Handle any database errors
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid category parameter.";
}
include './components/header.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="./css/style.css" />
    <title>Document</title>
  </head>
  <body>
   
  </body>
 </html>