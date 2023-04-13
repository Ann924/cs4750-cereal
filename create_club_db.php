<?php

function getClubId()
{
    global $db;
    $query = "SELECT MAX(club_id) FROM club";

    $statement = $db->prepare($query);
    $statement->execute();
    $club_id = $statement->fetchColumn();
    $statement->closeCursor();

    return $club_id;
}

function addClub($club_id, $club_title, $club_description)
{
    global $db;
    $query = "INSERT INTO club VALUE (:club_id, :club_title,  :club_description, 0, 0)";

    $statement = $db->prepare($query);
    $statement->bindValue(':club_id', $club_id);
    $statement->bindValue(':club_title', $club_title);
    $statement->bindValue(':club_description', $club_description);
    $statement->execute();
    $statement->closeCursor();
}

function addCreatesClub($club_id)
{
    // note: date is autofetched
    global $db;
    $query = "INSERT INTO creates_club VALUE (:club_id, :user_name)";

    $statement = $db->prepare($query);
    $statement->bindValue(':club_id', $club_id);
    $statement->bindValue(':user_name', $_SESSION["user_name"]); // user_name retrieved from session
    
    $statement->execute();
    $statement->closeCursor();
}


?>