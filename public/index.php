<?php
// Start the session
session_start();

// Check if the user clicked the "Sign Out" button

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
    <link rel="stylesheet" href="./css/style.css" />
    <title>Document</title>
  </head>
  <body>
    <div class="container">
      <nav class="navbar">
        <div class="upper">
          <div class="logo">logo</div>
          <form class="searchBar">
            <input type="text" />
            <div class="searchButton pointer">
              <i class="fa-solid fa-magnifying-glass"></i>
            </div>
          </form>
          <div class="userGetIn">
            <?php if (isset($_SESSION['email'])): ?>
            <div class="sideButtons">
              <div class="button">
                <div class="btn pointer">
                  <i class="fa-solid fa-user"></i>
                  <span
                    ><?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?></span
                  >
                </div>
              </div>
            </div>
            <div class="sideButtons">
              <div class="button">
                <div class="btn pointer" onclick="handleLogout()">
                  <i class="fa-solid fa-right-from-bracket"></i>
                  <span>Sign out</span>
                </div>
              </div>
            </div>
            <?php else: ?>
              <div class="sideButtons">
                <div class="button">
                  <div class="btn pointer" onclick="handleAdminLogin()">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Admin Login</span>
                  </div>
                </div>
              </div>
            <div class="sideButtons">
              <div class="button">
                <div class="btn pointer" onclick="redirectToSignup()">
                  <i class="fa-solid fa-user"></i>
                  <span>Signup</span>
                </div>
              </div>
            </div>
            <div class="sideButtons">
              <div class="button">
                <div class="btn pointer" onclick="redirectToLogin()">
                  <i class="fa-solid fa-right-to-bracket"></i>
                  <span>Login</span>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="lower">
          <div class="navOption">
            <span>Category</span>
            <i class="fa-solid fa-caret-down"></i>
          </div>
          <div class="navOption">
            <span>Appointment a doctor</span>
            <i class="fa-solid fa-caret-down"></i>
          </div>
        </div>
      </nav>
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
            <img src="" alt="" />
          </div>
          <div class="right">
            <div class="categories">
              <div class="category">
                <div class="logo">
                  <span>IMG</span>
                </div>
                <span>text</span>
              </div>
              <div class="category">
                <div class="logo">
                  <span>IMG</span>
                </div>
                <span>text</span>
              </div>
              <div class="category">
                <div class="logo">
                  <span>IMG</span>
                </div>
                <span>text</span>
              </div>
              <div class="category">
                <div class="logo">
                  <span>IMG</span>
                </div>
                <span>text</span>
              </div>
              <div class="category">
                <div class="logo">
                  <span>IMG</span>
                </div>
                <span>text</span>
              </div>
              <div class="category">
                <div class="logo">
                  <span>IMG</span>
                </div>
                <span>text</span>
              </div>
              <div class="category">
                <div class="logo">
                  <span>IMG</span>
                </div>
                <span>text</span>
              </div>
              <div class="category">
                <div class="logo">
                  <span>IMG</span>
                </div>
                <span>text</span>
              </div>
              <div class="category">
                <div class="logo">
                  <span>IMG</span>
                </div>
                <span>text</span>
              </div>
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
      function handleAdminLogin(){
        window.location.href = 'adminLogin.php' // Redirect to signup page
      }
      function redirectToLogin() {
        window.location.href = 'signin.php' // Redirect to login page
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
