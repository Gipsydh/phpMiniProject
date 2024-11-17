<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Doctor</title>
<link rel="stylesheet" href="./css/addDoctor.css">
</head>
<body>

<div class="form-container">
    <h2>Add Doctor</h2>
    <form action="../server/addDoctor.php" method="POST">
        <div class="form-group">
            <label for="FirstName">First Name:</label>
            <input type="text" name="FirstName" id="FirstName" required>
        </div>

        <div class="form-group">
            <label for="LastName">Last Name:</label>
            <input type="text" name="LastName" id="LastName" required>
        </div>

        <div class="form-group">
            <label for="Specialization">Specialization:</label>
            <select name="SpecializationID" id="Specialization" required>
                <!-- Specialization options will be dynamically loaded here -->
            </select>
            <!-- Hidden input to store SpecializationName -->
            <input type="hidden" name="SpecializationName" id="SpecializationName">
        </div>

        <div class="form-group">
            <label for="ContactNumber">Contact Number:</label>
            <input type="text" name="ContactNumber" id="ContactNumber" required>
        </div>

        <div class="form-group">
            <label for="Email">Email:</label>
            <input type="email" name="Email" id="Email">
        </div>

        <div class="form-group">
            <label for="Address">Address:</label>
            <input type="text" name="Address" id="Address">
        </div>

        <button type="submit" class="submit-btn">Add Doctor</button>
    </form>
</div>

<script>
    // Fetch specializations and populate the dropdown
    fetch('../server/handleGetSpecialization.php')
        .then(response => response.json())
        .then(data => {
            const specializationSelect = document.getElementById('Specialization');
            const specializationNameInput = document.getElementById('SpecializationName');

            // Populate the dropdown with options
            data.forEach(specialization => {
                const option = document.createElement('option');
                option.value = specialization.SpecializationID;
                option.text = specialization.SpecializationName;
                option.dataset.name = specialization.SpecializationName; // Store the name as a data attribute
                specializationSelect.add(option);
            });

            // Update the hidden input when a specialization is selected
            specializationSelect.addEventListener('change', (event) => {
                const selectedOption = event.target.selectedOptions[0];
                specializationNameInput.value = selectedOption.dataset.name;
            });

            // Set the initial value for the hidden input
            if (specializationSelect.options.length > 0) {
                specializationNameInput.value = specializationSelect.options[0].dataset.name;
            }
        })
        .catch(error => console.error('Error fetching specializations:', error));
</script>

</body>
</html>
