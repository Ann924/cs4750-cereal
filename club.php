<?php
session_start();

$club_info = null;
$club_creator = null;
$users = null;

require("connect_db.php");
require("user_db.php");
require("club_db.php");

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $club_info = get_club_info($_POST['club_id']);
    $club_creator = get_club_creator($club_info['club_id']);
    $users = get_users_in_club($club_info['club_id']);
    if($_SESSION['user_name'] == $club_creator) {
        echo "you created this club";
    }
    else {
        echo "you did not create this club";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo $_POST['club_id_to_leave'];
    // $isSuccess = leave_club($_SESSION["user_name"], $_POST['club_id_to_leave']);
    // if ($isSuccess) {
    //     echo "Congratulations, you have left club:";
    //     echo $_POST['club_id_to_leave'];
    //     // header("Location: index.php");
    //     $user_clubs = get_clubs_by_user($_SESSION["user_name"]);
    // } else {
    //     echo "There was an error leaving the club";
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

    <title>Club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php
    include "common_navbar.php";
    ?>
    <div class="container-fluid">
        <div class="row mt-3 d-flex justify-content-center">
            <h3 class="text-center">
                <?php echo $club_info['club_title'] ?>
            </h3>
            <p class="text-secondary text-center">Created by: <?php echo $club_creator ?></p>
            <p class="text-success text-center">Points: <?php echo $club_info['club_score'] ?></p>
        </div>
        <div class="row mt-1 d-flex justify-content-center">
            <div class="col-8">
                <h2><?php echo $club_info['club_description'] ?></h2>

                <?php if(check_if_user_in_club($_SESSION['user_name'], $club_info['club_id'])) : ?>
                    <button class="btn btn-primary" name="leave_club_btn"
                        onclick="document.forms['leave_club<?php echo $club['club_id'] ?>'].submit();">
                        <h5>
                            Leave
                            <?php echo $club['club_title'] ?>
                        </h5>
                    </button>
                <?php endif; ?>
            </div>
            <div class="col-4">
                <table class="table table-striped table-hover table-bordered">
                <thead class=" table-primary">
                    <tr>
                        <th scope="col">Members (<?php echo $club_info['num_members'] ?>)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        global $users;
                        foreach ($users as $user): ?>
                        
                        <tr>
                            <th><?php echo $user['user_name'] ?></th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
            </div>
            <!-- <form name="leave_club<?php echo $club['club_id'] ?>" action="clubs.php" method="post">
                <input type="hidden" name="club_id_to_leave" value="<?php echo $club['club_id']; ?>" />
            </form> -->
        </div>
    </div>
</body>

</html>