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
    head("View Tickets");
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

            <h2 class="my-4">Tickets</h2>

            <div class="table-responsive mx-2">

                <table class="table table-primary">

                    <!-- Table Header -->
                    <thead>

                        <tr>

                            <th scope="col">ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Schedule ID</th>
                            <th scope="col">Class</th>
                            <th scope="col">Ticket Amount</th>
                            <th scope="col">Children Amount</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Ticket Date_Time</th>

                        </tr>

                    </thead>


                    <!-- Table Body -->
                    <tbody>

                        <?php
                        // Fetch all tickets from the database
                        $result = selectdata("tickets");

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <tr>

                                <td scope="row">
                                    <?php echo $row["id"] ?>
                                </td>


                                <td>
                                    <?php echo getvalue("accounts", "email", $row["user_id"]) ?>
                                </td>


                                <td>
                                    <?php echo $row["schedule_id"] ?>
                                </td>


                                <td>
                                    <?php echo $row["class_type"] ?>
                                </td>


                                <td>
                                    <?php echo $row["tkt_amount"] ?>
                                </td>


                                <td>
                                    <?php echo $row["children_amount"] ?>
                                </td>


                                <td>
                                    <?php echo $row["total_price"] ?>
                                </td>


                                <td>
                                    <?php echo $row["tkt_date_time"] ?>
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