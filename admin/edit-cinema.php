<?php
include("./adminrequired.php");
// Admin edit cinema — loads cinema helpers and admin checks
include("./logics/cinemas.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("Edit Cinema");
    ?>
</head>

<body>
    <?php
    navbar();
    ?>


    <main>
        <div class="container mt-5">
            <h2>Edit Cinema</h2>
            <!-- Edit cinema form: prefilled with existing cinema details -->
            <?php
                $result = selectdata("cinemas", $_GET["id"]);
                $row = mysqli_fetch_assoc($result);
            ?>
            <form action="" method="post">

                <div class="mb-3">
                    <label for="" class="form-label">Cinema Name</label>
                    <input
                        type="text"
                        name="name"
                        value="<?php echo $row["name"]?>"
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId" />
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Cinema Location</label>
                    <textarea
                        type="text"
                        name="location"
                        class="form-control"
                        rows="2"
                        maxlength="255"
                        placeholder=""
                        aria-describedby="helpId"><?php echo $row["location"]?></textarea>
                </div>

                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary">
                    Submit
                </button>
            </form>
            <?php
                // Process cinema edit submission
                editcinema($_GET["id"]);
            ?>
        </div>
    </main>


    <footer>

    </footer>

    <!-- Bootstrap JS -->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>