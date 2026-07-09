<?php
include("./adminrequired.php");
// Load schedule-related helper functions for adding schedules
include("./logics/schedules.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("Add Schedule");
    ?>
</head>

<body>
    <?php
    navbar();
    ?>


    <main>
        <div class="container mt-5">
            <h2>Add Schedule</h2>
            <form action="" method="post">

                <div class="mb-3">
                    <label for="" class="form-label">Select Movie</label>
                    <select class="form-control" name="movie">
                        <?php
                        $movies = selectdata("movies");
                        foreach ($movies as $movie) {
                            echo "<option value='{$movie['id']}'>{$movie['title']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Select Cinema</label>
                    <select class="form-control" name="cinema">
                        <?php
                        $cinemas = selectdata("cinemas");
                        foreach ($cinemas as $cinema) {
                            echo "<option value='{$cinema['id']}'>{$cinema['name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Select Date</label>
                    <input type="date" name="date" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Select Time</label>
                    <input type="time" name="time" class="form-control">
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
                                <td><input type="number" name="b_price" class="form-control"></td>
                                <td><input type="number" name="g_price" class="form-control"></td>
                                <td><input type="number" name="p_price" class="form-control"></td>
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
            addschedule();
            ?>
        </div>
    </main>


    <footer>

    </footer>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>