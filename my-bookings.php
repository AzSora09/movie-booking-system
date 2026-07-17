<?php
include("./required.php");
// My bookings page — loads shared setup and user's bookings
include("./logics/my-bookings.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Render the shared <head> section with page title and required assets
    head("My Bookings");
    ?>
</head>

<body>
    <?php
    // Render the site navigation bar
    navbar();
    ?>

    <main>
        <div class="container py-5" style="min-height:70vh;">


            <h1 class="mb-4">
                My Bookings
            </h1>



            <?php if (mysqli_num_rows($booking_query) == 0) { ?>

                <!-- Show an empty state when the user has no bookings -->
                <div class="alert alert-warning">

                    You have no bookings yet.

                </div>



            <?php } else { ?>


                <div class="row g-4">


                    <?php // Loop through user's bookings and show details
                    while ($booking = mysqli_fetch_assoc($booking_query)) { ?>


                        <div class="col-md-6">


                            <div class="card shadow-sm h-100">


                                <div class="card-body">


                                    <h3>

                                        <?= $booking["title"] ?>

                                    </h3>


                                    <p class="text-muted">

                                        📍 <?= $booking["cinema_name"] ?>

                                    </p>



                                    <hr>


                                    <p>

                                        📅
                                        <?= $booking["date"] ?>

                                    </p>


                                    <p>

                                        🕒
                                        <?= $booking["time"] ?>

                                    </p>



                                    <p>

                                        🎟 Class:
                                        <?= $booking["class_type"] ?>

                                    </p>



                                    <p>

                                        Tickets:
                                        <?= $booking["tkt_amount"] ?>

                                        <br>


                                        Children:
                                        <?= $booking["children_amount"] ?>

                                    </p>



                                    <h5>

                                        Total:
                                        Rs.
                                        <?= $booking["total_price"] ?>

                                    </h5>



                                    <small class="text-muted">

                                        Booked on:
                                        <?= $booking["tkt_date_time"] ?>

                                    </small>



                                </div>


                            </div>


                        </div>



                    <?php } ?>


                </div>


            <?php } ?>


        </div>
    </main>


    <?php
    footer();
    ?>

    <!-- Bootstrap JS -->
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>

</html>