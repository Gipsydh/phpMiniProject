<?php
include '../server/dbConnect.php'; 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/admin.css">
</head>
<body>
  <div class="container">
    <h2>Admin Panel</h2>
  <div class="options">
    <div class="option" onclick="redirectToUsersPage()">
      <h3>Handle users</h3>
    </div>
    <div class="option" onclick="redirectToDoctorsPage()">
      <h3>Handle doctors</h3>
    </div>
  </div>
  <div class="logout" >
    <span><a href="../server/handleAdminLogout.php">Log out</a></span>
  </div>
  </div>
<?php 
  include './components/footer.php'
?>
</body>
<script>
  function redirectToDoctorsPage() {
    // Redirect to doctor.php with query parameter table=doctors
    window.location.href = "./getList.php?table=doctors";
  }
  function redirectToUsersPage() {
    // Redirect to doctor.php with query parameter table=doctors
    window.location.href = "./getList.php?table=users";
  }
</script>
</html>