<?php

function updateCereal($name, $manufacturer, $cereal_id, $type, $serving_size, $calories, $protein, $fat, $sugars, $vitamins, $sodium, $fiber, $carbohydrate, $potassium)
{
    $old_name = getOldCerealName($cereal_id);
    updateCerealName($old_name, $name); // NOTE: new "name" is updated in cereal_info via foreign key constaint
    updateCerealInfo($cereal_id, $type);
    updateManufacturer($name, $manufacturer);
    updateNutritionInfo($cereal_id, $serving_size, $calories, $protein, $fat, $sugars, $vitamins, $sodium, $fiber, $carbohydrate, $potassium);
}

function updateCerealInfo($cereal_id, $type)
{
    global $db;
    $query = "UPDATE cereal_info SET type = :type WHERE cereal_id = :cereal_id";

    $statement = $db->prepare($query);
    $statement->bindValue(':cereal_id', $cereal_id);
    $statement->bindValue(':type', $type);
    $statement->execute();
    $statement->closeCursor();
}

function getOldCerealName($cereal_id){
    global $db;
    $query = "SELECT name FROM cereal_info WHERE cereal_id = :cereal_id";

    $statement = $db->prepare($query);
    $statement->bindValue(':cereal_id', $cereal_id);
    $statement->execute();
    $cereal_name = $statement->fetchColumn();
    $statement->closeCursor();

    return $cereal_name;
}

function updateCerealName($old_name, $new_name){
    global $db;
    $query = "UPDATE cereal_manufacturer SET name = :new_name WHERE name = :old_name";

    $statement = $db->prepare($query);
    $statement->bindValue(':new_name', $new_name);
    $statement->bindValue(':old_name', $old_name);
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