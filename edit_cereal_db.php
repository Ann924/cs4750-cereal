<?php

function updateCereal($name, $manufacturer, $cereal_id, $type, $serving_size, $calories, $protein, $fat, $sugars, $vitamins, $sodium, $fiber, $carbohydrate, $potassium)
{
    updateManufacturer($name, $manufacturer);
    updateCerealInfo($cereal_id, $name, $type);
    updateNutritionInfo($cereal_id, $serving_size, $calories, $protein, $fat, $sugars, $vitamins, $sodium, $fiber, $carbohydrate, $potassium);
}

function updateCerealInfo($cereal_id, $name, $type)
{
    global $db;
    $query = "UPDATE cereal_info set name = :name, type = :type WHERE cereal_id = :cereal_id";

    $statement = $db->prepare($query);
    $statement->bindValue(':cereal_id', $cereal_id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':type', $type);
    $statement->execute();
    $statement->closeCursor();
}

function updateManufacturer($name, $manufacturer)
{
    global $db;
    $query = "UPDATE cereal_manufacturer SET manufacturer = :manufacturer WHERE name = :name";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':manufacturer', $manufacturer);
    $statement->execute();
    $statement->closeCursor();
}

function updateNutritionInfo($cereal_id, $serving_size, $calories, $protein, $fat, $sugars, $vitamins, $sodium, $fiber, $carbohydrate, $potassium)
{
    global $db;
    $query = "UPDATE nutritional_statement SET serving_size=:serving_size, calories=:calories, protein=:protein, fat=:fat, sugars=:sugars, vitamins=:vitamins, sodium=:sodium, fiber=:fiber, carbohydrate=:carbohydrate, potassium=:potassium WHERE cereal_id = :cereal_id";

    $statement = $db->prepare($query);
    $statement->bindValue(':cereal_id', $cereal_id);
    $statement->bindValue(':serving_size', $serving_size);
    $statement->bindValue(':calories', $calories);
    $statement->bindValue(':protein', $protein);
    $statement->bindValue(':fat', $fat);
    $statement->bindValue(':sugars', $sugars);
    $statement->bindValue(':vitamins', $vitamins);
    $statement->bindValue(':sodium', $sodium);
    $statement->bindValue(':fiber', $fiber);
    $statement->bindValue(':carbohydrate', $carbohydrate);
    $statement->bindValue(':potassium', $potassium);
    $statement->execute();
    $statement->closeCursor();
}
?>