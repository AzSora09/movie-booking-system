<?php
include("./required.php");
// Public home page for the movie booking system
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Render the shared <head> section with page title and required assets
    head("Movies");
    ?>
</head>

<body>
    <?php
    // Render the site navigation bar
    navbar();
    ?>


    <main>
        <div class="container my-5" style="min-height: 70vh;">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Movies</h2>
            </div>

            <div class="row g-4">

                <?php

                if (isset($_GET["search"]) && $_GET["search"] != "") {

                    $search = mysqli_real_escape_string($conn, $_GET["search"]);

                    $query = mysqli_query(
                        $conn,
                        "SELECT * FROM movies
                        WHERE title LIKE '%$search%'
                        ORDER BY title"
                    );

                    if (mysqli_num_rows($query) == 0) { ?>

                        <div class="d-flex flex-column justify-content-center align-items-center text-center py-5" style="min-height: 60vh;">

                            <h2 class="text-muted">No Results Found</h2>

                            <p class="text-secondary">
                                We couldn't find any movies matching your search.
                            </p>

                            <a href="./movies.php" class="btn btn-danger mt-2">
                                View All Movies
                            </a>

                        </div>

                    <?php }

                } else {

                    $query = mysqli_query(
                        $conn,
                        "SELECT * FROM movies
                    ORDER BY title"
                    );
                }

                while ($movie = mysqli_fetch_assoc($query)) {
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

        </div>
    </main>


    <?php
    footer();
    ?>

    <!-- Bootstrap JS -->
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>