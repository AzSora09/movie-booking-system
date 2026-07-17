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
    head("Add Cinema");
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
            <h2>Add Cinema</h2>

            <!-- Start of the form to add a new cinema -->
            <form action="" method="post">
                <!-- Input field for cinema name -->
                <div class="mb-3">
                    <label for="" class="form-label">Cinema Name</label>
                    <input
                        type="text"
                        name="name"
                        id=""
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId" />
                </div>

                <!-- Input field for cinema location -->
                <div class="mb-3">
                    <label for="" class="form-label">Cinema Location</label>
                    <textarea
                        type="text"
                        name="location"
                        id=""
                        class="form-control"
                        rows="2"
                        maxlength="255"
                        placeholder=""
                        aria-describedby="helpId"></textarea>
                </div>

                <!-- Submit button to add cinema -->
                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary">
                    Submit
                </button>
            </form>
            <?php
                // Function to add cinema to the database when the form is submitted
                addcinema();
            ?>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>