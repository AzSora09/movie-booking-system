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
    head("Edit Schedule");
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

            <h2>Edit Schedule</h2>

            <?php
            // Fetch schedule details from the database
            $result = selectdata("schedules", $_GET["id"]);
            $row = mysqli_fetch_assoc($result);
            ?>

            <!-- Start of the form to edit schedule details -->
            <form action="" method="post">

                <!-- Select movie from the movie list -->
                <div class="mb-3">

                    <label class="form-label">Select Movie</label>

                    <select class="form-control" name="movie">

                        <?php
                        // Display the selected movie
                        $movie_name = getvalue("movies", "title", $row["movie_id"]);
                        echo "<option value='{$row["movie_id"]}' selected>{$movie_name}</option>";

                        // Fetch all movies from the database
                        $movies = selectdata("movies");

                        while ($movie = mysqli_fetch_assoc($movies)) {

                            if ($movie['id'] != $row["movie_id"]) {

                                echo "<option value='{$movie['id']}'>{$movie['title']}</option>";

                            }

                        }
                        ?>

                    </select>

                </div>


                <!-- Select cinema from the cinema list -->
                <div class="mb-3">

                    <label class="form-label">Select Cinema</label>

                    <select class="form-control" name="cinema">

                        <?php
                        // Display the selected cinema
                        $cinema_name = getvalue("cinemas", "name", $row["cinema_id"]);
                        echo "<option value='{$row["cinema_id"]}' selected>{$cinema_name}</option>";

                        // Fetch all cinemas from the database
                        $cinemas = selectdata("cinemas");

                        while ($cinema = mysqli_fetch_assoc($cinemas)) {

                            if ($cinema['id'] != $row["cinema_id"]) {

                                echo "<option value='{$cinema['id']}'>{$cinema['name']}</option>";

                            }

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
                        class="form-control"
                        value="<?php echo $row['date']; ?>">

                </div>


                <!-- Input field for schedule time -->
                <div class="mb-3">

                    <label class="form-label">Select Time</label>

                    <input
                        type="time"
                        name="time"
                        class="form-control"
                        value="<?php echo $row['time']; ?>">

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
                                        class="form-control"
                                        value="<?php echo $row['box_price']; ?>">
                                </td>

                                <td>
                                    <input
                                        type="number"
                                        name="g_price"
                                        class="form-control"
                                        value="<?php echo $row['gold_price']; ?>">
                                </td>

                                <td>
                                    <input
                                        type="number"
                                        name="p_price"
                                        class="form-control"
                                        value="<?php echo $row['platinum_price']; ?>">
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>


                <!-- Submit button to update schedule -->
                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary">

                    Submit

                </button>

            </form>

            <?php
            // Function to update schedule details when the form is submitted
            editschedule();
            ?>

        </div>

    </main>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>

</html>