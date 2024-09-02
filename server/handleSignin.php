<?php
// Include the database connection file
include 'dbConnect.php'; // Ensure this path is correct

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the connection is established
    global $pdo;

    if (!$pdo) {
        die("Database connection failed!");
    }

    // Retrieve and sanitize form inputs
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Create the SQL query to fetch the user
    try {
        // Prepare the SQL statement with a placeholder
        $sql = "SELECT first_name, last_name, password FROM users WHERE email = :email";
        
        // Prepare the statement
        $stmt = $pdo->prepare($sql);
        
        // Bind parameter
        $stmt->bindParam(':email', $email);
        
        // Execute the statement
        $stmt->execute();

        // Fetch the user record
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $email;
            
            // Redirect to a different page (e.g., dashboard or home page)
            header("Location: ../public/index.php");
            exit(); // Ensure no further code is executed
        } else {
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        // Output error if something goes wrong
        echo "Error: " . $e->getMessage();
    }
}
?>
