<?php
// Import shared functions and database connection for admin pages
include("./adminrequired.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("View Users");
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

            <h2 class="my-4">Users</h2>

            <div class="table-responsive mx-2">

                <table class="table table-primary">

                    <!-- Table Header -->
                    <thead>

                        <tr>

                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>

                        </tr>

                    </thead>


                    <!-- Table Body -->
                    <tbody>

                        <?php
                        // Fetch all users from the database
                        $result = selectdata("accounts");

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <tr>

                                <td scope="row">
                                    <?php echo $row["id"] ?>
                                </td>

                                <td>
                                    <?php echo $row["first_name"] ?>
                                </td>

                                <td>
                                    <?php echo $row["last_name"] ?>
                                </td>

                                <td>
                                    <?php echo $row["email"] ?>
                                </td>

                                <td>
                                    <?php echo $row["role"] ?>
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