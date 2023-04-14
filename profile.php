<?php
session_start();

require_once("connect_db.php");
require_once("user_db.php");
require_once("cereal_db.php");
require_once("club_db.php");

$user_email = null;
$user_bookmarks = null;
$user_clubs = null;

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $user_email = get_user_email($_SESSION['user_name']);
    $user_bookmarks = get_all_bookmarks();
    $user_clubs = get_clubs_by_user($_SESSION["user_name"]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['editBtn']) && ($_POST['editBtn'] == "Edit Bookmark")) {
        update_bookmark_serving($_POST['cereal_id'], $_POST['personalized_serving_size']);
    }

    echo "post request";
    echo $_POST['club_id'];
    // if incoming request is a post request and the form is the join club form
    // if (!empty($_POST['join_club_btn'])) { how do i check this?
    //     echo "join club";
    $isSuccess = leave_club($_SESSION["user_name"], $_POST['club_id']);
    if ($isSuccess) {
        echo "Congratulations, you have left club:";
        echo $_POST['club_id'];
        // header("Location: index.php");
        $user_clubs = get_clubs_by_user($_SESSION["user_name"]);
    } else {
        echo "There was an error leaving the club";
    }
    // }

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
                                    <div class="col-1">
                                        <i type="button" class="far fa-bookmark" data-toggle="modal"
                                            data-target="#bookmarkModal<?php echo $bookmark['cereal_id'] ?>"></i>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div>
                                        <?php echo get_cereal_nutrition($bookmark['cereal_id'])['calories'] * $bookmark['personalized_serving_size'] / get_cereal_nutrition($bookmark['cereal_id'])['serving_size'] ?>
                                        cal /
                                        personal serving
                                    </div>
                                    <div> Personalized serving size:
                                        <?php echo get_bookmark($bookmark['cereal_id'])["personalized_serving_size"]; ?> oz.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form name="cereal<?php echo $bookmark['cereal_id']; ?>" action="cereal.php" method="post">
                        <input type="hidden" name="cereal_id" value="<?php echo $bookmark['cereal_id']; ?>" />
                    </form>
                    <form name="bookmark<?php echo $bookmark['cereal_id']; ?>" action="profile.php" method="POST">
                        <input type="hidden" name="cereal_id" value="<?php echo $bookmark['cereal_id']; ?>" />
                        <div class="modal fade" id="bookmarkModal<?php echo $bookmark['cereal_id'] ?>" tabindex="-1"
                            role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Bookmark
                                            <?php echo $bookmark['name']; ?>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Personalized Serving Size: </label>
                                        <input name="personalized_serving_size"
                                            value="<?php echo get_bookmark($bookmark['cereal_id'])["personalized_serving_size"]; ?>" />
                                        oz.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="editBtn" value="Edit Bookmark"
                                            class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endforeach ?>
            </div>
        </div>

        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <div class="card col-md-10 d-flex border border-dark bg-light">
                <h3 class="row mt-3 justify-content-center text-center">Clubs</h3>
                <?php
                global $user_clubs; foreach ($user_clubs as $club): ?>
                    <div class="row card mx-3 my-3 justify-content-center font-weight-bold">
                        <div class="card-body row">
                            <div class="d-flex card-title row text-center">
                                <a href="#" onclick="document.forms['club<?php echo $club['club_id'] ?>'].submit();">
                                    <h3>
                                        <?php echo $club['club_title'] ?>
                                    </h3>
                                </a>
                            </div>
                            <div class="row">
                                <h5>
                                    <?php echo $club['club_description'] ?>
                                </h5>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-2 justify-content-end">
                                    <div class="row justify-content-end">
                                        <p class="col justify-content-end">
                                            <?php echo $club['num_members'] ?> members
                                        </p>
                                        <p class="col justify-content-end">
                                            <?php echo $club['club_score'] ?> points
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button class="btn btn-primary" name="leave_club_btn"
                                    onclick="document.forms['leave_club<?php echo $club['club_id'] ?>'].submit();">
                                    <h5>
                                        Leave
                                        <?php echo $club['club_title'] ?>
                                    </h5>
                                </button>
                            </div>
                        </div>
                    </div>
                    <form name="leave_club<?php echo $club['club_id'] ?>" action="profile.php" method="post">
                        <input type="hidden" name="club_id" value="<?php echo $club['club_id']; ?>" />
                    </form>
                    <form name="club<?php echo $club['club_id']; ?>" action="club.php" method="post">
                        <input type="hidden" name="club_id" value="<?php echo $club['club_id']; ?>" />
                    </form>
                <?php endforeach ?>
            </div>
        </div>

    </div>
</body>

</html>