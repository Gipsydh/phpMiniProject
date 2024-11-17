<?php
include '../server/dbconnect.php';
include './components/header.php';

// Check if the search query is set in the URL
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];

    // Sanitize the input to prevent SQL injection
    $searchQuery = '%' . $searchQuery . '%';

    // Prepare SQL query to search for doctors by name
    $sql = "SELECT * FROM doctors WHERE FirstName LIKE :searchQuery OR LastName LIKE :searchQuery";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the search query parameter
    $stmt->bindValue(':searchQuery', $searchQuery);

    // Execute the statement
    if ($stmt->execute()) {
        // Fetch all matching results
        $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $doctors = [];
    }
} else {
    $doctors = [];
}
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
    <link rel="stylesheet" href="./css/search_results.css">
        <script src="./js/header.js" defer></script>
    </head>
    <body>
        <div class="container">
        <h2 style="margin-bottom:40px;">Search Results</h2>
        
        <?php if (count($doctors) > 0): ?>
            <div id="searchResults">
                <?php foreach ($doctors as $doctor): ?>
                    <div class="card">
                        <div class="left">
                            <h3>Dr. <?php echo htmlspecialchars($doctor['FirstName']) . ' ' . htmlspecialchars($doctor['LastName']); ?></h3>
                            <p>Email: <?php echo htmlspecialchars($doctor['Email']); ?></p>
                            <p>Specialization: <?php echo htmlspecialchars($doctor['Specialization']); ?></p>
                            <p>Contact: <?php echo htmlspecialchars($doctor['ContactNumber']); ?></p>
                            <p>Address: <?php echo htmlspecialchars($doctor['Address']); ?></p>
                        </div>
                        <div class="actions">
                <button class="accept" onclick="redirectToAppointment('<?php echo htmlspecialchars($doctor['DoctorID']); ?>')">Book an Appointment</button>
            </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No results found for your search query.</p>
        <?php endif; ?>

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
