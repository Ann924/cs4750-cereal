<?php
session_start();

$club_info = null;

require("connect_db.php");
require("user_db.php");
require("club_db.php");

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $club_info = get_club_info($_POST['club_id']);
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
        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <h3 class="text-center">
                <?php echo $club_info['club_title'] ?>
            </h3>
            <h2>
                <?php echo $club_info['club_description'] ?>
            </h2>
            <h2>
                <?php echo $club_info['num_members'] ?> members
            </h2>
            <h2>
                <?php echo $club_info['club_score'] ?> points
            </h2>
        </div>
    </div>
</body>

</html>