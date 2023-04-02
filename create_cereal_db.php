<?php

function getCerealId()
{
    global $db;
    $query = "SELECT MAX(cereal_id) FROM cereal_info";

    $statement = $db->prepare($query);
    $statement->execute();
    $cereal_id = $statement->fetchColumn();
    $statement->closeCursor();

    return $cereal_id;
}

function addCerealInfo($cereal_id, $name, $type)
{
    global $db;
    $query = "INSERT INTO cereal_info VALUE (:cereal_id, :name,  :type)";

    $statement = $db->prepare($query);
    $statement->bindValue(':cereal_id', $cereal_id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':type', $type);
    $statement->execute();
    $statement->closeCursor();
}

function addManufacturer($name, $manufacturer)
{
    global $db;
    $query = "INSERT INTO cereal_manufacturer VALUE (:name, :manufacturer)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':manufacturer', $manufacturer);
    $statement->execute();
    $statement->closeCursor();
}

function addCreatesCereal($cereal_id, $date)
{
    // note: date is autofetched
    global $db;
    $query = "INSERT INTO creates_cereal VALUE (:user_name, :cereal_id, :date)";

    $statement = $db->prepare($query);
    $statement->bindValue(':user_name', $_SESSION["user_name"]); // user_name retrieved from session
    $statement->bindValue(':cereal_id', $cereal_id);
    $statement->bindValue(':date', $date);
    $statement->execute();
    $statement->closeCursor();
}

function addNutritionInfo($cereal_id, $serving_size, $calories, $protein, $fat, $sugars, $vitamins, $sodium, $fiber, $carbohydrate, $potassium)
{
    global $db;
    $query = "INSERT INTO nutritional_statement VALUE (:cereal_id, :serving_size, :calories, :protein, :fat, :sugars, :vitamins, :sodium, :fiber, :carbohydrate, :potassium)";

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