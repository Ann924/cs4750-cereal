<?php
session_start();

require("connect_db.php");
require("cereal_db.php");

$cereals = null;

if (!$_SESSION["loggedIn"]) {
    header("Location: login.php");
    die;
} else {
    $cereals = get_all_cereals();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="project">

    <title>Cereals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php
    include "common_navbar.php";
    ?>
    <div class="container-fluid">
        <div class="row mt-3 d-flex justify-content-center align-items-center">
            <div class="row d-flex justify-content-end"><a class="col-1 btn btn-primary"
                    href="create_new_cereal.php">Create Cereal</a></div>
            <div class="col-md-8 border border-dark bg-light">
                <?php
                global $cereals;
                foreach ($cereals as $cereal): ?>
                    <div class="row card mt-3 mb-3 mx-3 justify-content-center font-weight-bold">
                        <div class="card-body row">
                            <div class="col-4">
                                <div class="row mb-2">Display photo:</div>
                                <div class="row mb-2">Photo goes here</div>
                            </div>
                            <div class="col-8">
                                <div class="row mb-2">
                                    <div class="card-title">
                                        <a href="#"
                                            onclick="document.forms['cereal<?php echo $cereal['cereal_id'] ?>'].submit();">
                                            <h3>
                                                <?php echo $cereal['name'] ?>
                                            </h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div>
                                        <?php echo get_cereal_nutrition($cereal['cereal_id'])['calories'] ?> cal /
                                        serving
                                    </div>
                                    <div> Serving size:
                                        <?php echo get_cereal_nutrition($cereal['cereal_id'])['serving_size'] ?> oz.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form name="cereal<?php echo $cereal['cereal_id']; ?>" action="cereal.php" method="post">
                        <input type="hidden" name="cereal_id" value="<?php echo $cereal['cereal_id']; ?>" />
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>