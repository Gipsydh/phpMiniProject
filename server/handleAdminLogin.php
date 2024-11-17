<?php
// Include the database connection file
include 'dbConnect.php'; // Ensure this path is correct

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Create the SQL query to fetch the user
    try {
        // Prepare the SQL statement with a placeholder
        $sql = "SELECT email, password FROM admin_users WHERE email = :email";
        
        // Prepare the statement
        $stmt = $pdo->prepare($sql);
        
        // Bind parameter
        $stmt->bindParam(':email', $email);
        
        // Execute the statement
        $stmt->execute();

        // Fetch the user record
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        echo $password;
     
        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['admin_email'] = $user['email'];
            
            // Redirect to a different page (e.g., admin dashboard)
            header("Location: ../public/dashboard.php");
            exit(); // Ensure no further code is executed
        } else {
            // Invalid email or password
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        // Output error if something goes wrong
        echo "Error: " . $e->getMessage();
    }
}
?>
