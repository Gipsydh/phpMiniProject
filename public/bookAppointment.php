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
    <link rel="stylesheet" href="./css/bookAppointment.css" />
    <link rel="stylesheet" href="./css/style.css" />
        <script src="./js/header.js" defer></script>

    <title>Document</title>
  </head>
  <body>
  <div class="container">
    <h2 style='margin-bottom:20px'><?php echo htmlspecialchars($specialization['SpecializationName']); ?></h2>
    <section style='margin-bottom:30px'>
         <?php if (!empty($doctors)): ?>
    <?php foreach ($doctors as $doctor): ?>
        <div class="card" >
            <h2 class="title"><?php echo "Dr. " . htmlspecialchars($doctor['FirstName']) . " " . htmlspecialchars($doctor['LastName']); ?>
</h2>
            <p class="description">
                <?php echo "Address: " . htmlspecialchars($doctor['Address']);  ?>

            </p>
            <div class="actions">
                <button class="accept" onclick="redirectToAppointment('<?php echo htmlspecialchars($doctor['DoctorID']); ?>')">Book an Appointment</button>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No doctors found for this specialization.</p>
<?php endif; ?>

    </section>
  </div>
   <?php 
      include './components/footer.php'
    ?>
  </body>
  <script>
    function redirectToAppointment(category) {
        window.location.href =
          '/miniproject/public/setAppointment.php?doctorID=' + encodeURIComponent(category)
      }
  </script>
 </html>