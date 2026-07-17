<?php
// Import shared functions and database connection for admin pages
include("./adminrequired.php");

// Import file that contains movie related functions
include("./logics/movies.php");

// Delete movie from database when delete button is clicked
if (isset($_GET["delete-id"])) {

    deletedata("movies", $_GET["delete-id"]);

}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("View Movies");
    ?>
</head>

<body>
    <?php
    // Navbar
    navbar();
    ?>

    <!-- Start of the main content -->
    <main>

        <div class="container-fluid text-center">

            <h2 class="my-4">List of Movies</h2>

            <div class="table-responsive mx-2">

                <table class="table table-primary">

                    <thead>

                        <tr>

                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Language</th>
                            <th scope="col">Age Rating</th>
                            <th scope="col">Poster</th>
                            <th scope="col">Trailer</th>
                            <th scope="col">Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php
                        // Fetch all movies from the database
                        $result = selectdata("movies");

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <tr>

                                <td scope="row"><?php echo $row["id"] ?></td>

                                <td><?php echo $row["title"] ?></td>

                                <td><?php echo $row["description"] ?></td>

                                <td><?php echo $row["genre"] ?></td>

                                <td><?php echo $row["duration"] ?></td>

                                <td><?php echo $row["language"] ?></td>

                                <td><?php echo $row["age_rating"] ?></td>

                                <td>

                                    <img
                                        src="../images/<?php echo $row["poster"] ?>"
                                        alt=""
                                        class="img-fluid">

                                </td>

                                <td>

                                    <iframe
                                        src="https://www.youtube.com/embed/<?php echo $row["trailer"] ?>"
                                        frameborder="0"
                                        allowfullscreen>
                                    </iframe>

                                </td>

                                <td>

                                    <a
                                        class="btn btn-success"
                                        href="./edit-movie.php?id=<?php echo $row["id"] ?>">

                                        Edit

                                    </a>


                                    <a
                                        class="btn btn-danger"
                                        href="?delete-id=<?php echo $row["id"] ?>">

                                        Delete

                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </main>


    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>

</html>