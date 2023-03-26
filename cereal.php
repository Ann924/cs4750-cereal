<?php
session_start();

$cereal_info = null;
$cereal_manufacturer = null;
$cereal_nutrition = null;

require("connect_db.php");
require("cereal_db.php");

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $cereal_info = get_cereal_info($_POST['cereal_id']);
    $cereal_manufacturer = get_cereal_manufacturer($cereal_info['name']);
    $cereal_nutrition = get_cereal_nutrition($_POST['cereal_id']);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="project">

    <title>
        <?php echo $cereal_info['name'] ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-dark">
        <div class="container-fluid">
            <div class="col-4"><a href="logout.php">Logout</a></div>
            <div class="col-4 justify-content-center">
                <a href="cereals.php" class="navbar-brand navbar-nav mx-auto justify-content-center">Cereals</a>
            </div>
            <div class="col-4">
                <span class="navbar-nav ms-auto justify-content-end">account logo goes here</span>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <h3 class="text-center">
                <?php echo $cereal_info['name'] ?>
            </h3>
            <div class="card col-md-8 border border-dark bg-light">
                <div class="card-body">
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
    </div>
</body>

</html>