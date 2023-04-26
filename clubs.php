<?php
session_start();

$clubs = null;
$user_clubs = null;

require("connect_db.php");
require("user_db.php");
require("club_db.php");

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $clubs = get_all_clubs();
    $user_clubs = get_clubs_by_user($_SESSION["user_name"]); // do something different with the clubs that users have already joined; for example, currently the user gets an error when trying to join a club they've already joined
    // foreach($user_clubs as $c) {
    //     echo "club";
    //     echo $c["club_title"];
    // }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "post request";
    echo is_null($_POST['club_id']);
    // if incoming request is a post request and the form is the join club form
    // if (!empty($_POST['join_club_btn'])) { how do i check this?
    //     echo "join club";
    if(!is_null($_POST['club_id'])) {
        echo "join club clicked";
        if (!check_if_user_in_club($_SESSION["user_name"], $_POST['club_id'])) {
            $isSuccess = join_club($_SESSION["user_name"], $_POST['club_id']);
            if ($isSuccess) {
                echo "Congratulations, you have joined the club:";
                echo $_POST['club_id'];
                // header("Location: index.php");
                $clubs = get_all_clubs(); // to update num_members after joining club
            }
            else {
                echo "There was an error joining the club";
            }
        } else {
            echo "You have already joined this club";
        }
    }
    

    // }
    if(!empty($_POST['clubQuery']) && ($_POST['clubQuery'] == "Search")) {
        echo "search clicked";
        $clubs = filter_club_by_query($_POST['club_query']);
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

    <title>Clubs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php
    include "common_navbar.php";
    ?>
    <div class="container-fluid">
        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <h3 class="text-center">
                Clubs
            </h3>
            <div class="row">
                <div class="col d-flex justify-content-start">
                    <form action="clubs.php" method="post">
                        <div class="input-group">
                            <input class="mx-2 form-control" type="text" name="club_query" placeholder="enter key words here"/>
                            <input type="submit" class="btn btn-primary" name="clubQuery" value="Search"/>
                        </div>
                    </form>
                </div>
                <div class="col justify-content-end d-inline-flex align-items-center">
                    <a class="col-3 btn btn-primary" href="create_new_club.php">Create Club</a>
                </div>
                
            </div>

            

            <?php
                global $clubs;
                global $user_clubs;
                foreach ($clubs as $club): ?>
                    <div class="row card mt-3 mb-3 mx-3 justify-content-center font-weight-bold">
                        <div class="card-body">
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
                                    <button class="btn btn-primary mx-3 d-inline-flex align-items-center" name="join_club_btn"
                                    onclick="document.forms['join_club<?php echo $club['club_id'] ?>'].submit();">
                                        Join&nbsp;&nbsp;<i class="fa fa-user-plus my-0" aria-hidden="true"></i>
                                    </button>
                                </div>
                                
                            </div>
                            <div class="row">
                                <h5>
                                    <?php echo $club['club_description'] ?>
                                </h5>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-2 justify-content-end">
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
                        <!-- <div class="row justify-content-end">
                            <button class="col-3 btn btn-primary mx-3" name="join_club_btn"
                                onclick="document.forms['join_club<?php echo $club['club_id'] ?>'].submit();">
                                <h5>
                                    Join
                                    <?php echo $club['club_title'] ?>
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                </h5>
                            </button>
                        </div> -->

                        <form name="club<?php echo $club['club_id']; ?>" action="club.php" method="post" class="d-none">
                            <input type="hidden" name="club_id" value="<?php echo $club['club_id']; ?>" />
                        </form>

                        <form name="join_club<?php echo $club['club_id'] ?>" action="clubs.php" method="post" class="d-none">
                            <input type="hidden" name="club_id" value="<?php echo $club['club_id']; ?>" />
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>