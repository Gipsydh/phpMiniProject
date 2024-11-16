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
    '/miniproject/public/bookAppointment.php?category=' +
    encodeURIComponent(category)
}
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