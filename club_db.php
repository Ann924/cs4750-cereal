<?php

function get_user_clubs($user_name)
{
    global $db; //use global db from connect-db.php

    // find email from user_information
    $query = "SELECT club_id FROM joins_club WHERE user_name = :user_name";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_name', $user_name);
    $statement->execute();

    $clubs = $statement->fetchAll();
    $statement->closeCursor();

    return $clubs;

}

function update_user_club_activity($user_name, $type)
{

    $add_points = 0;

    if ($type == "COMMENT") {
        $add_points = 1;
    } else if ($type == "BOOKMARK") {
        $add_points = 2;
    } else if ($type == "CREATE") {
        $add_points = 3;
    }

    $club_ids = get_user_clubs($user_name);

    $success = true;
    foreach ($club_ids as $club_id) {
        $club_score = get_club_activity($club_id['club_id']);
        $success = $success && set_club_activity($club_id['club_id'], $club_score + $add_points);
    }

    return $success;
}

function get_club_activity($club_id)
{
    global $db; //use global db from connect-db.php

    // find email from user_information
    $query = "SELECT club_score FROM club WHERE club_id = :club_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':club_id', $club_id);
    $statement->execute();

    $club_score = $statement->fetch();
    $statement->closeCursor();

    return $club_score['club_score'];

}

function set_club_activity($club_id, $new_value)
{
    global $db; //use global db from connect-db.php

    // find email from user_information
    $query = "UPDATE club SET club_score = :new_score WHERE club_id = :club_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':club_id', $club_id);
    $statement->bindValue(':new_score', $new_value);
    $success = $statement->execute();

    $statement->closeCursor();

    return $success;
}


function get_all_clubs()
{
    global $db; //use global db from connect-db.php

    $query = "SELECT * FROM club";
    $statement = $db->prepare($query);
    $statement->execute();

    $clubs = $statement->fetchAll();
    $statement->closeCursor();
    return $clubs;
}

function get_club_info($club_id)
{
    global $db; //use global db from connect-db.php

    // find club from club_id
    $query = "SELECT * FROM club WHERE club_id=:club_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':club_id', $club_id);
    $statement->execute();

    $club_info = $statement->fetch();

    $statement->closeCursor();
    return $club_info;
}

function check_if_user_in_club($user_name, $club_id)
{
    global $db; //use global db from connect-db.php

    $query = "SELECT * FROM joins_club WHERE user_name=:user_name AND club_id=:club_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_name', $user_name);
    $statement->bindValue(':club_id', $club_id);

    $success = $statement->execute();

    if ($statement->fetch()) {
        echo "user is in club";
        return TRUE;
    }
    echo "user is not in club";
    return FALSE;
}

function join_club($user_name, $club_id)
{
    global $db; //use global db from connect-db.php

    try {
        $query = "INSERT INTO joins_club VALUES(:user_name, :club_id);";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name);
        $statement->bindValue(':club_id', $club_id);

        $success = $statement->execute();
    } catch (Exception $e) {
        $success = False;
    } finally {
        $statement->closeCursor();
    }

    return $success;
}

function leave_club($user_name, $club_id)
{
    global $db; //use global db from connect-db.php

    try {
        $query = "DELETE FROM joins_club WHERE user_name = :user_name AND club_id = :club_id;";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name);
        $statement->bindValue(':club_id', $club_id);

        $success = $statement->execute();
    } catch (Exception $e) {
        $success = False;
    } finally {
        $statement->closeCursor();
    }

    return $success;
}

function get_club_creator($club_id) {
    global $db; //use global db from connect-db.php

    // echo $club_id;

    $query = "SELECT user_name FROM creates_club WHERE club_id=:club_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':club_id', $club_id);
    $statement->execute();

    $creator = $statement->fetchColumn();

    // foreach($creator as $c) {
    //     echo $c;
    // }

    $statement->closeCursor();
    return $creator;
}

function get_clubs_by_user($user_name)
{
    global $db; //use global db from connect-db.php

    // echo $user_name;

    $query = "SELECT * FROM joins_club NATURAL JOIN club WHERE user_name=:user_name";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_name', $user_name);
    $statement->execute();

    $clubs = $statement->fetchAll();

    // echo "here";
    foreach ($clubs as $c) {
        // echo "club";
        // echo $c["club_title"];
    }

    $statement->closeCursor();
    return $clubs;
}

?>