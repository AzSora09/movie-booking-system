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
        <div class="container my-5" style="min-height: 70vh;">


            <!-- Hero section containing website introduction and main navigation buttons -->
            <div class="p-5 mb-5 bg-light rounded-3 text-center">

                <h1 class="display-5 fw-bold">
                    Book Your Next Movie Experience
                </h1>


                <p class="lead">
                    Browse the latest movies, discover cinemas, and book tickets in just a few clicks.
                </p>


                <!-- Buttons to navigate to movies and cinemas pages -->
                <a href="./movies.php" class="btn btn-danger btn-lg me-2">
                    Browse Movies
                </a>


                <a href="./cinemas.php" class="btn btn-outline-danger btn-lg">
                    Browse Cinemas
                </a>

            </div>



            <!-- Section displaying a limited number of latest movies -->
            <div class="d-flex justify-content-between align-items-center mb-3">

                <h2>
                    Now Showing
                </h2>


                <a href="./movies.php" class="btn btn-sm btn-outline-danger">
                    View All
                </a>

            </div>



            <div class="row g-4 mb-5">

                <?php

                // Fetch latest movies to display on the homepage
                $movies = mysqli_query(
                    $conn,
                    "SELECT * FROM movies ORDER BY id DESC LIMIT 4"
                );


                // Loop through movies and create movie cards
                while ($movie = mysqli_fetch_assoc($movies)) {

                ?>

                    <div class="col-md-3">

                        <div class="card h-100 shadow-sm">


                            <img
                                src="./images/<?= $movie["poster"] ?>"
                                class="card-img-top"
                                style="height:350px; object-fit:cover;">



                            <div class="card-body d-flex flex-column">


                                <h5 class="card-title">
                                    <?= $movie["title"] ?>
                                </h5>


                                <p class="text-muted mb-1">
                                    <?= $movie["genre"] ?>
                                </p>


                                <p class="text-muted">
                                    <?= $movie["duration"] ?>
                                </p>



                                <!-- Link to view complete movie information -->
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



            <!-- Section displaying a limited number of cinemas available on the website -->
            <div class="d-flex justify-content-between align-items-center mb-3">

                <h2>
                    Our Cinemas
                </h2>


                <a href="./cinemas.php" class="btn btn-sm btn-outline-danger">
                    View All
                </a>

            </div>



            <div class="row g-4">


                <?php

                // Fetch cinemas to display on the homepage
                $cinemas = mysqli_query(
                    $conn,
                    "SELECT * FROM cinemas LIMIT 4"
                );


                // Loop through cinemas and create cinema cards
                while ($cinema = mysqli_fetch_assoc($cinemas)) {

                ?>


                    <div class="col-md-3">


                        <div class="card h-100 shadow-sm">


                            <div class="card-body">


                                <h4>
                                    <?php echo $cinema["name"]; ?>
                                </h4>


                                <p class="text-muted">
                                    <?php echo $cinema["location"]; ?>
                                </p>



                                <!-- Link to view movies available in the selected cinema -->
                                <a
                                    href="./cinema.php?id=<?php echo $cinema["id"]; ?>"
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