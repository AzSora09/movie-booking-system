<?php
// Import shared functions and database connection for admin pages
include("./adminrequired.php");

// Import file that contains cinema related functions
include("./logics/cinemas.php");

// Delete cinema from database when delete button is clicked
if (isset($_GET["delete-id"])) {

    deletedata("cinemas", $_GET["delete-id"]);
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("View Cinemas");
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

            <h2>List of Cinema</h2>

            <div class="table-responsive">

                <table class="table table-primary">

                    <!-- Table Header -->
                    <thead>

                        <tr>

                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Actions</th>

                        </tr>

                    </thead>

                    <!-- Table Body -->
                    <tbody>

                        <?php
                        // Fetch all cinemas from the database
                        $result = selectdata("cinemas");

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <tr>

                                <td scope="row"><?php echo $row["id"] ?></td>

                                <td><?php echo $row["name"] ?></td>

                                <td><?php echo $row["location"] ?></td>

                                <td>

                                    <a
                                        class="btn btn-success"
                                        href="./edit-cinema.php?id=<?php echo $row["id"] ?>">

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