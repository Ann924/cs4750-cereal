<?php
session_start();

require("connect_db.php");
require("create_club_db.php");

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['createBtn']) && ($_POST['createBtn'] == "Create club")) {
        $club_id = getClubId() + 1;

        addClub($club_id, $_POST['title'], $_POST['description']);
        addCreatesClub($club_id);
        // addJoinsClub($club_id);

        // addManufacturer($_POST['name'], $_POST['manufacturer']);
        // addCerealInfo($cereal_id, $_POST['name'], $_POST['cereal_type']);
        // addCreatesCereal($cereal_id, $date);
        // addNutritionInfo($cereal_id, $_POST['serving_size'], $_POST['calories'], $_POST['protein'], $_POST['fat'], $_POST['sugars'], $_POST['vitamins'], $_POST['sodium'], $_POST['fiber'], $_POST['carbohydrate'], $_POST['potassium']);

        // echo "club created successfully";
        header("Location: clubs.php");
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

    <title>Create Club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php
    include "common_navbar.php";
    ?>
    <div class="container-fluid">
        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <div class="col-md-8 border border-dark bg-light">
                <form action="create_new_club.php" method="post">
                    <div class="row mt-3 mb-3 mx-3 justify-content-center font-weight-bold">
                        <div class="col-8">
                            <div class="row mb-2">
                                <label for="title">Club title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="club title">
                            </div>
                            <div class="row mb-2">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    placeholder="brief description">
                            </div>
                            <div class="row mx-3 justify-content-center">
                                <div class="col-8">
                                    <div class="row">
                                        <input type="submit" class="btn btn-primary" name="createBtn"
                                            value="Create club" title="create club" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>