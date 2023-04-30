<?php
session_start();

require_once("connect_db.php");
require_once("user_db.php");
require_once("cereal_db.php");
require_once("club_db.php");
require_once("comment_db.php");

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
    $user_cereals = get_cereals_by_user();
    $user_comments = get_comments_by_user();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['editBookmarkBtn']) && ($_POST['editBookmarkBtn'] == "Edit Bookmark")) {
        update_bookmark_serving($_POST['cereal_id'], $_POST['personalized_serving_size']);
    }

    if (!empty($_POST['deleteBookmarkBtn']) && ($_POST['deleteBookmarkBtn'] == "Delete Bookmark")) {
        delete_bookmark($_POST['cereal_id']);
        header("Location: profile.php"); // reload page so new list of bookmarks can be fetched
    }

    if (!empty($_POST['deleteCerealBtn']) && ($_POST['deleteCerealBtn'] == "Delete Cereal")) {
        delete_cereal($_POST['cereal_id']);
        header("Location: profile.php"); // reload page so new list of bookmarks can be fetched
    }

    // echo "post request";
    // echo $_POST['club_id'];
    // if incoming request is a post request and the form is the join club form
    // if (!empty($_POST['join_club_btn'])) { how do i check this?
    //     echo "join club";
    $isSuccess = leave_club($_SESSION["user_name"], $_POST['club_id']);
    if ($isSuccess) {
        // echo "Congratulations, you have left club:";
        // echo $_POST['club_id'];
        // header("Location: index.php");
        $user_clubs = get_clubs_by_user($_SESSION["user_name"]);
    } else {
        // echo "There was an error leaving the club";
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
    <!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
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
                    <div class="row card-body justify-content-center">
                        <div class="col">
                            <h4>Username:<?php echo $_SESSION['user_name']; ?></h4>
                        </div>
                        <div class="col">
                            <h4>Email:<?php echo $user_email; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <div class="card col-md-10 d-flex border border-dark bg-light">
                <h3 class="row mt-3 justify-content-center text-center">Bookmarks</h3>
                <?php if (!$user_bookmarks): ?>
                    <p class="text-center my-3">No cereals bookmarked</p>
                <?php endif; ?>
                <?php
                global $user_bookmarks;
                foreach ($user_bookmarks as $bookmark): ?>
                    <div class="row card mx-3 my-3 justify-content-center font-weight-bold">
                        <div class="card-body row">
                            <!-- <div class="col-4">
                                <div class="row mb-2">Display photo:</div>
                                <div class="row mb-2">Photo goes here</div>
                            </div> -->
                            <div class="col">
                                <div class="card-title row mb-2">
                                    <a class="col" href="#"
                                        onclick="document.forms['cereal<?php echo $bookmark['cereal_id'] ?>'].submit();">
                                        <h3>
                                            <?php echo get_cereal_info($bookmark['cereal_id'])['name'] ?>
                                        </h3>
                                    </a>
                                    <div class="col-1">
                                        <i type="button" class="fas fa-edit" data-toggle="modal"
                                            data-target="#editBookmarkModal<?php echo $bookmark['cereal_id'] ?>"></i>
                                    </div>
                                    <div class="col-1">
                                        <i type="button" class="fa fa-trash" data-toggle="modal"
                                            data-target="#deleteBookmarkModal<?php echo $bookmark['cereal_id'] ?>"></i>
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
                    <form name="editBookmark<?php echo $bookmark['cereal_id']; ?>" action="profile.php" method="POST">
                        <input type="hidden" name="cereal_id" value="<?php echo $bookmark['cereal_id']; ?>" />
                        <div class="modal fade" id="editBookmarkModal<?php echo $bookmark['cereal_id'] ?>" tabindex="-1"
                            role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Bookmark
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
                                        <button type="submit" name="editBookmarkBtn" value="Edit Bookmark"
                                            class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form name="deleteBookmark<?php echo $bookmark['cereal_id']; ?>" action="profile.php" method="POST">
                        <input type="hidden" name="cereal_id" value="<?php echo $bookmark['cereal_id']; ?>" />
                        <div class="modal fade" id="deleteBookmarkModal<?php echo $bookmark['cereal_id'] ?>" tabindex="-1"
                            role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Are you sure you want to unbookmark
                                            <?php echo $bookmark['name']; ?>?
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="deleteBookmarkBtn" value="Delete Bookmark"
                                        class="btn btn-danger">Yes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
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
                <h3 class="row mt-3 justify-content-center text-center">Created Cereals</h3>
                <?php if (!$user_cereals): ?>
                    <p class="text-center my-3">No created cereals</p>
                <?php endif; ?>
                <?php
                global $user_cereals;
                foreach ($user_cereals as $cereal): ?>
                    <div class="row card mx-3 my-3 justify-content-center font-weight-bold">
                        <div class="card-body row">
                            <!-- <div class="col-4">
                                <div class="row mb-2">Display photo:</div>
                                <div class="row mb-2">Photo goes here</div>
                            </div> -->
                            <div class="col">
                                <div class="card-title row mb-2">
                                    <a class="col" href="#"
                                        onclick="document.forms['cereal<?php echo $cereal['cereal_id'] ?>'].submit();">
                                        <h3>
                                            <?php echo get_cereal_info($cereal['cereal_id'])['name'] ?>
                                        </h3>
                                    </a>
                                    <div class="col-1">
                                        <a class="col" href="#"
                                            onclick="document.forms['edit_cereal<?php echo $cereal['cereal_id'] ?>'].submit();"
                                            style="color: rgb(64,64,64);">
                                            <i type="button" class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="col-1">
                                        <i type="button" class="fa fa-trash" data-toggle="modal"
                                            data-target="#deleteCerealModal<?php echo $cereal['cereal_id'] ?>"></i>
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

                    <form name="edit_cereal<?php echo $cereal['cereal_id']; ?>" action="edit_cereal.php" method="post">
                        <input type="hidden" name="cereal_id" value="<?php echo $cereal['cereal_id']; ?>" />
                    </form>

                    <form name="deleteCereal<?php echo $cereal['cereal_id']; ?>" action="profile.php" method="POST">
                        <input type="hidden" name="cereal_id" value="<?php echo $cereal['cereal_id']; ?>" />
                        <div class="modal fade" id="deleteCerealModal<?php echo $cereal['cereal_id'] ?>" tabindex="-1"
                            role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Are you sure you want to delete cereal
                                            <?php echo $cereal['name']; ?>?
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="deleteCerealBtn" value="Delete Cereal"
                                        class="btn btn-danger">Yes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
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
                <?php if (!$user_clubs): ?>
                    <p class="text-center my-3">No clubs joined</p>
                <?php endif; ?>
                <?php
                global $user_clubs; foreach ($user_clubs as $club): ?>
                    <div class="row card mx-3 my-3 justify-content-center font-weight-bold">
                        <div class="card-body row">
                            <div class="d-flex card-title row text-center">
                                <div class="col"></div>
                                <div class="col">
                                    <a href="#" onclick="document.forms['club<?php echo $club['club_id'] ?>'].submit();" class="text-decoration-none">
                                        <h3>
                                            <?php echo $club['club_title'] ?>
                                        </h3>
                                    </a>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-danger mx-3 d-inline-flex align-items-center" name="leave_club_btn" 
                                        onclick="document.forms['leave_club<?php echo $club['club_id'] ?>'].submit();">
                                        Leave&nbsp;&nbsp;<i class="fa fa-window-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <h5>
                                    <?php echo $club['club_description'] ?>
                                </h5>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-3 justify-content-end">
                                    <div class="row justify-content-end text-secondary">
                                        <p class="col justify-content-end">
                                            <?php echo $club['num_members'] ?> members
                                        </p>
                                        <p class="col justify-content-end">
                                            <?php echo $club['club_score'] ?> points
                                        </p>
                                    </div>
                                </div>
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

        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <div class="card col-md-10 d-flex border border-dark bg-light">
                <h3 class="row mt-3 justify-content-center text-center">Your Comments</h3>
                <?php if (!$user_comments): ?>
                    <p class="text-center my-3">No comments written</p>
                <?php endif; ?>
                <?php
                global $user_comments;
                foreach ($user_comments as $comment): ?>
                    <div class="row card mx-3 my-3 justify-content-center font-weight-bold">
                        <div class="card-body row">
                            <!-- <div class="col-4">
                                <div class="row mb-2">Display photo:</div>
                                <div class="row mb-2">Photo goes here</div>
                            </div> -->
                            <div class="col">
                                <div class="card-title row mb-2">
                                    <a class="col" href="#"
                                        onclick="document.forms['cereal<?php echo $comment['cereal_id'] ?>'].submit();">
                                        <h3>
                                            <?php echo get_cereal_info($comment['cereal_id'])['name'] ?>
                                        </h3>
                                    </a>
                                </div>
                                <div class="row mb-2">
                                    <div>
                                        <?php echo $comment['text'] ?>
                                    </div>
                                    <div>
                                        Last Updated: <?php echo $comment['date'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form name="cereal<?php echo $comment['cereal_id']; ?>" action="cereal.php" method="post">
                        <input type="hidden" name="cereal_id" value="<?php echo $comment['cereal_id']; ?>" />
                    </form>
                <?php endforeach ?>
            </div>
        </div>

    </div>
</body>

</html>