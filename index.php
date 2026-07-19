<?php
// Import shared functions and database connection for user pages
include("./required.php");
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

        <div class="container my-5" style="min-height:70vh;">


            <!-- Hero section introducing the website -->
            <div
                class="text-center rounded-4 p-5 mb-5 shadow"
                style="
                background:linear-gradient(135deg,#4c1d95,#7c3aed);
                color:white;
            ">

                <h1 class="display-4 fw-bold mb-3">

                    🎬 Welcome to ShowRadar

                </h1>


                <p class="lead text-light mb-4">

                    Discover the latest movies, explore nearby cinemas,
                    and book your favourite seats in just a few clicks.

                </p>


                <!-- Hero navigation buttons -->
                <a
                    href="./movies.php"
                    class="btn btn-light btn-lg me-3">

                    Browse Movies

                </a>


                <a
                    href="./cinemas.php"
                    class="btn btn-outline-light btn-lg">

                    Browse Cinemas

                </a>

            </div>



            <!-- Latest movies section -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <h2 class="fw-bold">

                    Now Showing

                </h2>

                <a
                    href="./movies.php"
                    class="btn btn-outline-danger">

                    View All

                </a>

            </div>


            <div class="row g-4 mb-5">

                <?php

                // Fetch latest movies for the homepage
                $movies = mysqli_query(
                    $conn,
                    "SELECT * FROM movies ORDER BY id DESC LIMIT 4"
                );

                while ($movie = mysqli_fetch_assoc($movies)) {

                ?>

                    <div class="col-lg-3 col-md-6">

                        <div class="card h-100 shadow">

                            <img
                                src="./images/<?= $movie["poster"] ?>"
                                class="card-img-top"
                                style="height:360px;object-fit:cover;">


                            <div class="card-body d-flex flex-column">

                                <h5 class="fw-bold">

                                    <?= $movie["title"] ?>

                                </h5>


                                <p class="text-secondary mb-1">

                                    <?= $movie["genre"] ?>

                                </p>


                                <small class="text-secondary mb-3">

                                    <?= $movie["duration"] ?>

                                </small>


                                <!-- View movie details -->
                                <a
                                    href="./movie.php?id=<?= $movie["id"] ?>"
                                    class="btn btn-danger mt-auto">

                                    View Details

                                </a>

                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>



            <!-- Featured cinemas section -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <h2 class="fw-bold">

                    Our Cinemas

                </h2>

                <a
                    href="./cinemas.php"
                    class="btn btn-outline-danger">

                    View All

                </a>

            </div>


            <div class="row g-4">

                <?php

                // Fetch cinemas for homepage
                $cinemas = mysqli_query(
                    $conn,
                    "SELECT * FROM cinemas LIMIT 4"
                );

                while ($cinema = mysqli_fetch_assoc($cinemas)) {

                ?>

                    <div class="col-lg-3 col-md-6">

                        <div class="card h-100 shadow">

                            <div class="card-body d-flex flex-column">

                                <h4 class="fw-bold">

                                    <?= $cinema["name"] ?>

                                </h4>


                                <p class="text-secondary flex-grow-1">

                                    📍 <?= $cinema["location"] ?>

                                </p>


                                <!-- View cinema page -->
                                <a
                                    href="./cinema.php?id=<?= $cinema["id"] ?>"
                                    class="btn btn-outline-danger">

                                    View Movies

                                </a>

                            </div>

                        </div>

                    </div>

                <?php } ?>

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