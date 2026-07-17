<?php
include("./adminrequired.php");
// Load shared admin utilities and ticket-related helpers
include("./logics/schedules.php");
// Note: delete-id handling present (removes schedules) — keep as admin action
if (isset($_GET["delete-id"])) {
    deletedata("schedules", $_GET["delete-id"]);
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("View Tickets");
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
                            <th scope="col">User</th>
                            <th scope="col">Schedule ID</th>
                            <th scope="col">Class</th>
                            <th scope="col">Ticket amount</th>
                            <th scope="col">Children amount</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Ticket Date_Time</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        // Fetch all tickets and render each row in the table
                        $result = selectdata("tickets");
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td scope="row"><?php echo $row["id"] ?></td>

                                <td><?php echo getvalue("accounts", "email", $row["user_id"]) ?></td>

                                <td><?php echo $row["schedule_id"] ?></td>

                                <td><?php echo $row["class_type"] ?></td>
                                <td><?php echo $row["tkt_amount"] ?></td>
                                <td><?php echo $row["children_amount"] ?></td>
                                <td><?php echo $row["total_price"] ?></td>
                                <td><?php echo $row["tkt_date_time"] ?></td>
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