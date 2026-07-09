<?php
include("./adminrequired.php");
// Admin dashboard entry page. Shared admin layout utilities are loaded from adminrequired.php.
global $conn;
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("Movie Booking System - Admin Dashboard");
    ?>
</head>

<body>
    <?php
    // Render the admin navigation bar at the top of the page
    navbar();
    ?>


    <main>
        <div class="container mt-4">

            <h2 class="mb-4">Dashboard</h2>

            <!-- Statistics -->
            <div class="row g-3 mb-5">

                <div class="col-md-4 col-lg-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h2><?= countdata("movies") ?></h2>
                            <p class="mb-0">Movies</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h2><?= countdata("cinemas") ?></h2>
                            <p class="mb-0">Cinemas</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h2><?= countdata("accounts") ?></h2>
                            <p class="mb-0">Users</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h2><?= countdata("schedules") ?></h2>
                            <p class="mb-0">Schedules</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h2><?= countdata("tickets") ?></h2>
                            <p class="mb-0">Tickets</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h2><?= countdata("reviews") ?></h2>
                            <p class="mb-0">Reviews</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Quick Actions -->
            <h4 class="mb-3">Quick Actions</h4>

            <div class="d-flex gap-3 flex-wrap">

                <a href="add-movie.php" class="btn btn-primary">
                    Add Movie
                </a>

                <a href="add-cinema.php" class="btn btn-success">
                    Add Cinema
                </a>

                <a href="add-schedule.php" class="btn btn-warning">
                    Add Schedule
                </a>

            </div>

            <div class="row mt-5">

                <!-- Latest Movies -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            Latest Movies
                        </div>
                        <div class="card-body">

                            <ul class="list-group list-group-flush">

                                <?php
                                $movies = mysqli_query($conn, "SELECT title FROM movies ORDER BY id DESC LIMIT 5");

                                while ($movie = mysqli_fetch_assoc($movies)) {
                                ?>

                                    <li class="list-group-item">
                                        <?= $movie["title"] ?>
                                    </li>

                                <?php } ?>

                            </ul>

                        </div>
                    </div>
                </div>

                <!-- Latest Reviews -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            Latest Reviews
                        </div>
                        <div class="card-body">

                            <ul class="list-group list-group-flush">

                                <?php
                                $reviews = mysqli_query($conn, "SELECT * FROM reviews ORDER BY id DESC LIMIT 5");

                                if (mysqli_num_rows($reviews) === 0) {
                                    echo '<li class="list-group-item">No reviews yet.</li>';
                                } else {
                                    while ($review = mysqli_fetch_assoc($reviews)) {
                                ?>

                                        <li class="list-group-item">
                                            <strong><?= getValue("accounts", "first_name", $review["user_id"]) ?></strong>
                                            reviewed
                                            <strong><?= getValue("movies", "title", $review["movie_id"]) ?></strong>
                                            (<?= $review["rating"] ?>/5)
                                        </li>

                                <?php }
                                } ?>

                            </ul>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>



    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>