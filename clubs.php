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
    echo $_POST['club_id'];
    // if incoming request is a post request and the form is the join club form
    // if (!empty($_POST['join_club_btn'])) { how do i check this?
    //     echo "join club";
    if(!check_if_user_in_club($_SESSION["user_name"], $_POST['club_id'])) {
        $isSuccess = join_club($_SESSION["user_name"], $_POST['club_id']);
        if($isSuccess){
            echo "Congratulations, you have joined the club:";
            echo $_POST['club_id'];
            // header("Location: index.php");
            $clubs = get_all_clubs(); // to update num_members after joining club
        }
        else{
            echo "There was an error joining the club";
        }
    }
    else {
        echo "You have already joined this club";
    }
        
    // }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
            <div class="row d-flex justify-content-end">
                <a class="col-1 btn btn-primary" href="create_new_club.php">Create Club</a>
            </div>
            <?php
                global $clubs;
                global $user_clubs;
                foreach ($clubs as $club): ?>

            <?php
                // echo "here";
                // echo array_search($club, $user_clubs);
                // if(array_search($club, $user_clubs)) {
                //     echo "user is already in this club";
                // }
            ?>
            <a href="#"
                onclick="document.forms['club<?php echo $club['club_id'] ?>'].submit();">
                <h3>
                <?php echo $club['club_title'] ?>
                </h3>
                
            </a>
            <h2><?php echo $club['club_description'] ?></h2>
            <h2><?php echo $club['num_members'] ?> members</h2> 
            <h2><?php echo $club['club_score'] ?> points</h2> 

            <button name="join_club_btn"
                onclick="document.forms['join_club<?php echo $club['club_id'] ?>'].submit();">
                <h3>
                    Join <?php echo $club['club_title'] ?>
                </h3>
            </button>

            <form name="club<?php echo $club['club_id']; ?>" action="club.php" method="post">
                <input type="hidden" name="club_id" value="<?php echo $club['club_id']; ?>" />
            </form>

            <form name="join_club<?php echo $club['club_id'] ?>" action="clubs.php" method="post">
                <input type="hidden" name="club_id" value="<?php echo $club['club_id']; ?>" />
            </form>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>