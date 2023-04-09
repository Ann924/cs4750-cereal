<?php
session_start();

$user_clubs = null;

require("connect_db.php");
require("user_db.php");
require("club_db.php");

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $user_clubs = get_clubs_by_user($_SESSION["user_name"]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "post request";
    echo $_POST['club_id'];
    // if incoming request is a post request and the form is the join club form
    // if (!empty($_POST['join_club_btn'])) { how do i check this?
    //     echo "join club";
        $isSuccess = leave_club($_SESSION["user_name"], $_POST['club_id']);
        if($isSuccess){
            echo "Congratulations, you have left club:";
            echo $_POST['club_id'];
            // header("Location: index.php");
            $user_clubs = get_clubs_by_user($_SESSION["user_name"]);
        }
        else{
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
    <meta name="author" content="Lilian Zhang">
    <meta name="description" content="project">  
        
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    Welcome to your profile, <?php echo $_SESSION["user_name"] ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-dark">
        <div class="container-fluid">
            <div class="col-4"><a href="logout.php">Logout</a></div>
            <div class="col-4 justify-content-center">
                <a class="navbar-brand navbar-nav mx-auto justify-content-center">Cereals</a>
            </div>
            <div class="col-4">
            <a href="profile.php" class="navbar-nav ms-auto justify-content-end">account logo goes here yay <?php echo $_SESSION["user_name"] ?></a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <h3 class="text-center">
                Welcome to your profile, <?php echo $_SESSION["user_name"] ?>
            </h3>
            <div class="card col-md-8 border border-dark bg-light">
                <div class="card-header">
                    Clubs
                </div>
                <div class="card-body">
                    <?php
                        global $user_clubs;
                        foreach ($user_clubs as $club): ?>
                            <a href="#"
                        onclick="document.forms['club<?php echo $club['club_id'] ?>'].submit();">
                        <h3>
                        <?php echo $club['club_title'] ?>
                        </h3>
                    </a>
                    <h2><?php echo $club['club_description'] ?></h2>
                    <h2><?php echo $club['num_members'] ?> members</h2> 
                    <h2><?php echo $club['club_score'] ?> points</h2> 

                    <button name="leave_club_btn"
                        onclick="document.forms['leave_club<?php echo $club['club_id'] ?>'].submit();">
                        <h3>
                            Leave <?php echo $club['club_title'] ?>
                        </h3>
                    </button>

                    <form name="club<?php echo $club['club_id']; ?>" action="club.php" method="post">
                        <input type="hidden" name="club_id" value="<?php echo $club['club_id']; ?>" />
                    </form>

                    <form name="leave_club<?php echo $club['club_id'] ?>" action="profile.php" method="post">
                        <input type="hidden" name="club_id" value="<?php echo $club['club_id']; ?>" />
                    </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>