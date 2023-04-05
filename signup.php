<?php
session_start();

require("connect_db.php");
require("user_db.php");

if ($_SESSION["loggedIn"]) {
    header("Location: cereals.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // if incoming request is a post request and the button clicked is signup
    if (!empty($_POST['signupBtn'] && ($_POST['signupBtn'] == "Sign up"))) {

        $isSuccess = add_user_validation($_POST['email'], $_POST['password']);
        if ($isSuccess) {
            $isSuccess = add_user_information($_POST['username'], $_POST['email']);
        }

        if ($isSuccess) {
            echo "Congratulations, you are now logged in!";
            header("Location: cereals.php");
        } else {
            echo "There was an error logging in: please ensure your email and username are unique!";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lilian Zhang">
    <meta name="description" content="project">

    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php
    include "common_navbar.php";
    ?>
    <div class="container-fluid">
        <div class="row mt-5 d-flex justify-content-center align-items-center">
            <div class="col-md-6 border border-dark bg-light">
                <div class="row mt-3 mb-3 mx-3 justify-content-center font-weight-bold">
                    <h2 class="text-center">Sign up</h2>
                    <i class="text-center text-secondary">Embark on your cereal journey today</i>
                </div>
                <form action="signup.php" method="post">
                    <div class="row mb-3 mx-3">
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" required>
                    </div>
                    <div class="row mb-3 mx-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="username"
                            required>
                    </div>
                    <div class="row mb-3 mx-3">
                        <input type="text" class="form-control" id="password" name="password" placeholder="password"
                            required>
                    </div>
                    <div class="row mb-3 mx-3 justify-content-center">
                        <div class="col-8">
                            <div class="row">
                                <input type="submit" class="btn btn-primary" name="signupBtn" value="Sign up"
                                    title="signup" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>