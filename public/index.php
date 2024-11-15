<?php
// Start the session
include '../server/dbConnect.php'; // Ensure this path is correct
try {
 // Fetch specializations from the database
    $stmt = $pdo->prepare("SELECT * FROM Specializations"); $stmt->execute();
$specializations = $stmt->fetchAll(PDO::FETCH_ASSOC); } catch (PDOException $e)
{ echo "Connection failed: " . $e->getMessage(); } include
'./components/header.php'; ?>

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
    <div class="container">
      <section class="banner">
        <div class="data">
          <h1>The apollo world of care</h1>
          <span
            >Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias
            ipsam illo eum numquam iure animi delectus nisi libero ut sapiente,
            iste quidem voluptatibus magni! Ea molestias dolore dolorem? Neque,
            optio.
          </span>
          <div class="button">
            <span>Book an appointment</span>
          </div>
        </div>
      </section>
      <section class="specialist">
        <div class="heading">
          <h2>Explore our Centres of Clinical Excellence</h2>
        </div>
        <div class="info">
          <div class="left">
            <img
              src="https://cdn.apollohospitals.com/apollohospitals/apollo-prohealth/ah/explore.jpg"
              alt=""
            />
          </div>
          <div class="right">
            <div class="categories">
              <?php foreach ($specializations as $specialization): ?>
              <div class="category" onclick="redirectToCategory('<?php echo htmlspecialchars($specialization['SpecializationID']); ?>')">
                <div
                  class="logo"
                  
                >
                  <img
                    src="<?php echo htmlspecialchars($specialization['imgLink']); ?>"
                    alt="<?php echo htmlspecialchars($specialization['SpecializationName']); ?>"
                  />
                </div>
                <span style="margin-top: 10px">
                  <?php echo htmlspecialchars($specialization['SpecializationName']); ?>
                </span>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </section>
    </div>
    <footer>
      <span>FOOTER</span>
    </footer>
    <script>
      function redirectToSignup() {
        window.location.href = 'signup.php' // Redirect to signup page
      }
      function handleAdminLogin() {
        window.location.href = 'adminLogin.php' // Redirect to signup page
      }
      function redirectToLogin() {
        window.location.href = 'signin.php' // Redirect to login page
      }
      function redirectToCategory(category) {
        // Redirect to the booking appointment page with the category as a URL parameter
        window.location.href =
          '/miniproject/public/bookAppointment.php?category=' + encodeURIComponent(category)
      }
    </script>
    <script>
      function handleLogout() {
        fetch('../server/handleSignout.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          credentials: 'include', // Include credentials such as cookies in the request
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error('Network response was not ok')
            }
            return response.json()
          })
          .then((data) => {
            console.log('Logout successful:', data)
            // Redirect after successful logout
            window.location.href = 'index.php'
          })
          .catch((error) => {
            console.error('Error:', error)
          })
      }
    </script>
  </body>
</html>
