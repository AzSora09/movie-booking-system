<?php
include("./adminrequired.php");
// Load schedule-related helper functions for adding schedules
include("./logics/schedules.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("Edit Schedule");
    ?>
</head>

<body>
    <?php
    navbar();
    ?>


    <main>
        <div class="container mt-5">
            <h2>Edit Schedule</h2>
            <!-- Edit schedule form: choose movie, cinema, date/time and prices -->
            <?php
            $result = selectdata("schedules");
            $row = mysqli_fetch_assoc($result);
            ?>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Select Movie</label>
                    <select class="form-control" name="movie">
                        <?php

                        $movie_name = getvalue("movies", "title", $row["movie_id"]);
                        echo "<option value='{$row["movie_id"]}' selected>{$movie_name}</option>";

                        $movies = selectdata("movies");
                        while ($movie = mysqli_fetch_assoc($movies)) {

                            if ($movie['id'] != $row["movie_id"]) {

                                echo "<option value='{$movie['id']}'>{$movie['title']}</option>";

                            }
                            
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Select Cinema</label>
                    <select class="form-control" name="cinema">
                        <?php
                        $cinema_name = getvalue("cinemas", "name", $row["cinema_id"]);
                        echo "<option value='{$row["cinema_id"]}' selected>{$cinema_name}</option>";

                        $cinemas = selectdata("cinemas");
                        while ($cinema = mysqli_fetch_assoc($cinemas)) {
                            if ($cinema['id'] != $row["cinema_id"]) {
                                echo "<option value='{$cinema['id']}'>{$cinema['name']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Select Date</label>
                    <input type="date" name="date" class="form-control" value="<?php echo $row['date']; ?>">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Select Time</label>
                    <input type="time" name="time" class="form-control" value="<?php echo $row['time']; ?>">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Select Prices</label>
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
                                <td><input type="number" name="b_price" class="form-control" value="<?php echo $row['box_price']; ?>"></td>
                                <td><input type="number" name="g_price" class="form-control" value="<?php echo $row['gold_price']; ?>"></td>
                                <td><input type="number" name="p_price" class="form-control" value="<?php echo $row['platinum_price']; ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary">
                    Submit
                </button>

            </form>
            <?php
                // Process schedule edit when form is submitted
                editschedule();
            ?>
        </div>
    </main>


    <footer>

    </footer>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>