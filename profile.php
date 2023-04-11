<?php
session_start();

require("connect_db.php");
require("user_db.php");
require("cereal_db.php");

$user_email = null;
$user_bookmarks = null;

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $user_email = get_user_email($_SESSION['user_name']);
    $user_bookmarks = get_all_bookmarks();
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
    <div class="container-fluid mx-auto mb-5">
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
                <?php
                global $user_bookmarks;
                foreach ($user_bookmarks as $bookmark): ?>
                    <div class="row card mx-3 my-3 justify-content-center font-weight-bold">
                        <div class="card-body row">
                            <div class="col-4">
                                <div class="row mb-2">Display photo:</div>
                                <div class="row mb-2">Photo goes here</div>
                            </div>
                            <div class="col-8">
                                <div class="card-title row mb-2">
                                    <a class="col" href="#"
                                        onclick="document.forms['cereal<?php echo $bookmark['cereal_id'] ?>'].submit();">
                                        <h3>
                                            <?php echo get_cereal_info($bookmark['cereal_id'])['name'] ?>
                                        </h3>
                                    </a>
                                </div>
                                <div class="row mb-2">
                                    <div>
                                        <?php echo get_cereal_nutrition($bookmark['cereal_id'])['calories']*$bookmark['personalized_serving_size']/get_cereal_nutrition($bookmark['cereal_id'])['serving_size'] ?> cal /
                                        personal serving
                                    </div>
                                    <div> Personalized serving size:
                                        <?php echo $bookmark['personalized_serving_size'] ?> oz.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form name="cereal<?php echo $bookmark['cereal_id']; ?>" action="cereal.php" method="post">
                        <input type="hidden" name="cereal_id" value="<?php echo $bookmark['cereal_id']; ?>" />
                    </form>
                <?php endforeach ?>
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