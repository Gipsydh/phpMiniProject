<?php
// You can include session_start() if you want session management in the header as well
session_start();
?>

<body>
    <div class="container">
        <nav class="navbar">
            <div class="upper">
                <div class="logo">logo</div>
                <form class="searchBar">
        <input type="text" id="searchQuery" placeholder="Search doctors by name" />
                    <div class="searchButton pointer">
                        <i class="fa-solid fa-magnifying-glass" onclick="searchDoctors()"></i>
                    </div>
                </form>
                <div class="userGetIn">
                    <?php if (isset($_SESSION['email'])): ?>
                    <div class="sideButtons">
                        <div class="button">
                            <div class="btn pointer">
                                <i class="fa-solid fa-user"></i>
                                <span><?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?></span>
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
    </div>
    <script>
         function searchDoctors() {
            const query = document.getElementById('searchQuery').value.trim();

            // Check if the query is not empty
            if (query) {
                // Redirect to another page with the search query as a URL parameter
                window.location.href = `./search_results.php?search=${encodeURIComponent(query)}`;
            } else {
                alert("Please enter a name to search.");
            }
        }
    </script>
</body>
</html>
