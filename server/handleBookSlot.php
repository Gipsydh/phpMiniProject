<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'dbConnect.php';

$response = ['success' => false, 'message' => ''];

try {
    $input = json_decode(file_get_contents('php://input'), true);

    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        $response['message'] = 'User not logged in.';
        echo json_encode($response);
        exit;
    }

    $currentTime = (new DateTime())->format('Y-m-d H:i:s');
    $userEmail = $_SESSION['email'];

    // Update last booking time
    $updateQuery = "UPDATE users SET last_booking_time = :currtime WHERE email = :email";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->bindParam(":currtime", $currentTime);
    $updateStmt->bindParam(":email", $userEmail);
    $updateStmt->execute();

    // Extract data from input
    $doctorID = $input['doctorId'] ?? null;
    $patientName = $input['patient_name'] ?? null;
    $appointmentDate = $input['AppointmentDate'] ?? null;
    $appointmentTime = $input['AppointmentTime'] ?? null;

    // Validate the input data
    if (!$doctorID || !$patientName || !$userEmail || !$appointmentDate || !$appointmentTime) {
        $response['message'] = 'Missing required appointment details.';
        echo json_encode($response);
        exit;
    }

    // Check if the slot is already booked
    $query = "SELECT COUNT(*) FROM appointments 
              WHERE DoctorID = :doctorID 
              AND AppointmentDate = :appointmentDate 
              AND AppointmentTime = :appointmentTime";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':doctorID', $doctorID, PDO::PARAM_INT);
    $stmt->bindParam(':appointmentDate', $appointmentDate);
    $stmt->bindParam(':appointmentTime', $appointmentTime);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $response['message'] = 'The selected time slot is already booked.';
        echo json_encode($response);
        exit;
    }

    // Insert the new appointment
    $insertQuery = "INSERT INTO appointments (DoctorID, PatientName, email, AppointmentDate, AppointmentTime, Status, CreatedAt, UpdatedAt) 
                    VALUES (:doctorID, :patientName, :userEmail, :appointmentDate, :appointmentTime, 'Pending', NOW(), NOW())";

    $insertStmt = $pdo->prepare($insertQuery);
    $insertStmt->bindParam(':doctorID', $doctorID, PDO::PARAM_INT);
    $insertStmt->bindParam(':patientName', $patientName);
    $insertStmt->bindParam(':userEmail', $userEmail);
    $insertStmt->bindParam(':appointmentDate', $appointmentDate);
    $insertStmt->bindParam(':appointmentTime', $appointmentTime);

    if ($insertStmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Appointment booked successfully.';
    } else {
        $response['message'] = 'Failed to book the appointment.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

echo json_encode($response);
?>
