<?php
// Import shared functions and database connection for admin pages
include("./adminrequired.php");

// Delete review from database when delete button is clicked
if (isset($_GET["delete-id"])) {

    deletedata("reviews", $_GET["delete-id"]);

}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("View Reviews");
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

            <h2 class="my-4">Reviews</h2>

            <div class="table-responsive mx-2">

                <table class="table table-primary">

                    <!-- Table Header -->
                    <thead>

                        <tr>

                            <th scope="col">ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Movie</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Review Date and Time</th>
                            <th scope="col">Actions</th>

                        </tr>

                    </thead>


                    <!-- Table Body -->
                    <tbody>

                        <?php
                        // Fetch all reviews from the database
                        $result = selectdata("reviews");

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <tr>

                                <td scope="row"><?php echo $row["id"] ?></td>

                                <td>
                                    <?php
                                    echo getvalue("accounts", "first_name", $row["user_id"]);
                                    echo " ";
                                    echo getvalue("accounts", "last_name", $row["user_id"]);
                                    ?>
                                </td>

                                <td>
                                    <?php echo getvalue("movies", "title", $row["movie_id"]) ?>
                                </td>

                                <td>
                                    <?php echo $row["rating"] ?>/5
                                </td>

                                <td>
                                    <?php echo $row["comment"] ?>
                                </td>

                                <td>
                                    <?php echo $row["review_datetime"] ?>
                                </td>

                                <td>

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