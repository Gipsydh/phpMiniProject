<?php
include '../server/dbConnect.php'; 

if (isset($_GET['table'])) {
    $table = $_GET['table']; // Access the value of the 'table' parameter
} else {
    echo "No table parameter provided.";
}
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
    <div class="data">

      <?php echo "<h2>" . htmlspecialchars($table) . "</h2>"; ?>
  
      <?php echo "<h2> Search for " . htmlspecialchars($table) . " by Email </h2>"; ?>  
  
      <input type="text" id="searchQuery" placeholder="Enter doctor email" oninput="searchDoctors()">
      
      <div id="searchResults">Results will appear here...</div>
    </div>
    <div class="addDoctor">
      <span style="border:1px solid #007c9d"><a href="./addDoctor.php">Add Doctor</a></span>
    </div>
  </div>

  <?php include './components/footer.php'; ?>
</body>

<script>
   function deleteDoctor(email) {
        // Get the email value
        alert("Are you sure to want to delete this Doctor?")
        // Check if the email is not empty
        if (email) {
            // Create the data object to send
            var formData = new FormData();
            formData.append('email', email);

            // Perform fetch request
            fetch('../server/deleteDoctor.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                if (data.success) {
                    alert(data.success);
                    location.reload();
                } else {
                    alert(data.error);
                }
            })
            .catch(error => {
                alert('Error: ' + error);
            });
        } else {
            alert('Please enter a valid email address.');
        }
    }
  function searchDoctors() {
    const query = document.getElementById('searchQuery').value;

    if (query) {
      // Fetch search results from the PHP backend
      fetch(`../server/search_doctor.php?search=${query}`)
        .then(response => response.json())
        .then(data => {
          if (data.length > 0) {
            let resultsHTML = '';
            data.forEach(doctor => {
              resultsHTML += `
                <div class="cardBox">
                <div class="left">
                  <h3>Dr. ${doctor.FirstName} ${doctor.LastName}</h3>
                  <p>Email: ${doctor.Email}</p>
                  <p>Specialization: ${doctor.Specialization}</p>
                  <p>Contact: ${doctor.ContactNumber}</p>
                  <p>Availability: ${doctor.AvailabilityHours || 'Not specified'}</p>
                  <p>Address: ${doctor.Address || 'Not provided'}</p>
                  </div>
                  <div class="right"> <span onclick="deleteDoctor('${doctor.Email}')">Delete</span>
 </div>
                </div>
              `;
            });
            document.getElementById('searchResults').innerHTML = resultsHTML;
          } else {
            document.getElementById('searchResults').innerHTML = `<p>${data.message}</p>`;
          }
        })
        .catch(error => {
          document.getElementById('searchResults').innerHTML = `<p>Error: ${error.message}</p>`;
        });
    } else {
      document.getElementById('searchResults').innerHTML = '<p>Please enter an email to search.</p>';
    }
  }
</script>
</html>
