<?php
// Import shared functions and database connection for user pages
include("./required.php");
// Import file that handles cinema logic
include("./logics/cinema.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head($cinema["name"]);
    ?>
</head>

<body>
    <?php
    // Navbar
    navbar();
    ?>

    <!-- Main Content -->
    <main>
        <div class="container py-5" style="min-height:70vh;">

            <div class="mb-5">

                <!-- Display cinema name and location -->
                <h1>
                    <?php echo $cinema["name"]; ?>
                </h1>

                <p class="text-muted">
                    📍 <?php echo $cinema["location"]; ?>
                </p>

            </div>

            <!-- Display movies showing in the cinema -->
            <h3 class="mb-4">
                Movies Showing
            </h3>



            <?php if (mysqli_num_rows($schedule_query) == 0) { ?>

                <div class="alert alert-warning">
                    No movies are currently showing in this cinema.
                </div>


            <?php } else { ?>


                <?php

                $current_movie = null;

                // Loop schedules and group by movie
                while ($schedule = mysqli_fetch_assoc($schedule_query)) {


                    if ($current_movie != $schedule["movie_id"]) {


                        if ($current_movie !== null) {
                            echo "</div>";
                            echo "</div>";
                        }


                        $current_movie = $schedule["movie_id"];

                ?>


                        <div class="card shadow-sm mb-4">


                            <div class="card-body">


                                <div class="d-flex justify-content-between align-items-center mb-3">


                                    <h4 class="mb-0">

                                        <?php

                                        // Display the title of the movie
                                        echo getvalue(
                                            "movies",
                                            "title",
                                            $schedule["movie_id"]
                                        );

                                        ?>

                                    </h4>


                                    <!-- Movie Details Button -->
                                    <a
                                        href="./movie.php?id=<?= $schedule["movie_id"] ?>"
                                        class="btn btn-outline-danger">

                                        Movie Details

                                    </a>


                                </div>


                                <div class="row g-3">


                                <?php

                            }

                                ?>


                                <div class="col-md-4">


                                    <div class="border rounded p-3">

                                        <!-- Show Date and Time -->
                                        <p>
                                            📅 <?= $schedule["date"] ?>
                                        </p>


                                        <p>
                                            🕒 <?= $schedule["time"] ?>
                                        </p>

                                        <!-- Display ticket prices for different seating categories -->
                                        <p>

                                            Box:
                                            <?= $schedule["box_price"] ?>

                                            <br>

                                            Gold:
                                            <?= $schedule["gold_price"] ?>

                                            <br>

                                            Platinum:
                                            <?= $schedule["platinum_price"] ?>

                                        </p>


                                        <a
                                            href="./book.php?schedule=<?= $schedule["id"] ?>"
                                            class="btn btn-danger w-100">

                                            Book

                                        </a>


                                    </div>


                                </div>


                            <?php } ?>


                                </div>

                            </div>

                        </div>


                    <?php } ?>

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