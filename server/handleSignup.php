<?php
// Include the database connection file
include 'dbConnect.php'; // Ensure this path is correct

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the connection is established
    global $pdo;

    if (!$pdo) {
        die("Database connection failed!");
    }

    // Retrieve and sanitize form inputs
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $password = htmlspecialchars($_POST['password']);
    $rePassword = htmlspecialchars($_POST['rePassword']);
    $street = htmlspecialchars($_POST['street']);
    $additional = htmlspecialchars($_POST['additional']);
    $zip = htmlspecialchars($_POST['zip']);
    $place = htmlspecialchars($_POST['place']);
    $country = htmlspecialchars($_POST['country']);
    $code = htmlspecialchars($_POST['code']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['your_email']);
    $terms_accepted = isset($_POST['checkbox']) ? "Yes" : "No";

    // Check if passwords match
    if ($password !== $rePassword) {
        die("Passwords do not match!");
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Create the SQL query
    try {
        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO users (first_name, last_name, password, street, additional_info, zip_code, place, country, country_code, phone_number, email, terms_accepted)
                VALUES (:first_name, :last_name, :password, :street, :additional_info, :zip_code, :place, :country, :country_code, :phone_number, :email, :terms_accepted)";
        
        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':additional_info', $additional);
        $stmt->bindParam(':zip_code', $zip);
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':country_code', $code);
        $stmt->bindParam(':phone_number', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':terms_accepted', $terms_accepted);

        // Execute the statement
        $stmt->execute();

        echo "Data inserted successfully.";
    } catch (PDOException $e) {
        // Output error if something goes wrong
        echo "Error: " . $e->getMessage();
    }
}
?>
