<?php
include("./adminrequired.php");
// Admin edit movie — loads movie helpers and admin checks
include("./logics/movies.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("Edit Movie");
    ?>
</head>

<body>
    <?php
    navbar();
    ?>


    <main>
        <div class="container mt-5">
            <h2>Edit Movie</h2>
            <!-- Edit form: fields are prefilled; submit updates the movie -->
            <?php
            $result = selectdata("movies", $_GET["id"]);
            $row = mysqli_fetch_assoc($result);
            ?>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="" class="form-label">Movie Name</label>
                    <input
                        type="text"
                        name="name"
                        value="<?php echo $row["title"]; ?>"
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId" />
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea
                        type="text"
                        name="desc"
                        class="form-control"
                        rows="6"
                        maxlength="2000"
                        placeholder=""
                        aria-describedby="helpId"><?php echo $row["description"]; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Genre</label>
                    <input
                        type="text"
                        name="genre"
                        value="<?php echo $row["genre"]; ?>"
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
                            value="<?php echo explode(' ', $row["duration"])[0]; ?>"
                            class="form-control d-inline"
                            style="width: 3vw"
                            placeholder=""
                            aria-describedby="helpId" />
                        hr
                        <input
                            type="number"
                            name="dur_min"
                            value="<?php echo explode(' ', $row["duration"])[2]; ?>"
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
                        value="<?php echo $row["language"]; ?>"
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId" />
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Age Rating</label>
                    <input
                        type="text"
                        name="age"
                        value="<?php echo $row["age_rating"]; ?>"
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
                        value="https://www.youtube.com/watch?v=<?php echo $row["trailer"]; ?>"
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
                // Process edit submission and update the movie record
                editmovie($_GET["id"]);
            ?>
        </div>
    </main>


    <footer>

    </footer>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>