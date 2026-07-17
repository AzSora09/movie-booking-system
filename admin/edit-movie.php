<?php
// Import shared functions and database connection for admin pages
include("./adminrequired.php");

// Import file that contains movie related functions
include("./logics/movies.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("Edit Movie");
    ?>
</head>

<body>
    <?php
    // Navbar
    navbar();
    ?>

    <!-- Start of the main content -->
    <main>

        <div class="container mt-5">

            <h2>Edit Movie</h2>

            <?php
            // Fetch movie details from the database
            $result = selectdata("movies", $_GET["id"]);
            $row = mysqli_fetch_assoc($result);
            ?>

            <!-- Start of the form to edit movie details -->
            <form action="" method="post" enctype="multipart/form-data">

                <!-- Input field for movie name -->
                <div class="mb-3">

                    <label class="form-label">Movie Name</label>

                    <input
                        type="text"
                        name="name"
                        value="<?php echo $row["title"]; ?>"
                        class="form-control" />

                </div>


                <!-- Input field for movie description -->
                <div class="mb-3">

                    <label class="form-label">Description</label>

                    <textarea
                        name="desc"
                        class="form-control"
                        rows="6"
                        maxlength="2000"><?php echo $row["description"]; ?></textarea>

                </div>


                <!-- Input field for movie genre -->
                <div class="mb-3">

                    <label class="form-label">Genre</label>

                    <input
                        type="text"
                        name="genre"
                        value="<?php echo $row["genre"]; ?>"
                        class="form-control" />

                </div>


                <!-- Input fields for movie duration -->
                <div class="mb-3">

                    <label class="form-label">Duration</label>

                    <div>

                        <input
                            type="number"
                            name="dur_hr"
                            value="<?php echo explode(' ', $row["duration"])[0]; ?>"
                            class="form-control d-inline"
                            style="width: 3vw" />

                        hr

                        <input
                            type="number"
                            name="dur_min"
                            value="<?php echo explode(' ', $row["duration"])[2]; ?>"
                            class="form-control d-inline"
                            style="width: 3vw" />

                        min

                    </div>

                </div>


                <!-- Input field for movie language -->
                <div class="mb-3">

                    <label class="form-label">Language</label>

                    <input
                        type="text"
                        name="lang"
                        value="<?php echo $row["language"]; ?>"
                        class="form-control" />

                </div>


                <!-- Input field for movie age rating -->
                <div class="mb-3">

                    <label class="form-label">Age Rating</label>

                    <input
                        type="text"
                        name="age"
                        value="<?php echo $row["age_rating"]; ?>"
                        class="form-control" />

                </div>


                <!-- Input field for movie poster -->
                <div class="mb-3">

                    <label class="form-label">Poster</label>

                    <input
                        type="file"
                        name="poster"
                        class="form-control" />

                </div>


                <!-- Input field for movie trailer -->
                <div class="mb-3">

                    <label class="form-label">Trailer (YouTube Link)</label>

                    <input
                        type="text"
                        name="trailer"
                        value="https://www.youtube.com/watch?v=<?php echo $row["trailer"]; ?>"
                        class="form-control" />

                </div>


                <!-- Submit button to update movie -->
                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary">

                    Submit

                </button>

            </form>

            <?php
            // Function to update movie details when the form is submitted
            editmovie($_GET["id"]);
            ?>

        </div>

    </main>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>

</html>