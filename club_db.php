<?php

function get_user_clubs($user_name){
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

function update_user_club_activity($user_name, $type){
    
    $add_points = 0;

    if($type == "COMMENT"){
        $add_points = 1;
    }
    else if($type == "BOOKMARK"){
        $add_points = 2;
    }
    else if($type == "CREATE"){
        $add_points = 3;
    }

    $club_ids = get_user_clubs($user_name);
    
    $success = true;
    foreach ($club_ids as $club_id){
        $club_score = get_club_activity($club_id['club_id']);
        $success = $success && set_club_activity($club_id['club_id'], $club_score + $add_points);
    }

    return $success;
}

function get_club_activity($club_id){
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

function set_club_activity($club_id, $new_value){
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


?>