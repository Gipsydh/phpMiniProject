<?php
// Start the session
include '../server/dbConnect.php'; // Ensure this path is correct
include './components/header.php';

// Database connection (assuming $pdo is your PDO instance)
$doctorID = $_GET['doctorID']; // Get the DoctorID from URL or form input (ensure it is sanitized)

// Prepare the SQL query
$stmt = $pdo->prepare("SELECT * FROM Doctors WHERE DoctorID = :doctorID");

// Bind the DoctorID parameter
$stmt->bindParam(':doctorID', $doctorID, PDO::PARAM_INT);

// Execute the query
$stmt->execute();

// Fetch the result
$doctor = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the doctor was found




?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
 <title>Document</title>
     <link rel="stylesheet" href="./css/style.css" />
     <link rel="stylesheet" href="./css/setAppointment.css">
    <script src="./js/header.js" defer></script>


</head>
<body>
<div class="container">
  <section class="doctorInfo">
  <div class="left">
 <div class="img"></div>
  </div>
  <div class="right">
   <?php 
   if ($doctor) {
    // Display the doctor's information
    echo "<h2>Dr. " . htmlspecialchars($doctor['FirstName']) . " " . htmlspecialchars($doctor['LastName']) . "</h2>";
    echo "<p class='category'>Specialization: " . htmlspecialchars($doctor['Specialization']) . "</p>";
    echo "<p>Email: " . htmlspecialchars($doctor['Email']) . "</p>";
    echo "<p>Contact: " . htmlspecialchars($doctor['ContactNumber']) . "</p>";
    echo "<p class='location'>Location: " . htmlspecialchars($doctor['Address']) . "</p>";
} else {
    echo "<p>Doctor not found.</p>";
}
   ?>
   

  </div>
  <section class="calenderInfo">

<?php
// Database connection (assuming $pdo is your PDO instance)
$slotDuration = 2; // in hours
$maxDays = 5;
$currentTime = new DateTime();
$currentTime->modify('+2 hours'); // No slots can be assigned for the next 2 hours
$currentTime->setTime((int)$currentTime->format('H'), 0);

// Initialize an array to store available slots
$appointmentSlots = [];

// Fetch all booked appointments from the database for the next 5 days
$startDate = (new DateTime())->format('Y-m-d H:i:s'); // Current date and time
$endDate = (new DateTime("+5 days"))->format('Y-m-d 23:59:59'); // 5 days from now

// Prepare the SQL query to get booked appointments for a specific doctor
$query = "SELECT AppointmentTime FROM appointments WHERE DoctorID=:doctorID AND AppointmentTime >= :startDate AND AppointmentTime <= :endDate";
$stmt = $pdo->prepare($query);

// Bind parameters
$stmt->bindParam(':doctorID', $doctorID, PDO::PARAM_INT);
$stmt->bindParam(':startDate', $startDate);
$stmt->bindParam(':endDate', $endDate);

// Execute the statement
$stmt->execute();

// Fetch the results (booked appointments)
$appointments = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Convert booked appointments to DateTime objects
$bookedTimes = array_map(fn($time) => new DateTime($time), $appointments);

// Generate slots for the next 5 days
for ($day = 0; $day < $maxDays; $day++) {
    $currentDate = (new DateTime())->modify("+$day day");
    $currentDateString = $currentDate->format('Y-m-d');
    $slots = [];

    // Start from 9 AM each day
    $startTime = new DateTime($currentDateString . ' 09:00');
    for ($i = 0; $i < 3; $i++) {
        $endTime = (clone $startTime)->modify("+{$slotDuration} hours");

        // Check if the slot is in the future and not within the next 2 hours
        if ($startTime >= $currentTime) {
            // Check if this slot is already booked
            $isBooked = false;
            foreach ($bookedTimes as $bookedTime) {
                if ($bookedTime >= $startTime && $bookedTime < $endTime) {
                    $isBooked = true;
                    break;
                }
            }

            // Add the slot if it is not booked
            if (!$isBooked) {
                $slots[] = $startTime->format('H:i') . " - " . $endTime->format('H:i');
            }
        }

        // Move to the next slot (2 hours later)
        $startTime->modify("+{$slotDuration} hours");
    }

    // Store the available slots for the current day
    if (!empty($slots)) {
        $appointmentSlots[$currentDateString] = $slots;
    }
}

// Display the available appointment slots
echo "<h2 style='margin:0px 0px 20px 0px;'>Available Appointment Slots</h2>";
foreach ($appointmentSlots as $date => $slots) {
    echo "<h3 style='margin:30px 0px 10px;'>" . date('l, F j', strtotime($date)) . "</h3>";
    foreach ($slots as $slot) {
        echo "<span style='cursor:pointer;color:#4a4a4a;font-weight:bold;display:inline-block;margin-right:10px;background-color:#e2e2e2; border-radius:5px; padding:10px;'>".$slot."</span>";
    }
}
?>



 </section>

 </section>
 
</div>
 <?php 
      include './components/footer.php'
    ?>
</body>

</html>