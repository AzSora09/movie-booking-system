<?php
include("./required.php");
// Show registration page and process registration submissions
register();
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    head("Register");
    ?>
</head>

<body>
    <div class="container-fluid">
        <div class="container mx-auto my-5">
            <form action="" method="post">
                <div class="mb-3">
                    <input
                        type="text"
                        name="f-name"
                        id=""
                        class="form-control d-inline w-25 mx-auto"
                        placeholder="First Name"
                        aria-describedby="helpId" />
                    <input
                        type="text"
                        name="l-name"
                        id=""
                        class="form-control d-inline w-25 mx-auto"
                        placeholder="First Name"
                        aria-describedby="helpId" />
                </div>

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
                    Register Account
                </button>
                <span class="ms-1">
                    Already have an account? <a href="./login.php">Log in</a>
                </span>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>