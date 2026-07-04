<?php
include("./adminrequired.php");
include("./logics/cinemas.php")
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("Movie Booking System");
    ?>
</head>

<body>
    <?php
    navbar();
    ?>


    <main>
        <div class="container mt-5">
            <h2>List of Cinema</h2>
            <div class="table-responsive">

                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $result = selectdata("cinemas");
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td scope="row"><?php echo $row["id"]?></td>
                                <td><?php echo $row["name"]?></td>
                                <td><?php echo $row["location"]?></td>
                                <td>
                                    <a class="btn btn-success" href="./edit-cinema.php">Edit</a>
                                    <a class="btn btn-danger" href="?delete-id=<?php echo $row["id"]?>">Delete</a>
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