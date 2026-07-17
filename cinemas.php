<?php
// Import shared functions and database connection for user pages
include("./required.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("Cinemas");
    ?>
</head>

<body>
    <?php
    // Navbar
    navbar();
    ?>


    <main>
        <div class="container my-5" style="min-height: 70vh;">

            <h2 class="mb-4">Cinemas</h2>

            <div class="row g-4">

                <?php


                // Display all cinemas ordered alphabetically
                $query = mysqli_query(
                    $conn,
                    "SELECT * FROM cinemas
                 ORDER BY name"
                );

                // Loop through cinemas and create a card for each cinema
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


                                <!-- Link to view movies and schedules available in this cinema -->
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
                ?>

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