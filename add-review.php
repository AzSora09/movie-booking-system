<?php
// Import shared functions and database connection for user pages
include("./required.php");
// Import file that handles review submission logic
include("./logics/add-review.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("Review");
    ?>
    <link rel="stylesheet" href="./css/review.css">
</head>

<body>
    <?php
    // Navbar
    navbar();
    ?>


    <!-- Start of the main content -->
    <main>
        <div class="container py-5" style="min-height:70vh;">


            <!-- Review card containing movie details and review form -->
            <div class="card shadow-sm mx-auto review-card">


                <div class="card-body">


                    <h2 class="mb-4">

                        Review:
                        <?= $movie["title"] ?>

                    </h2>



                    <!-- Form to submit a review for the selected movie -->
                    <form method="POST">



                        <!-- Rating selection using star inputs -->

                        <label class="form-label">

                            Rating

                        </label>



                        <div class="rating">


                            <input type="radio" name="rating" value="5" id="star5">
                            <label for="star5">★</label>


                            <input type="radio" name="rating" value="4" id="star4">
                            <label for="star4">★</label>


                            <input type="radio" name="rating" value="3" id="star3">
                            <label for="star3">★</label>


                            <input type="radio" name="rating" value="2" id="star2">
                            <label for="star2">★</label>


                            <input type="radio" name="rating" value="1" id="star1">
                            <label for="star1">★</label>


                        </div>





                        <!-- Text area for user review comment -->

                        <div class="mb-3">


                            <label class="form-label">

                                Comment

                            </label>


                            <textarea
                                name="comment"
                                class="form-control"
                                rows="4"
                                placeholder="Write your review..."></textarea>


                        </div>





                        <!-- Submit button to save the review -->

                        <button
                            class="btn btn-danger"
                            name="submit">


                            Submit Review


                        </button>



                    </form>



                </div>


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