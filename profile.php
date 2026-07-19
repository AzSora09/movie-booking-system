<?php
// Import shared functions and database connection for user pages
include("./required.php");

// Fetch the logged in user's profile information
$user = profiledata();
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("Movie Booking System");
    ?>
</head>

<body>
    <?php
    // Navbar
    navbar();
    ?>


    <main>

        <div class="container py-5" style="min-height:70vh;">

            <!-- Page heading -->
            <div class="mb-5">

                <h1 class="fw-bold">

                    My Profile

                </h1>

                <p class="text-secondary">

                    Manage your account and view your information.

                </p>

            </div>


            <div class="row g-4">

                <!-- Profile information -->
                <div class="col-lg-4">

                    <div class="card shadow h-100">

                        <div class="card-body text-center">

                            <!-- User avatar -->
                            <div
                                class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                style="
                                width:110px;
                                height:110px;
                                background:#7c3aed;
                                font-size:42px;
                                font-weight:bold;
                            ">

                                <?= strtoupper(substr($user["first_name"], 0, 1)); ?>

                            </div>


                            <h3>

                                <?= $user["first_name"] ?>
                                <?= $user["last_name"] ?>

                            </h3>

                            <p class="text-secondary">

                                <?= $user["email"] ?>

                            </p>


                            <span class="badge bg-danger px-3 py-2">

                                <?= ucfirst($user["role"]) ?>

                            </span>

                        </div>

                    </div>

                </div>



                <!-- Account information -->
                <div class="col-lg-8">

                    <div class="card shadow mb-4">

                        <div class="card-header">

                            <h4 class="mb-0">

                                Account Information

                            </h4>

                        </div>

                        <div class="card-body">

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        First Name

                                    </strong>

                                </div>

                                <div class="col-md-8">

                                    <?= $user["first_name"] ?>

                                </div>

                            </div>


                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Last Name

                                    </strong>

                                </div>

                                <div class="col-md-8">

                                    <?= $user["last_name"] ?>

                                </div>

                            </div>


                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Email

                                    </strong>

                                </div>

                                <div class="col-md-8">

                                    <?= $user["email"] ?>

                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-4">

                                    <strong>

                                        Role

                                    </strong>

                                </div>

                                <div class="col-md-8">

                                    <?= ucfirst($user["role"]) ?>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- Quick actions -->
                    <div class="card shadow">

                        <div class="card-header">

                            <h4 class="mb-0">

                                Quick Actions

                            </h4>

                        </div>

                        <div class="card-body">

                            <div class="d-flex flex-wrap gap-3">

                                <a
                                    href="./my-bookings.php"
                                    class="btn btn-danger">

                                    🎟 My Bookings

                                </a>

                                <a
                                    href="./movies.php"
                                    class="btn btn-outline-danger">

                                    🎬 Browse Movies

                                </a>

                                <a
                                    href="./logout.php"
                                    class="btn btn-outline-light">

                                    Log Out

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>


    <?php
    // Footer
    footer();
    ?>


    <!-- Bootstrap JS -->
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>

</html>