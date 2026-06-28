<?php
include("./required.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("Login");
    ?>
</head>

<body>
    <div class="container-fluid">
        <div class="container mx-auto my-5">
            <form action="" method="post">
                <div class="mb-3">
                    <input
                        type="email"
                        class="form-control w-50"
                        name="email"
                        id=""
                        aria-describedby="emailHelpId"
                        placeholder="E-Mail" />
                </div>

                <div class="mb-3">
                    <input
                        type="password"
                        class="form-control w-50"
                        name="pass"
                        id=""
                        placeholder="Password" />
                </div>

                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary">
                    Log in
                </button>
                <span class="ms-1">
                    Don't have an account? <a href="./register.php">Register account</a>
                </span>
            </form>
            <?php
            login();
            ?>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>