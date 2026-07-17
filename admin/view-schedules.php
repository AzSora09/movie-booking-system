<?php
// Import shared functions and database connection for admin pages
include("./adminrequired.php");

// Import file that contains schedule related functions
include("./logics/schedules.php");

// Delete schedule from database when delete button is clicked
if (isset($_GET["delete-id"])) {

    deletedata("schedules", $_GET["delete-id"]);

}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("View Schedules");
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

            <h2 class="my-4">Schedules</h2>

            <div class="table-responsive mx-2">

                <table class="table table-primary">

                    <!-- Table Header -->
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


                    <!-- Table Body -->
                    <tbody>

                        <?php
                        // Fetch all schedules from the database
                        $result = selectdata("schedules");

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <tr>

                                <td scope="row"><?php echo $row["id"] ?></td>

                                <td>
                                    <?php echo getvalue("movies", "title", $row["movie_id"]) ?>
                                </td>

                                <td>
                                    <?php echo getvalue("cinemas", "name", $row["cinema_id"]) ?>
                                </td>

                                <td>
                                    <?php echo $row["date"] ?>
                                </td>

                                <td>
                                    <?php echo $row["time"] ?>
                                </td>

                                <td>
                                    <?php echo $row["box_price"] ?>
                                </td>

                                <td>
                                    <?php echo $row["gold_price"] ?>
                                </td>

                                <td>
                                    <?php echo $row["platinum_price"] ?>
                                </td>

                                <td>

                                    <a
                                        class="btn btn-success"
                                        href="./edit-schedules.php?id=<?php echo $row["id"] ?>">

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