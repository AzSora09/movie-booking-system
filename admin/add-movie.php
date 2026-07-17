<?php
include("./adminrequired.php");
// Admin add movie — loads admin checks and movie helpers
include("./logics/movies.php")
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("Add Movie");
    ?>
</head>

<body>
    <?php
    navbar();
    ?>


    <main>
        <div class="container mt-5">
            <h2>Add Movie</h2>
            <!-- Form to add a movie (fields correspond to movies table columns) -->
            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="" class="form-label">Movie Name</label>
                    <input
                        type="text"
                        name="name"
                        id=""
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId" />
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea
                        type="text"
                        name="desc"
                        id=""
                        class="form-control"
                        rows="6"
                        maxlength="2000"
                        placeholder=""
                        aria-describedby="helpId"></textarea>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Genre</label>
                    <input
                        type="text"
                        name="genre"
                        id=""
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId" />
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Duration</label>
                    <div>
                        <input
                            type="number"
                            name="dur_hr"
                            id=""
                            class="form-control d-inline"
                            style="width: 3vw"
                            placeholder=""
                            aria-describedby="helpId" />
                        hr
                        <input
                            type="number"
                            name="dur_min"
                            id=""
                            class="form-control d-inline"
                            style="width: 3vw"
                            placeholder=""
                            aria-describedby="helpId" />
                        min
                    </div>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Language</label>
                    <input
                        type="text"
                        name="lang"
                        id=""
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId" />
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Age Rating</label>
                    <input
                        type="text"
                        name="age"
                        id=""
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId" />
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Poster</label>
                    <input
                        type="file"
                        name="poster"
                        id=""
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId" />
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Trailer (Youtube Link)</label>
                    <input
                        type="text"
                        name="trailer"
                        id=""
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId" />
                </div>

                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary">
                    Submit
                </button>
            </form>
            <?php
                // Process add movie submission (handles upload + insert)
                addmovie();
            ?>
        </div>
    </main>


    <footer>

    </footer>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>