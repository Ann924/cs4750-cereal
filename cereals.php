<?php
session_start();

require("connect_db.php");
require("cereal_db.php");
require("sorting_cereals_db.php");

$cereals = null;

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $cereals = get_all_cereals();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['cerealQuery']) && ($_POST['cerealQuery'] == "Search")) {
        $cereals = filter_by_query($_POST['cereal_query']);
    }

    if(!empty($_POST['sortVotes']) && ($_POST['sortVotes'] == "Votes")) {
        if (isset($_POST['sortVoteOrd'])){
            $cereals = sort_by_votes(True);
        } else {
            $cereals = sort_by_votes(False);
        }
    }

    if(!empty($_POST['sortCalories']) && ($_POST['sortCalories'] == "Calories")) {
        if (isset($_POST['sortCaloriesOrd'])){
            $cereals = sort_by_calories(True);
        } else {
            $cereals = sort_by_calories(False);
        }
    }

    if(!empty($_POST['sortProtein']) && ($_POST['sortProtein'] == "Protein")) {
        if (isset($_POST['sortProteinOrd'])){
            $cereals = sort_by_protein(True);
        } else {
            $cereals = sort_by_protein(False);
        }
    }

    if(!empty($_POST['sortFat']) && ($_POST['sortFat'] == "Fat")) {
        if (isset($_POST['sortFatOrd'])){
            $cereals = sort_by_fat(True);
        } else {
            $cereals = sort_by_fat(False);
        }
    }

    if(!empty($_POST['filterHot']) && ($_POST['filterHot'] == "Hot")) {
        $cereals = filter_cereal_type('H');
    }

    if(!empty($_POST['filterCold']) && ($_POST['filterCold'] == "Cold")) {
        $cereals = filter_cereal_type('C');
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
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-dark">
        <div class="container-fluid">
            <div class="col-4"><a href="logout.php">Logout</a></div>
            <div class="col-4 justify-content-center">
                <a class="navbar-brand navbar-nav mx-auto justify-content-center">Cereals</a>
            </div>
            <div class="col-4">
                <span class="navbar-nav ms-auto justify-content-end">account logo goes here</span>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row mt-3 d-flex justify-content-center">
            <div class="row d-flex justify-content-end"><a class="col-1 btn btn-primary"
                    href="create_new_cereal.php">Create Cereal</a></div>
            <div class="col">
                <div class="row border border-dark bg-light mx-2 p-4">
                    <h4>Search/Filter</h4>
                    <form action="cereals.php" method="post">
                        <div class="input-group">
                            <input class="mx-2" type="text" name="cereal_query"/>
                            <input type="submit" name="cerealQuery" value="Search"/>
                        </div>
                    </form>
                    <form action="cereals.php" method="post">
                        <label>Ascending?</label>
                        <input type="checkbox" name="sortVoteOrd" value="Asc"/>
                        <input type="submit" name="sortVotes" value="Votes"/>
                    </form>
                    <form action="cereals.php" method="post">
                        <label>Ascending?</label>
                        <input type="checkbox" name="sortCaloriesOrd" value="Asc"/>
                        <input type="submit" name="sortCalories" value="Calories"/>
                    </form>
                    <form action="cereals.php" method="post">
                        <label>Ascending?</label>
                        <input type="checkbox" name="sortProteinOrd" value="Asc"/>
                        <input type="submit" name="sortProtein" value="Protein"/>
                    </form>
                    <form action="cereals.php" method="post">
                        <label>Ascending?</label>
                        <input type="checkbox" name="sortFatOrd" value="Asc"/>
                        <input type="submit" name="sortFat" value="Fat"/>
                    </form>
                    <form action="cereals.php" method="post">
                        <input type="submit" name="filterHot" value="Hot"/>
                    </form>
                    <form action="cereals.php" method="post">
                        <input type="submit" name="filterCold" value="Cold"/>
                    </form>
                </div>
            </div>
            <div class="col-md-8 border border-dark bg-light">
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
                                <div class="row mb-2">
                                    <div class="card-title">
                                        <a href="#"
                                            onclick="document.forms['cereal<?php echo $cereal['cereal_id'] ?>'].submit();">
                                            <h3>
                                                <?php echo $cereal['name'] ?>
                                            </h3>
                                        </a>
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
                                    <div>
                                        Upvotes: <?php echo get_cereal_upvotes($cereal['cereal_id'])['upvote_cnt'] ?>
                                        <form action="cereals.php" method="post">
                                            <input type="hidden" name="vote_cereal_id" value="<?php echo $cereal['cereal_id'] ?>"/>
                                            <input type="submit" name="upvoteBtn" value="Upvote"/>
                                        </form>
                                    </div>
                                    <div>
                                        Downvotes: <?php echo get_cereal_downvotes($cereal['cereal_id'])['downvote_cnt'] ?>
                                        <form action="cereals.php" method="post">
                                            <input type="hidden" name="vote_cereal_id" value="<?php echo $cereal['cereal_id'] ?>"/>
                                            <input type="submit" name="downvoteBtn" value="Downvote"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form name="cereal<?php echo $cereal['cereal_id']; ?>" action="cereal.php" method="post">
                        <input type="hidden" name="cereal_id" value="<?php echo $cereal['cereal_id']; ?>" />
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>