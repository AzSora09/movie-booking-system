<?php
include("./adminrequired.php");
// Load shared admin utilities and movie data helpers
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("View Users");
    ?>
</head>

<body>
    <?php
    navbar();
    ?>


    <main>
        <div class="container-fluid text-center">
            <h2 class="my-4">Users</h2>
            <div class="table-responsive mx-2">

                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        // Fetch all users and render each row in the table
                        $result = selectdata("accounts");
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td scope="row"><?php echo $row["id"] ?></td>
                                <td><?php echo $row["first_name"] ?></td>
                                <td><?php echo $row["last_name"] ?></td>
                                <td><?php echo $row["email"] ?></td>
                                <td><?php echo $row["role"] ?></td>
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