<?php
// Import shared functions and database connection for admin pages
include("./adminrequired.php");

// Import file that contains schedule related functions
include("./logics/schedules.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("Add Schedule");
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

            <h2>Add Schedule</h2>

            <!-- Start of the form to add a new schedule -->
            <form action="" method="post">

                <!-- Select movie from the movie list -->
                <div class="mb-3">

                    <label class="form-label">Select Movie</label>

                    <select class="form-control" name="movie">

                        <?php
                        // Fetch all movies from the database
                        $movies = selectdata("movies");

                        foreach ($movies as $movie) {
                            echo "<option value='{$movie['id']}'>{$movie['title']}</option>";
                        }
                        ?>

                    </select>

                </div>


                <!-- Select cinema from the cinema list -->
                <div class="mb-3">

                    <label class="form-label">Select Cinema</label>

                    <select class="form-control" name="cinema">

                        <?php
                        // Fetch all cinemas from the database
                        $cinemas = selectdata("cinemas");

                        foreach ($cinemas as $cinema) {
                            echo "<option value='{$cinema['id']}'>{$cinema['name']}</option>";
                        }
                        ?>

                    </select>

                </div>


                <!-- Input field for schedule date -->
                <div class="mb-3">

                    <label class="form-label">Select Date</label>

                    <input
                        type="date"
                        name="date"
                        class="form-control">

                </div>


                <!-- Input field for schedule time -->
                <div class="mb-3">

                    <label class="form-label">Select Time</label>

                    <input
                        type="time"
                        name="time"
                        class="form-control">

                </div>


                <!-- Input fields for ticket prices -->
                <div class="mb-3">

                    <label class="form-label">Select Prices</label>

                    <table>

                        <thead>

                            <tr>

                                <th>Box Price</th>
                                <th>Gold Price</th>
                                <th>Platinum Price</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>
                                    <input
                                        type="number"
                                        name="b_price"
                                        class="form-control">
                                </td>

                                <td>
                                    <input
                                        type="number"
                                        name="g_price"
                                        class="form-control">
                                </td>

                                <td>
                                    <input
                                        type="number"
                                        name="p_price"
                                        class="form-control">
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>


                <!-- Submit button to add schedule -->
                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary">

                    Submit

                </button>

            </form>

            <?php
            // Function to add schedule to the database when the form is submitted
            addschedule();
            ?>

        </div>

    </main>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>

</html>