<?php
session_start();

require("connect_db.php");
require("create_cereal_db.php");

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['createBtn']) && ($_POST['createBtn'] == "Create cereal")) {
        // gets new cereal_id and current date
        $cereal_id = getCerealId() + 1;
        $date = date('Y-m-d');

        addManufacturer($_POST['name'], $_POST['manufacturer']);
        addCerealInfo($cereal_id, $_POST['name'], $_POST['cereal_type']);
        addCreatesCereal($cereal_id, $date);
        addNutritionInfo($cereal_id, $_POST['serving_size'], $_POST['calories'], $_POST['protein'], $_POST['fat'], $_POST['sugars'], $_POST['vitamins'], $_POST['sodium'], $_POST['fiber'], $_POST['carbohydrate'], $_POST['potassium']);

        header("Location: index.php");
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
        
    <title>Create Cereal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-dark">
        <div class="container-fluid">
            <div class="col-4"></div>
            <div class="col-4 justify-content-center">
                <a class="navbar-brand navbar-nav mx-auto justify-content-center">Cereal</a>
            </div>
            <div class="col-4">
                <span class="navbar-nav ms-auto justify-content-end">account logo goes here</span>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <div class="col-md-8 border border-dark bg-light">
                <form action="create_new_cereal.php" method="post">
                    <div class="row mt-3 mb-3 mx-3 justify-content-center font-weight-bold">
                        <div class="col-4">
                            <div class="row mb-2">Display photo:</div>
                            <div class="row mb-2">Photo goes here</div>
                        </div>
                        <div class="col-8">
                            <div class="row mb-2">
                                <label for="name">Cereal name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="cereal name">
                            </div>
                            <div class="row mb-2">
                                <label for="manufacturer">Manufacturer</label>
                                <input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="manufacturer">
                            </div>
                            <div class="row mb-2">
                                <label class="">Select type</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="hot" name="cereal type" value="hot">
                                    <label class="form-check-label" for="hot">
                                        Hot
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="cold" name="cereal type" value="cold">
                                    <label class="form-check-label" for="cold">
                                        Cold
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label>Nutritional information</label>
                                <div class="col-6">
                                    <input type="text" class="form-control mt-2" id="serving_size" name="serving size" placeholder="serving size">
                                    <input type="text" class="form-control mt-2" id="calories" name="calories" placeholder="calories">
                                    <input type="text" class="form-control mt-2" id="protein" name="protein" placeholder="protein">
                                    <input type="text" class="form-control mt-2" id="fat" name="fat" placeholder="fat">
                                    <input type="text" class="form-control mt-2" id="sugars" name="sugars" placeholder="sugars">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control mt-2" id="vitamins" name="vitamins" placeholder="vitamins">
                                    <input type="text" class="form-control mt-2" id="sodium" name="sodium" placeholder="sodium">
                                    <input type="text" class="form-control mt-2" id="fiber" name="fiber" placeholder="fiber">
                                    <input type="text" class="form-control mt-2" id="carbohydrate" name="carbohydrate" placeholder="carbohydrate">
                                    <input type="text" class="form-control mt-2" id="potassium" name="potassium" placeholder="potassium">
                                </div>
                            </div>
                            <div class="row mx-3 justify-content-center">
                                <div class="col-8">
                                    <div class="row">
                                        <input type="submit" class="btn btn-primary" name="createBtn" value="Create cereal" title="create cereal" />
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