<?php
session_start();

require("connect_db.php");
require("cereal_db.php");
require("edit_cereal_db.php");

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    if (empty($_POST['updateBtn'])) {
        $cereal_info = get_cereal_info($_POST['cereal_id']);
        $cereal_manufacturer = get_cereal_manufacturer($cereal_info['name']);
        $cereal_nutrition = get_cereal_nutrition($_POST['cereal_id']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['updateBtn']) && ($_POST['updateBtn'] == "Update cereal")) {
        updateCereal($_POST['name'], $_POST['manufacturer'], $_POST['cereal_id'], $_POST['cereal_type'], $_POST['serving_size'], $_POST['calories'], $_POST['protein'], $_POST['fat'], $_POST['sugars'], $_POST['vitamins'], $_POST['sodium'], $_POST['fiber'], $_POST['carbohydrate'], $_POST['potassium']);

        header("Location: profile.php");
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

    <title>Edit Cereal</title>
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
                <form action="edit_cereal.php" method="post">
                    <div class="row mt-3 mb-3 mx-3 justify-content-center font-weight-bold">
                        <div class="col-4">
                            <div class="row mb-2">Display photo:</div>
                            <div class="row mb-2">Photo goes here</div>
                        </div>
                        <div class="col-8">
                            <input type="hidden" id="cereal id" name="cereal id" value="<?php echo $_POST['cereal_id'] ?>">
                            <div class="row mb-2">
                                <label for="name">Cereal name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="cereal name" value="<?php echo $cereal_info['name'] ?>">
                            </div>
                            <div class="row mb-2">
                                <label for="manufacturer">Manufacturer</label>
                                <input type="text" class="form-control" id="manufacturer" name="manufacturer"
                                    placeholder="manufacturer" value="<?php echo $cereal_manufacturer['manufacturer'] ?>">
                            </div>
                            <div class="row mb-2">
                                <label class="">Select type</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="hot" name="cereal type"
                                        value="hot" checked="<?php $cereal_info['type'] == "H" ?>">
                                    <label class="form-check-label" for="hot">
                                        Hot
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="cold" name="cereal type"
                                        value="cold" checked="<?php $cereal_info['type'] == "C" ?>">
                                    <label class="form-check-label" for="cold">
                                        Cold
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label>Nutritional information</label>
                                <div class="col-6">
                                    <input type="text" class="form-control mt-2" id="serving_size" name="serving size"
                                        placeholder="serving size" value="<?php echo $cereal_nutrition['serving_size'] ?>">
                                    <input type="text" class="form-control mt-2" id="calories" name="calories"
                                        placeholder="calories" value="<?php echo $cereal_nutrition['calories'] ?>">
                                    <input type="text" class="form-control mt-2" id="protein" name="protein"
                                        placeholder="protein" value="<?php echo $cereal_nutrition['protein'] ?>">
                                    <input type="text" class="form-control mt-2" id="fat" name="fat" placeholder="fat" value="<?php echo $cereal_nutrition['fat'] ?>">
                                    <input type="text" class="form-control mt-2" id="sugars" name="sugars"
                                        placeholder="sugars" value="<?php echo $cereal_nutrition['sugars'] ?>">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control mt-2" id="vitamins" name="vitamins"
                                        placeholder="vitamins" value="<?php echo $cereal_nutrition['vitamins'] ?>">
                                    <input type="text" class="form-control mt-2" id="sodium" name="sodium"
                                        placeholder="sodium" value="<?php echo $cereal_nutrition['sodium'] ?>">
                                    <input type="text" class="form-control mt-2" id="fiber" name="fiber"
                                        placeholder="fiber" value="<?php echo $cereal_nutrition['fiber'] ?>">
                                    <input type="text" class="form-control mt-2" id="carbohydrate" name="carbohydrate"
                                        placeholder="carbohydrate" value="<?php echo $cereal_nutrition['carbohydrate'] ?>">
                                    <input type="text" class="form-control mt-2" id="potassium" name="potassium"
                                        placeholder="potassium" value="<?php echo $cereal_nutrition['potassium'] ?>">
                                </div>
                            </div>
                            <div class="row mx-3 justify-content-center">
                                <div class="col-8">
                                    <div class="row">
                                        <input type="submit" class="btn btn-primary" name="updateBtn"
                                            value="Update cereal" title="update cereal" />
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