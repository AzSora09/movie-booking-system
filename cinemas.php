<?php
include("./required.php");
// Cinemas listing page — loads shared setup and lists cinemas
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

            <h2 class="mb-4">Cinemas</h2>

            <div class="row g-4">

                <?php

                // Search cinemas by name or location when search param present
                if (isset($_GET["search"]) && $_GET["search"] != "") {

                    $search = mysqli_real_escape_string($conn, $_GET["search"]);

                    $query = mysqli_query(
                        $conn,
                        "SELECT * FROM cinemas
                 WHERE name LIKE '%$search%'
                    OR location LIKE '%$search%'
                 ORDER BY name"
                    );
                } else {

                    // Default: list all cinemas ordered by name
                    $query = mysqli_query(
                        $conn,
                        "SELECT * FROM cinemas
                 ORDER BY name"
                    );
                }

                // If no cinemas found, show a message
                if (mysqli_num_rows($query) == 0) {
                ?>

                    <div class="d-flex flex-column justify-content-center align-items-center text-center py-5" style="min-height: 60vh;">

                        <h2 class="text-muted">No Results Found</h2>

                        <p class="text-secondary">
                            We couldn't find any cinemas matching your search.
                        </p>

                        <a href="./cinemas.php" class="btn btn-danger mt-2">
                            View All Cinemas
                        </a>

                    </div>

                    <?php

                } else {

                    while ($cinema = mysqli_fetch_assoc($query)) {

                    ?>

                        <div class="col-md-4">

                            <div class="card h-100 shadow-sm">

                                <div class="card-body d-flex flex-column">

                                    <h4 class="card-title">
                                        <?= $cinema["name"] ?>
                                    </h4>

                                    <p class="text-muted">
                                        <?= $cinema["location"] ?>
                                    </p>

                                    <a
                                        href="./cinema.php?id=<?= $cinema["id"] ?>"
                                        class="btn btn-danger mt-auto">
                                        View Movies
                                    </a>

                                </div>

                            </div>

                        </div>

                <?php
                    }
                }
                ?>

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