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

    // Get the JSON input from the fetch request
    $input = json_decode(file_get_contents('php://input'), true);

    // Extract data from input
    $doctorID = $input['doctorId'] ?? null;
    $patientName = $input['patient_name'] ?? null;
    $userEmail = $input['userEmail'] ?? null;
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
    $insertQuery = "INSERT INTO appointments (DoctorID, PatientName, email, AppointmentDate, AppointmentTime, Status, CreatedAt,UpdatedAt) 
                    VALUES (:doctorID, :patientName, :userEmail, :appointmentDate, :appointmentTime, 'Pending', NOW(),NOW())";

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

// Return the response as JSON
echo json_encode($response);
?>
