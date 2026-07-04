<?php
include("./adminrequired.php");
include("./logics/cinemas.php")
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("Movie Booking System");
    ?>
</head>

<body>
    <?php
    navbar();
    ?>


    <main>
        <div class="container mt-5">
            <h2>Add Cinema</h2>
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