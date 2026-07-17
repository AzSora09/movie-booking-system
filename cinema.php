<?php
include("./required.php");
// Cinema page — uses shared setup and loads cinema schedules
include("./logics/cinema.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Render the shared <head> section with page title and required assets
    head($cinema["name"]);
    ?>
</head>

<body>
    <?php
    // Render the site navigation bar
    navbar();
    ?>

    <main>
        <div class="container py-5" style="min-height:70vh;">

            <div class="mb-5">

                <h1>
                    <?php echo $cinema["name"]; ?>
                </h1>

                <p class="text-muted">
                    📍 <?php echo $cinema["location"]; ?>
                </p>

            </div>


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

                                        echo getvalue(
                                            "movies",
                                            "title",
                                            $schedule["movie_id"]
                                        );

                                        ?>

                                    </h4>


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


                                        <p>
                                            📅 <?= $schedule["date"] ?>
                                        </p>


                                        <p>
                                            🕒 <?= $schedule["time"] ?>
                                        </p>


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
    footer();
    ?>

    <!-- Bootstrap JS -->
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>