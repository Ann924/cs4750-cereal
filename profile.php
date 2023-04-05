<?php
session_start();

require("connect_db.php");
require("user_db.php");

$user_email = null;

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $user_email = get_user_email($_SESSION['user_name']);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="project">
    <title>
        Cereal
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php
    include "common_navbar.php";
    ?>
    <div class="container-fluid mx-auto">
        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <div class="card col-md-10 d-flex border border-dark bg-light">
                <h3 class="row mt-3 justify-content-center text-center">Information</h3>
                <div class="row card mx-3 my-3 justify-content-center font-weight-bold">
                    <div class="row card-body">
                        <div class="col">
                            <div class="row">Username:
                                <?php echo $_SESSION['user_name']; ?>
                            </div>
                            <div class="row">Email:
                                <?php echo $user_email; ?>
                            </div>
                            <div class="row">Date Joined: PLACEHOLDER</div>
                        </div>
                        <div class="col">
                            <div class="row">From: PLACEHOLDER</div>
                            <div class="row">Favorite Cereal: PLACEHOLDER</div>
                            <div class="row">Fun Fact: PLACEHOLDER</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <div class="card col-md-10 d-flex border border-dark bg-light">
                <h3 class="row mt-3 justify-content-center text-center">Bookmarks</h3>
                <div class="row card mx-3 my-3 justify-content-center font-weight-bold">
                    <div class="card-body">
                        PLACEHOLDER
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <div class="card col-md-10 d-flex border border-dark bg-light">
                <h3 class="row mt-3 justify-content-center text-center">Clubs</h3>
                <div class="row card mx-3 my-3 justify-content-center font-weight-bold">
                    <div class="card-body">
                        PLACEHOLDER
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>