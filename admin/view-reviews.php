<?php
include("./adminrequired.php");
// Load shared admin utilities and movie data helpers
if(isset($_GET["delete-id"])) {
    $id = $_GET["delete-id"];
    deletedata("reviews", $id);
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("View Reviews");
    ?>
</head>

<body>
    <?php
    navbar();
    ?>


    <main>
        <div class="container-fluid text-center">
            <h2 class="my-4">Reviews</h2>
            <div class="table-responsive mx-2">

                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Movie</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Review date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        // Fetch all reviews and render each row in the table
                        $result = selectdata("reviews");
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td scope="row"><?php echo $row["id"] ?></td>
                                <td><?php echo getvalue("accounts", "first_name, last_name", $row["user_id"]) ?></td>
                                <td><?php echo getvalue("movies", "title", $row["movie_id"]) ?></td>
                                <td><?php echo $row["rating"] ?>/5</td>
                                <td><?php echo $row["comment"] ?></td>
                                <td><?php echo $row["review_date"] ?></td>
                                <td>
                                    <img src="../images/<?php echo $row["poster"] ?>" alt="" class="img-fluid">
                                </td>
                                <td>
                                    <iframe src="https://www.youtube.com/embed/<?php echo $row["trailer"] ?>" frameborder="0" allowfullscreen></iframe>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="?delete-id=<?php echo $row["id"] ?>">Delete</a>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>

                </table>

            </div>

        </div>
    </main>


    <footer>

    </footer>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>