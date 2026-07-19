<?php
// Import shared functions and database connection for user pages
include("./required.php");
?>
<!doctype html>
<html lang="en">

<head>

    <?php
    // Use head function to add title and required assets for the page
    head("Login");
    ?>

    <link rel="stylesheet" href="./css/auth.css">

</head>

<body class="auth-body">

    <main>

        <div class="container d-flex align-items-center justify-content-center" style="min-height:85vh;">

            <div class="auth-card shadow">

                <h2 class="text-center mb-2">
                    Welcome Back
                </h2>

                <p class="text-center auth-subtitle mb-4">
                    Log in to your ShowRadar account
                </p>

                <!-- Login form for existing users -->
                <form method="post">

                    <div class="mb-3">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            placeholder="Enter your email"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            name="pass"
                            placeholder="Enter your password"
                            required>

                    </div>

                    <button
                        type="submit"
                        name="submit"
                        class="btn btn-danger w-100">

                        Log In

                    </button>

                    <p class="text-center auth-footer mt-4 mb-0">

                        Don't have an account?

                        <a href="./register.php">

                            Register

                        </a>

                    </p>

                </form>

                <?php
                // Function to login when login form is submitted
                login();
                ?>

            </div>

        </div>

    </main>

    <!-- Bootstrap JS -->
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>

</html>