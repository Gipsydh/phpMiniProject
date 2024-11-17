<?php
header('Content-Type: application/json');
session_start();
include 'dbConnect.php'; // Ensure this path is correct

$response = ['success' => false, 'message' => ''];
try {
    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        $response['message'] = 'User not logged in.';
        echo json_encode($response);
        exit;
    }
    $input = json_decode(file_get_contents('php://input'), true);

    $currentTime = date('Y-m-d H:i:s');

    // Fetch the user's last booking time
    $query = "SELECT last_booking_time FROM users WHERE email = :i";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":i", $_SESSION['email']);
    $stmt->execute();
    $lastBookingTime=$stmt->fetchColumn();

    // Check if the user has a cooldown period
    if ($lastBookingTime) {
        $lastBookingTimestamp = strtotime($lastBookingTime);
        $currentTimestamp = strtotime($currentTime);
        $timeDifference = ($currentTimestamp - $lastBookingTimestamp) / (60 * 60); // Convert to hours

        if ($timeDifference < 24) {
            $remainingHours = ceil(24 - $timeDifference);
             $response['message'] = "You need to wait $remainingHours hours before booking another slot.";
            echo json_encode($response);
            exit;
        }
    }

    // Proceed with booking and update the last booking time
    



} catch (PDOException $e) {
    $response['message'] = 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

// Return the response as JSON
$response['success'] = true;

echo json_encode($response);
?>




