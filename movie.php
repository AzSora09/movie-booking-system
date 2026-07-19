<?php
// Import shared functions and database connection for user pages
include("./required.php");
// Import file that handles movies logic
include("./logics/movie.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head($movie["title"]);
    ?>
    <link rel="stylesheet" href="./css/review.css">
</head>

<body>
    <?php
    // Navbar
    navbar();
    ?>

    <main>
        <div class="container py-5" style="min-height:70vh;">

            <!-- Movie Details -->
            <div class="row mb-5">

                <div class="col-md-4">

                    <!-- Movie Poster -->
                    <img
                        src="./images/<?php echo $movie["poster"]; ?>"
                        class="img-fluid rounded shadow"
                        alt="<?php echo $movie["title"]; ?>">

                </div>


                <!-- Movie Information -->
                <div class="col-md-8">

                    <h1>
                        <?php echo $movie["title"]; ?>
                    </h1>


                    <p>
                        ⭐ <?php echo $average_rating; ?>
                    </p>


                    <p>
                        <strong>Genre:</strong>
                        <?php echo $movie["genre"]; ?>
                    </p>


                    <p>
                        <strong>Duration:</strong>
                        <?php echo $movie["duration"]; ?>
                    </p>


                    <p>
                        <strong>Language:</strong>
                        <?php echo $movie["language"]; ?>
                    </p>


                    <p>
                        <strong>Age Rating:</strong>
                        <?php echo $movie["age_rating"]; ?>
                    </p>


                </div>

            </div>


            <!-- Movie description and details -->
            <div class="mb-5">

                <h3>Description</h3>

                <p>
                    <?php echo $movie["description"]; ?>
                </p>

            </div>


            <!-- Trailer -->
            <div class="mb-5">

                <h3>Trailer</h3>

                <div class="ratio ratio-16x9">

                    <iframe
                        src="https://www.youtube.com/embed/<?php echo $movie["trailer"]; ?>"
                        allowfullscreen>
                    </iframe>

                </div>

            </div>



            <!-- Available show times for this movie -->

            <h3 class="mb-3">
                Available Shows
            </h3>


            <?php
            // Display available schedules for the selected movie
            if (mysqli_num_rows($schedule_query) == 0) { ?>

                <div class="alert alert-warning">

                    No schedules are currently available for this movie.

                </div>

            <?php } else { ?>

                <div class="table-responsive">

                    <table class="table table-dark table-hover align-middle">

                        <!-- Table heading -->
                        <thead>

                            <tr>

                                <th>Cinema</th>

                                <th>Date</th>

                                <th>Time</th>

                                <th>Ticket Prices</th>

                                <th class="text-center">
                                    Booking
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php
                            // Loop through available schedules
                            while ($schedule = mysqli_fetch_assoc($schedule_query)) {
                            ?>

                                <tr>

                                    <td>

                                        <?= getvalue(
                                            "cinemas",
                                            "name",
                                            $schedule["cinema_id"]
                                        ); ?>

                                    </td>


                                    <td>

                                        <?= $schedule["date"]; ?>

                                    </td>


                                    <td>

                                        <?= $schedule["time"]; ?>

                                    </td>


                                    <td>

                                        <strong>Box:</strong>
                                        Rs. <?= $schedule["box_price"]; ?>

                                        <br>

                                        <strong>Gold:</strong>
                                        Rs. <?= $schedule["gold_price"]; ?>

                                        <br>

                                        <strong>Platinum:</strong>
                                        Rs. <?= $schedule["platinum_price"]; ?>

                                    </td>


                                    <td class="text-center">

                                        <!-- Link to ticket booking page -->
                                        <a
                                            href="./book.php?schedule=<?= $schedule["id"]; ?>"
                                            class="btn btn-danger">

                                            Book Now

                                        </a>

                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            <?php } ?>

            <!-- Reviews section -->

            <div class="mt-5">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h3>
                        Reviews
                    </h3>


                    <?php
                    // Allow users to write a review if they are logged in, otherwise ask them to log in first
                    if (isset($_SESSION["user_name"])) { ?>

                        <a
                            href="./add-review.php?movie=<?php echo $movie_id; ?>"
                            class="btn btn-outline-danger">

                            Write Review

                        </a>

                    <?php } else { ?>

                        <a
                            href="./login.php"
                            class="btn btn-outline-danger">

                            Login to Review

                        </a>

                    <?php } ?>

                </div>



                <?php
                // Check if there are any reviews for this movie
                // If there are no reviews, display a message. Otherwise, show all reviews for this movie
                if (mysqli_num_rows($review_query) == 0) { ?>


                    <div class="alert alert-info">

                        No reviews yet.

                    </div>


                <?php } else { ?>


                    <?php

                    // Get all reviews for this movie and display them in a card format
                    while ($review = mysqli_fetch_assoc($review_query)) { ?>


                        <div class="card mb-3 shadow-sm">


                            <div class="card-body">


                                <div class="d-flex justify-content-between">


                                    <h5 class="card-title">


                                        <?php

                                        echo getvalue(
                                            "accounts",
                                            "first_name",
                                            $review["user_id"]
                                        );


                                        echo " ";


                                        echo getvalue(
                                            "accounts",
                                            "last_name",
                                            $review["user_id"]
                                        );

                                        ?>


                                    </h5>



                                    <span class="review-stars">


                                        <?php

                                        for ($i = 1; $i <= 5; $i++) {


                                            if ($i <= $review["rating"]) {

                                                echo "★";
                                            } else {

                                                echo "☆";
                                            }
                                        }

                                        ?>


                                    </span>


                                </div>




                                <p class="card-text mt-2">

                                    <?php echo $review["comment"]; ?>

                                </p>




                                <small class="text-muted">

                                    <?php echo $review["review_datetime"]; ?>

                                </small>



                            </div>


                        </div>


                    <?php } ?>


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