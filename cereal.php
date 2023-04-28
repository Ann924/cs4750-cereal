<?php
session_start();

$cereal_info = null;
$cereal_manufacturer = null;
$cereal_nutrition = null;
$comments = null;

require("connect_db.php");
require("cereal_db.php");
require("comment_db.php");

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $cereal_info = get_cereal_info($_POST['cereal_id']);
    $cereal_manufacturer = get_cereal_manufacturer($cereal_info['name']);
    $cereal_nutrition = get_cereal_nutrition($_POST['cereal_id']);
    $comments = get_all_comments($_POST['cereal_id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['createBtn']) && ($_POST['createBtn'] == "Add Comment")) {
        // gets current date
        $date = date('Y-m-d');
        $success = add_comment($_POST['cereal_id'], $_POST['comment_text'], $date);
        if (!$success) {
            echo "Failed to add new comment: you cannot submit more than one comment per cereal.";
        }
        $comments = get_all_comments($_POST['cereal_id']);
    }

    if (!empty($_POST['editCommentBtn']) && ($_POST['editCommentBtn'] == "Edit Comment")) {
        // gets current date
        $date = date('Y-m-d');

        update_comment($_POST['cereal_id'], $_POST['comment_id'], $_POST['text'], $date);
        $comments = get_all_comments($_POST['cereal_id']);
    }

    if (!empty($_POST['deleteCommentBtn']) && ($_POST['deleteCommentBtn'] == "Delete Comment")) {
        delete_comment($_POST['cereal_id'], $_POST['comment_id']);
        $comments = get_all_comments($_POST['cereal_id']);
    }
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
            <div class="card col-md-8 border border-dark bg-light">
                <div class="card-body">
                    <h2 class="text-center" style="text-transform: uppercase;">
                        <?php echo $cereal_info['name'] ?>
                    </h2>
                    <hr>
                    <div class="row">
                        <h5>Manufacturer:
                            <?php echo $cereal_manufacturer['manufacturer'] ?>
                            </h4>
                    </div>
                    <div class="row">
                        <h5>Type:
                            <?php echo $cereal_info['type'] ?>
                            </h4>
                    </div>
                    <br>
                    <div class="row">
                        <h5>Nutritional Statement</h5>
                        <div class="col px-5 bg-white">
                            <div class="row">Serving size:
                                <?php echo $cereal_nutrition['serving_size'] ?> oz.
                            </div>
                            <div class="row">Calories:
                                <?php echo $cereal_nutrition['calories'] ?> cal
                            </div>
                            <div class="row">Protein:
                                <?php echo $cereal_nutrition['protein'] ?> g
                            </div>
                            <div class="row">Fat:
                                <?php echo $cereal_nutrition['fat'] ?> g
                            </div>
                            <div class="row">Sodium:
                                <?php echo $cereal_nutrition['sodium'] ?> mg
                            </div>
                            <div class="row">Fiber:
                                <?php echo $cereal_nutrition['fiber'] ?> g
                            </div>
                            <div class="row">Carbohydrate:
                                <?php echo $cereal_nutrition['carbohydrate'] ?> g
                            </div>
                            <div class="row">Sugars:
                                <?php echo $cereal_nutrition['sugars'] ?> g
                            </div>
                            <div class="row">Potassium:
                                <?php echo $cereal_nutrition['potassium'] ?> mg
                            </div>
                            <div class="row">Vitamins:
                                <?php echo $cereal_nutrition['vitamins'] ?> %
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <div class="card col-md-8 border border-dark bg-light mb-5">
                <h3 class="text-center mt-3" style="text-transform: uppercase;">Comments</h3>
                <hr>
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <form action="cereal.php" method="post">
                            <input id="comment_text" name="comment_text" placeholder="Enter comment here" maxlength=150
                                size=100 />
                            <input type="hidden" name="cereal_id" value="<?php echo $cereal_info['cereal_id']; ?>" />
                            <input type="submit" class="btn border" name="createBtn" value="Add Comment"
                                title="Add Comment" style="background-color:white;" />
                        </form>
                    </div>
                </div>
                <?php if (!$comments): ?>
                    <p class="text-center my-3">No comments found - get us started by sharing your thoughts!</p>
                <?php endif; ?>
                <?php
                global $comments;
                foreach ($comments as $comment): ?>
                    <div class="row align-items-center">
                        <div class="col-1">
                            <div class="row"><i class="d-flex justify-content-center far fa-user-circle"
                                    style='font-size:48px;'></i></div>
                            <div class="row">
                                <p class="d-flex justify-content-center">
                                    <?php echo $comment['user_name'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row align-items-center card mt-3 mb-3 mx-3 justify-content-center font-weight-bold">
                                <div class="card-body">
                                    <p>
                                        <?php echo $comment['text'] ?>
                                    </p>
                                    <?php if($_SESSION['user_name'] == $comment['user_name']): ?>
                                        <div class="card-title row mb-2 d-flex justify-content-end">
                                            <div class="col-1">
                                            <i type="button" class="fas fa-edit" data-toggle="modal"
                                                data-target="#editCommentModal<?php echo $comment['comment_id'] ?>"></i>
                                            </div>
                                            <div class="col-1">
                                                <i type="button" class="fa fa-trash" data-toggle="modal"
                                                    data-target="#deleteCommentModal<?php echo $comment['comment_id'] ?>"></i>
                                            </div>
                                        </div>

                                        <form name="editComment<?php echo $comment['comment_id']; ?>" action="cereal.php" method="POST">
                                            <input type="hidden" name="cereal_id" value="<?php echo $comment['cereal_id']; ?>" />
                                            <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>" />
                                            <div class="modal fade" id="editCommentModal<?php echo $comment['comment_id'] ?>" tabindex="-1"
                                                role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                Edit Comment
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <textarea name="text" rows="3" cols="40"><?php echo $comment['text'] ?></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="editCommentBtn" value="Edit Comment"
                                                                class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <form name="deleteComment<?php echo $comment['comment_id']; ?>" action="cereal.php" method="POST">
                                            <input type="hidden" name="cereal_id" value="<?php echo $comment['cereal_id']; ?>" />
                                            <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>" />
                                            <div class="modal fade" id="deleteCommentModal<?php echo $comment['comment_id'] ?>" tabindex="-1"
                                                role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                Are you sure you want to delete the following comment?
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <p><?php echo $comment['text'] ?></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="deleteCommentBtn" value="Delete Comment"
                                                            class="btn btn-danger">Yes</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>