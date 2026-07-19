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
    head("Add Movie");
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

            <h2>Add Movie</h2>

            <!-- Start of the form to add a new movie -->
            <form action="" method="post" enctype="multipart/form-data">

                <!-- Input field for movie name -->
                <div class="mb-3">
                    <label for="" class="form-label">Movie Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        required />
                </div>

                <!-- Input field for movie description -->
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea
                        name="desc"
                        class="form-control"
                        rows="6"
                        maxlength="2000"
                        required></textarea>
                </div>

                <!-- Input field for movie genre -->
                <div class="mb-3">
                    <label for="" class="form-label">Genre</label>
                    <input
                        type="text"
                        name="genre"
                        class="form-control"
                        required />
                </div>

                <!-- Input fields for movie duration -->
                <div class="mb-3">
                    <label class="form-label">Duration</label>

                    <div>

                        <input
                            type="number"
                            name="dur_hr"
                            class="form-control d-inline"
                            style="width: 3vw"
                            required />

                        hr

                        <input
                            type="number"
                            name="dur_min"
                            class="form-control d-inline"
                            style="width: 3vw"
                            required />

                        min

                    </div>
                </div>

                <!-- Input field for movie language -->
                <div class="mb-3">
                    <label class="form-label">Language</label>
                    <input
                        type="text"
                        name="lang"
                        class="form-control"
                        required />
                </div>

                <!-- Input field for movie age rating -->
                <div class="mb-3">
                    <label class="form-label">Age Rating</label>
                    <input
                        type="text"
                        name="age"
                        class="form-control"
                        required />
                </div>

                <!-- Input field for movie poster -->
                <div class="mb-3">
                    <label class="form-label">Poster</label>
                    <input
                        type="file"
                        name="poster"
                        class="form-control"
                        required />
                </div>

                <!-- Input field for movie trailer -->
                <div class="mb-3">
                    <label class="form-label">Trailer (YouTube Link)</label>
                    <input
                        type="text"
                        name="trailer"
                        class="form-control"
                        required />
                </div>

                <!-- Submit button to add movie -->
                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary">

                    Submit

                </button>

            </form>

            <?php
            // Function to add movie to the database when the form is submitted
            addmovie();
            ?>

        </div>

    </main>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>

</html>