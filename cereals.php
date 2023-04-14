<?php
session_start();

require("connect_db.php");
require("cereal_db.php");

$cereals = null;

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $cereals = get_all_cereals();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['createBtn']) && ($_POST['createBtn'] == "Bookmark Cereal")) {
        if (!add_cereal_bookmark($_POST['cereal_id'], $_POST['personalized_serving_size'])) {
            echo "Failed to bookmark cereal: please visit your profile page to check that you have not already bookmarked it.";
        } else {
            echo "Successfully bookmarked cereal!";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="project">

    <title>Cereals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body>

    <?php
    include "common_navbar.php";
    ?>

    <div class="container-fluid">
        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <div class="row d-flex justify-content-end mt-3"><a class="col-3 btn btn-primary"
                    href="create_new_cereal.php">Create Cereal</a></div>
            <div class="row d-flex justify-content-end mt-3"><a class="col-3 btn btn-primary"
                    href="clubs.php">Browse Cereal Clubs</a></div>
            <div class="col-md-8 border border-dark bg-light mt-3">
                <?php
                global $cereals;
                foreach ($cereals as $cereal): ?>
                    <div class="row card mt-3 mb-3 mx-3 justify-content-center font-weight-bold">
                        <div class="card-body row">
                            <div class="col-4">
                                <div class="row mb-2">Display photo:</div>
                                <div class="row mb-2">Photo goes here</div>
                            </div>
                            <div class="col-8">
                                <div class="card-title row mb-2">
                                    <a class="col" href="#"
                                        onclick="document.forms['cereal<?php echo $cereal['cereal_id'] ?>'].submit();">
                                        <h3>
                                            <?php echo $cereal['name'] ?>
                                        </h3>
                                    </a>
                                    <div class="col-1">
                                        <!--a href="#"
                                            onclick="document.forms['bookmark<?php echo $cereal['cereal_id'] ?>'].submit();">
                                            <i class="far fa-bookmark"></i>
                                        </a-->
                                        <i type="button" class="far fa-bookmark" data-toggle="modal"
                                            data-target="#bookmarkModal<?php echo $cereal['cereal_id'] ?>"></i>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div>
                                        <?php echo get_cereal_nutrition($cereal['cereal_id'])['calories'] ?> cal /
                                        serving
                                    </div>
                                    <div> Serving size:
                                        <?php echo get_cereal_nutrition($cereal['cereal_id'])['serving_size'] ?> oz.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form name="cereal<?php echo $cereal['cereal_id']; ?>" action="cereal.php" method="post">
                        <input type="hidden" name="cereal_id" value="<?php echo $cereal['cereal_id']; ?>" />
                    </form>
                    <form name="bookmark<?php echo $cereal['cereal_id']; ?>" action="cereals.php" method="POST">
                        <input type="hidden" name="cereal_id" value="<?php echo $cereal['cereal_id']; ?>" />
                        <div class="modal fade" id="bookmarkModal<?php echo $cereal['cereal_id'] ?>" tabindex="-1"
                            role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Bookmark
                                            <?php echo $cereal['name']; ?>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Personalized Serving Size: </label>
                                        <input name="personalized_serving_size"
                                            value="<?php echo get_cereal_nutrition($cereal['cereal_id'])['serving_size']; ?>" />
                                        oz.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="createBtn" value="Bookmark Cereal"
                                            class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>