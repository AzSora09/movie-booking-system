<?php
include("./adminrequired.php");
// Load shared admin utilities and movie data helpers
include("./logics/schedules.php");
if (isset($_GET["delete-id"])) {
    deletedata("schedules", $_GET["delete-id"]);
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("View Schedules");
    ?>
</head>

<body>
    <?php
    navbar();
    ?>


    <main>
        <div class="container-fluid text-center">
            <h2 class="my-4">Schedules</h2>
            <div class="table-responsive mx-2">

                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Movie</th>
                            <th scope="col">Cinema</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Box Price</th>
                            <th scope="col">Gold Price</th>
                            <th scope="col">Platinum Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        // Fetch all schedules and render each row in the table
                        $result = selectdata("schedules");
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td scope="row"><?php echo $row["id"] ?></td>

                                <td><?php echo getvalue("movies", "title", $row["movie_id"]) ?></td>

                                <td><?php echo getvalue("cinemas", "name", $row["cinema_id"]) ?></td>

                                <td><?php echo $row["date"] ?></td>
                                <td><?php echo $row["time"] ?></td>
                                <td><?php echo $row["box_price"] ?></td>
                                <td><?php echo $row["gold_price"] ?></td>
                                <td><?php echo $row["platinum_price"] ?></td>
                                <td>
                                    <a class="btn btn-success" href="./edit-schedules.php?id=<?php echo $row["id"] ?>">Edit</a>
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