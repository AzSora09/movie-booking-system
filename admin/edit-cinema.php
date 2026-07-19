<?php
// Import shared functions and database connection for admin pages
include("./adminrequired.php");

// Import file that contains cinema related functions
include("./logics/cinemas.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    // Use head function to add title and required assets for the page
    head("Edit Cinema");
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

            <h2>Edit Cinema</h2>

            <?php
            // Fetch cinema details from the database
            $result = selectdata("cinemas", $_GET["id"]);
            $row = mysqli_fetch_assoc($result);
            ?>

            <!-- Start of the form to edit cinema details -->
            <form action="" method="post">

                <!-- Input field for cinema name -->
                <div class="mb-3">

                    <label class="form-label">Cinema Name</label>

                    <input
                        type="text"
                        name="name"
                        value="<?php echo $row["name"] ?>"
                        class="form-control"
                        required />

                </div>


                <!-- Input field for cinema location -->
                <div class="mb-3">

                    <label class="form-label">Cinema Location</label>

                    <textarea
                        name="location"
                        class="form-control"
                        rows="2"
                        maxlength="255"
                        required><?php echo $row["location"] ?></textarea>

                </div>


                <!-- Submit button to update cinema -->
                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary">

                    Submit

                </button>

            </form>

            <?php
            // Function to update cinema details when the form is submitted
            editcinema($_GET["id"]);
            ?>

        </div>

    </main>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>

</html>