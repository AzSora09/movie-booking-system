<?php
include("./required.php");
// Main public homepage — loads shared setup and site navigation
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Render the shared <head> section with page title and required assets
    head("Movie Booking System");
    ?>
</head>

<body>
    <?php
    // Render the site navigation bar
    navbar();
    ?>


    <main>
        <div class="container my-5" style="min-height: 70vh;">

            <!-- Hero section with main call-to-action buttons -->
            <div class="p-5 mb-5 bg-light rounded-3 text-center">
                <h1 class="display-5 fw-bold">Book Your Next Movie Experience</h1>

                <p class="lead">
                    Browse the latest movies, discover cinemas, and book tickets in just a few clicks.
                </p>

                <a href="./movies.php" class="btn btn-danger btn-lg me-2">
                    Browse Movies
                </a>

                <a href="./cinemas.php" class="btn btn-outline-danger btn-lg">
                    Browse Cinemas
                </a>
            </div>

            <!-- Show a few latest movies on the homepage -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Now Showing</h2>

                <a href="./movies.php" class="btn btn-sm btn-outline-danger">
                    View All
                </a>
            </div>

            <div class="row g-4 mb-5">

                <?php
                // Pull a small list of recent movies for the homepage
                $movies = mysqli_query($conn, "SELECT * FROM movies ORDER BY id DESC LIMIT 4");

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

            <!-- Show a few cinemas on the homepage -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Our Cinemas</h2>

                <a href="./cinemas.php" class="btn btn-sm btn-outline-danger">
                    View All
                </a>
            </div>

            <div class="row g-4">

                <?php
                // Pull a small list of cinemas for the homepage
                $cinemas = mysqli_query($conn, "SELECT * FROM cinemas LIMIT 4");

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
    footer();
    ?>

    <!-- Bootstrap JS -->
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>