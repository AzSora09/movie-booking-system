<?php
// Import shared functions and database connection for user pages
include("./required.php");

// Import file that handles booking logic
include("./logics/book.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("Book Tickets");
    ?>
</head>

<body>
    <?php
    // Navbar
    navbar();
    ?>


    <main>
        <div class="container py-5" style="min-height:70vh;">


            <!-- Display selected movie information -->

            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <!-- Show movie title -->
                    <h2>
                        <?= $movie["title"] ?>
                    </h2>


                    <!-- Display movie language and genre -->
                    <p class="text-muted">
                        <?= $movie["language"] ?> |
                        <?= $movie["genre"] ?>
                    </p>


                </div>

            </div>


            <!-- Display selected cinema and show schedule information -->

            <div class="card shadow-sm mb-4">

                <div class="card-body">


                    <!-- Display cinema name -->
                    <h4>
                        <?= $cinema["name"] ?>
                    </h4>


                    <!-- Display cinema location -->
                    <p>
                        📍 <?= $cinema["location"] ?>
                    </p>


                    <!-- Display show date -->
                    <p>
                        📅 <?= $schedule["date"] ?>
                    </p>


                    <!-- Display show time -->
                    <p>
                        🕒 <?= $schedule["time"] ?>
                    </p>


                </div>

            </div>


            <!-- Ticket booking form section -->

            <div class="card shadow-sm">

                <div class="card-body">


                    <h3 class="mb-4">
                        Book Tickets
                    </h3>



                    <!-- Form for selecting ticket class and quantity -->
                    <form method="POST">


                        <!-- Ticket class selection -->

                        <div class="mb-3">

                            <label class="form-label">
                                Ticket Class
                            </label>


                            <!-- User selects seat category -->
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


                        <!-- Number of tickets input -->

                        <div class="mb-3">

                            <label class="form-label">
                                Number of Tickets
                            </label>


                            <!-- Stores total ticket quantity -->
                            <input
                                type="number"
                                name="tkt_amount"
                                id="tkt_amount"
                                class="form-control"
                                min="1"
                                value="1"
                                oninput="calculateTotal()">



                        </div>


                        <!-- Children ticket input -->

                        <div class="mb-3">

                            <label class="form-label">

                                Children Tickets
                                <small class="text-muted">
                                    (Age 3-12)
                                </small>

                            </label>


                            <!-- Stores number of discounted children tickets -->
                            <input
                                type="number"
                                name="children_amount"
                                id="children_amount"
                                class="form-control"
                                min="0"
                                value="0"
                                oninput="calculateTotal()">



                        </div>


                        <!-- Dynamic total price display -->

                        <div class="alert alert-danger">

                            <h4 class="mb-0">

                                Total:
                                <span id="total_price">
                                    Rs. 0
                                </span>


                            </h4>


                        </div>


                        <!-- Submit booking request -->

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
    // Display shared footer
    footer();
    ?>


    <!-- Bootstrap JavaScript -->
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>


    <!-- Pass schedule prices to JavaScript for live total calculation -->
    <script>
        let prices = {

            Box: <?= $schedule["box_price"] ?>,

            Gold: <?= $schedule["gold_price"] ?>,

            Platinum: <?= $schedule["platinum_price"] ?>

        };
    </script>


    <!-- Booking price calculation script -->
    <script src="./js/bookings.js"></script>

</body>

</html>