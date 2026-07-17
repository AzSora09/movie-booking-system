<?php
include("./required.php");
// Booking page — loads shared setup and booking logic
include("./logics/book.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Render the shared <head> section with page title and required assets
    head("Book Tickets");
    ?>
</head>

<body>
    <?php
    // Render the site navigation bar
    navbar();
    ?>

    <main>
        <div class="container py-5" style="min-height:70vh;">


            <!-- Movie information section -->

            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <h2>
                        <?= $movie["title"] ?>
                    </h2>


                    <p class="text-muted">
                        <?= $movie["language"] ?> |
                        <?= $movie["genre"] ?>
                    </p>


                </div>

            </div>





            <!-- Cinema and schedule details -->

            <div class="card shadow-sm mb-4">

                <div class="card-body">


                    <h4>
                        <?= $cinema["name"] ?>
                    </h4>


                    <p>
                        📍 <?= $cinema["location"] ?>
                    </p>


                    <p>
                        📅 <?= $schedule["date"] ?>
                    </p>


                    <p>
                        🕒 <?= $schedule["time"] ?>
                    </p>


                </div>

            </div>





            <!-- Booking form section -->

            <div class="card shadow-sm">

                <div class="card-body">


                    <h3 class="mb-4">
                        Book Tickets
                    </h3>



                    <!-- Booking form with class, ticket count and children count -->
                    <form method="POST">



                        <!-- Class -->

                        <div class="mb-3">

                            <label class="form-label">
                                Ticket Class
                            </label>


                            <select
                                name="class_type"
                                id="class_type"
                                class="form-select"
                                onchange="calculateTotal()">


                                <option value="Box">
                                    Box - Rs. <?= $schedule["box_price"] ?>
                                </option>


                                <option value="Gold">
                                    Gold - Rs. <?= $schedule["gold_price"] ?>
                                </option>


                                <option value="Platinum">
                                    Platinum - Rs. <?= $schedule["platinum_price"] ?>
                                </option>


                            </select>


                        </div>





                        <!-- Ticket Amount -->

                        <div class="mb-3">

                            <label class="form-label">
                                Number of Tickets
                            </label>


                            <input
                                type="number"
                                name="tkt_amount"
                                id="tkt_amount"
                                class="form-control"
                                min="1"
                                value="1"
                                oninput="calculateTotal()">


                        </div>





                        <!-- Children -->

                        <div class="mb-3">

                            <label class="form-label">

                                Children Tickets
                                <small class="text-muted">
                                    (Age 3-12)
                                </small>

                            </label>


                            <input
                                type="number"
                                name="children_amount"
                                id="children_amount"
                                class="form-control"
                                min="0"
                                value="0"
                                oninput="calculateTotal()">



                        </div>





                        <!-- Total -->

                        <div class="alert alert-danger">

                            <h4 class="mb-0">

                                Total:
                                <span id="total_price">
                                    Rs. 0
                                </span>


                            </h4>


                        </div>





                        <button
                            type="submit"
                            name="book"
                            class="btn btn-danger w-100">


                            Confirm Booking


                        </button>



                    </form>


                </div>


            </div>


        </div>
    </main>


    <?php
    footer();
    ?>

    <!-- Bootstrap JS -->
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

    <script>
        let prices = {

            Box: <?= $schedule["box_price"] ?>,

            Gold: <?= $schedule["gold_price"] ?>,

            Platinum: <?= $schedule["platinum_price"] ?>

        };
    </script>

    <script src="./js/bookings.js"></script>
</body>

</html>