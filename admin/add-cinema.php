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
    // Use the shared head function to set the page title and include required assets
    head("Add Cinema");
    ?>
</head>

<body>
    <?php
    // Navbar
    navbar();
    ?>


    // Start of the main content
    <main>
        <div class="container mt-5">
            <h2>Add Cinema</h2>

            // Start of the form to add a new cinema
            <form action="" method="post">

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


    <footer>

    </footer>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>