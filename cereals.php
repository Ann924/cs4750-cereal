<?php
session_start();

require("connect_db.php");
require("cereal_db.php");
require("sorting_cereals_db.php");

$cereals = null;
$sort_description = "None";

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $cereals = get_all_cereals();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['createBtn']) && ($_POST['createBtn'] == "Bookmark Cereal")) {
        if (!add_cereal_bookmark($_POST['cereal_id'], $_POST['personalized_serving_size'])) {
            echo "Failed to bookmark cereal: please visit your profile page to check that you have not already bookmarked it.";
        } else {
            echo "Successfully bookmarked cereal!";
        }
    }

    if(!empty($_POST['cerealQuery']) && ($_POST['cerealQuery'] == "Search")) {
        $cereals = filter_by_query($_POST['cereal_query']);
        $sort_description = $_POST['cereal_query'];
    }

    if(!empty($_POST['sortVotes']) && ($_POST['sortVotes'] == "Votes")) {
        if (isset($_POST['sortVoteOrd'])){
            $cereals = sort_by_votes(True);
            $sort_description = "Votes (Ascending)";
        } else {
            $cereals = sort_by_votes(False);
            $sort_description = "Votes (Descending)";
        }
    }

    if(!empty($_POST['sortCalories']) && ($_POST['sortCalories'] == "Calories")) {
        if (isset($_POST['sortCaloriesOrd'])){
            $cereals = sort_by_calories(True);
            $sort_description = "Calories (Ascending)";
        } else {
            $cereals = sort_by_calories(False);
            $sort_description = "Calories (Descending)";
        }
    }

    if(!empty($_POST['sortProtein']) && ($_POST['sortProtein'] == "Protein")) {
        if (isset($_POST['sortProteinOrd'])){
            $cereals = sort_by_protein(True);
            $sort_description = "Protein (Ascending)";
        } else {
            $cereals = sort_by_protein(False);
            $sort_description = "Protein (Descending)";
        }
    }

    if(!empty($_POST['sortFat']) && ($_POST['sortFat'] == "Fat")) {
        if (isset($_POST['sortFatOrd'])){
            $cereals = sort_by_fat(True);
            $sort_description = "Fat (Ascending)";
        } else {
            $cereals = sort_by_fat(False);
            $sort_description = "Fat (Descending)";
        }
    }

    if(!empty($_POST['filterHot']) && ($_POST['filterHot'] == "Hot cereals")) {
        $cereals = filter_cereal_type('H');
        $sort_description = "Hot cereals";
    }

    if(!empty($_POST['filterCold']) && ($_POST['filterCold'] == "Cold cereals")) {
        $cereals = filter_cereal_type('C');
        $sort_description = "Cold cereals";
    }

    if(!empty($_POST['reset']) && ($_POST['reset'] == "Reset")) {
        $cereals = get_all_cereals();
        $sort_description = "None";
    }
    
    if(!empty($_POST['upvoteBtn']) && ($_POST['upvoteBtn'] == "Upvote")) {
        vote_cereal($_POST['vote_cereal_id'], 1);
    }

    if(!empty($_POST['downvoteBtn']) && ($_POST['downvoteBtn'] == "Downvote")) {
        vote_cereal($_POST['vote_cereal_id'], -1);
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
        <div class="row mt-3 d-flex justify-content-center">
            <div class="row d-flex justify-content-end mt-3 mb-3">
                <a class="col-3 btn btn-primary" href="create_new_cereal.php">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Create Cereal 
                </a>
            </div>
            <div class="col">
                <div class="row border border-dark bg-light mx-2 p-4">
                    <h4>Search/Filter</h4>
                    <form action="cereals.php" method="post">
                        <div class="input-group">
                            <input class="mx-2 form-control" type="text" name="cereal_query" placeholder="enter keywords here"/>
                            <input type="submit" name="cerealQuery" value="Search" class="btn btn-primary"/>
                        </div>
                    </form>
                    <p class="text-success">Currently sorted/ filtered by: <?php echo $sort_description ?></p>
                    <p>Click button to sort by the respective attribute.</p>
                    <p>Results sorted high to low by default.</p>
                    <p>Select "Ascending?" checkbox to sort low to high.</p>
                    <form action="cereals.php" method="post">
                        <input type="submit" name="sortVotes" value="Votes" class="btn btn-primary col-4"/>
                        <label class="form-check-label">Ascending?</label>
                        <input type="checkbox" name="sortVoteOrd" value="Asc" class="form-check-input"/>
                    </form>
                    <form action="cereals.php" method="post">
                        <input type="submit" name="sortCalories" value="Calories" class="btn btn-primary col-4"/>
                        <label class="form-check-label">Ascending?</label>
                        <input type="checkbox" name="sortCaloriesOrd" value="Asc" class="form-check-input"/>
                    </form>
                    <form action="cereals.php" method="post">
                        <input type="submit" name="sortProtein" value="Protein" class="btn btn-primary col-4"/>
                        <label class="form-check-label">Ascending?</label>
                        <input type="checkbox" name="sortProteinOrd" value="Asc" class="form-check-input"/>
                    </form>
                    <form action="cereals.php" method="post">
                        <input type="submit" name="sortFat" value="Fat" class="btn btn-primary col-4"/>
                        <label class="form-check-label">Ascending?</label>
                        <input type="checkbox" name="sortFatOrd" value="Asc" class="form-check-input"/>
                    </form>
                    <p>Filter only hot or cold cereals.</p>
                    <form action="cereals.php" method="post">
                        <input type="submit" name="filterHot" value="Hot cereals" class="btn btn-primary col-4"/>
                    </form>
                    <form action="cereals.php" method="post">
                        <input type="submit" name="filterCold" value="Cold cereals" class="btn btn-primary col-4"/>
                    </form>
                    <p>Reset sorts/ filters</p>
                    <form action="cereals.php" method="post">
                        <input type="submit" name="resetCereals" value="Reset" class="btn btn-primary col-4"/>
                    </form>
                </div>
            </div>
            <div class="col-md-8 border border-dark bg-light">
                <?php
                global $cereals;
                foreach ($cereals as $cereal): ?>
                    <div class="row card mt-3 mb-3 mx-3 justify-content-center font-weight-bold">
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
                                <div class="row justify-content-end">
                                    <div class="col-sm-2">
                                    <form action="cereals.php" method="post">
                                        <input type="hidden" name="vote_cereal_id" value="<?php echo $cereal['cereal_id'] ?>"/>
                                        <button type="submit" name="upvoteBtn" value="Upvote" class="btn">
                                            <i class="far fa-thumbs-up"></i>
                                        </button>
                                        <?php echo get_cereal_upvotes($cereal['cereal_id'])['upvote_cnt'] ?>
                                    </form>
                                    </div>

                                    <div class="col-sm-2">
                                    <form action="cereals.php" method="post">
                                        <input type="hidden" name="vote_cereal_id" value="<?php echo $cereal['cereal_id'] ?>"/>
                                        <button type="submit" name="downvoteBtn" value="Downvote" class="btn">
                                            <i class="far fa-thumbs-down"></i>
                                        </button>
                                        <?php echo get_cereal_downvotes($cereal['cereal_id'])['downvote_cnt'] ?>
                                    </form>
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