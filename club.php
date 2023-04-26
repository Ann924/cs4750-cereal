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
    // if($_SESSION['user_name'] == $club_creator) {
    //     echo "you created this club";
    // }
    // else {
    //     echo "you did not create this club";
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
    <div class="container-fluid mx-auto">
        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <div class="card col-md-8 border border-dark bg-light">
                <div class="card-body">
                    <h2 class="text-center" style="text-transform: uppercase;">
                        <?php echo $club_info['club_title'] ?>
                    </h2>
                    <p class="text-secondary text-center">Created by: <?php echo $club_creator ?> | Points: <?php echo $club_info['club_score'] ?></p>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h2><?php echo $club_info['club_description'] ?></h2>
                        </div>
                        <div class="col">
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
                                            <?php if($user['user_name'] == $_SESSION['user_name']): ?>
                                                <th class="text-primary"><?php echo $user['user_name'] ?> (you)</th>
                                            <?php else: ?>
                                                <th><?php echo $user['user_name'] ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>