<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'movie-booking-system');

function alertjs($content){
    echo "<script> alert(" . json_encode($content) . ") </script>";
}


function head($title)
{
?>
    <title><?php echo $title; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <!-- JQuery -->
    <script src="./jquery-3.7.1.js"></script>
<?php
}
?>

<?php
function navbar()
{ ?>
    <header>
        <nav
            class="navbar navbar-expand-sm navbar-light bg-danger">
            <div class="container">
                <a class="navbar-brand" href="./index.php">ShowRadar</a>
                <button
                    class="navbar-toggler d-lg-none order-first"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="d-flex">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0 order-first order-md-last">
                        <?php
                        if (
                            isset($_SESSION["user_name"])
                        ) {
                        ?>
                            <li class="nav-item">
                                <span class="nav-link">
                                    <?php echo $_SESSION["user_name"]; ?>
                                </span>
                            </li>
                        <?php } else {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./login.php" aria-current="page">Log In</a>
                            </li>
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link" href="./register.php">Sign In</a>
                            </li>
                        <?php } ?>

                    </ul>

                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="./index.php" aria-current="page">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Movies</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Cinemas</a>
                            </li>
                            <?php
                            if (
                                isset($_SESSION["user_name"])
                            ) {
                                if ($_SESSION["user_role"] = "admin") { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="./admin/index.php">Admin</a>
                                    </li>
                            <?php }
                            }
                            ?>


                        </ul>

                        <form class="d-flex my-2 my-lg-0">
                            <input
                                class="form-control me-sm-2"
                                type="text"
                                placeholder="Search" />
                            <button
                                class="btn btn-outline-light my-2 my-sm-0"
                                type="submit">
                                Search
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>
<?php }
?>

<?php
function register()
{
    if (isset($_POST['submit'])) {
        global $conn;
        $f_name = $_POST['f-name'];
        $l_name = $_POST['l-name'];
        $email = $_POST['email'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

        if (
            mysqli_query($conn, "insert into accounts (`first_name`, `last_name`, `email`, `password`, `role`) values('$f_name', '$l_name', '$email', '$pass', 'user')")
        ) {
            header("Location: ./login.php");
            exit;
        }
    }
}

function login()
{
    if (isset($_POST['submit'])) {
        global $conn;
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $query = mysqli_query($conn, "select * from accounts where email='$email'");

        if (
            mysqli_num_rows($query) > 0
        ) {
            $col = mysqli_fetch_array($query);

            if (
                password_verify($pass, $col['password'])
            ) {
                $_SESSION["user_name"] = $col['first_name'] . " " . $col['last_name'];
                $_SESSION["user_role"] = $col['role'];
                header("Location: ./index.php");
                exit;
            } else {
                alertjs('Password Incorrect');
            }
        } else {
            alertjs('Account not found');
        }
    }
}
?>