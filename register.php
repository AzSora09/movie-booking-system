<?php
// Import shared functions and database connection for user pages
include("./required.php");
?>
<!doctype html>
<html lang="en">

<head>

    <?php head("Register"); ?>

    <link rel="stylesheet" href="./css/auth.css">

</head>

<body class="auth-body">

    <div class="container">

        <div class="auth-card shadow">

            <h2 class="text-center mb-2">

                Create Account

            </h2>

            <p class="text-center text-muted mb-4">

                Join ShowRadar to book your favourite movies

            </p>

            <!-- Registration form for new users -->
            <form method="post">


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            First Name

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="f-name"
                            placeholder="First Name"
                            required>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Last Name

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="l-name"
                            placeholder="Last Name"
                            required>

                    </div>

                </div>



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
                        placeholder="Create a password"
                        required>

                </div>



                <button
                    type="submit"
                    name="submit"
                    class="btn btn-danger w-100">

                    Register Account

                </button>



                <p class="text-center mt-4 mb-0">

                    Already have an account?

                    <a href="./login.php">

                        Log In

                    </a>

                </p>

            </form>

            <?php
            // Function to register account when form is submitted
            register();
            ?>
        </div>

    </div>

    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>

</html>