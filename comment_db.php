<?php

require_once('club_db.php');

function get_all_comments($cereal_id)
{
    global $db;

    $query = "SELECT * FROM comment WHERE cereal_id = :cereal_id";

    $statement = $db->prepare($query);
    $statement->bindValue(':cereal_id', $cereal_id);
    $statement->execute();
    $comments = $statement->fetchAll();
    $statement->closeCursor();

    return $comments;
}

function getCommentId($cereal_id)
{
    global $db;

    $query = "SELECT MAX(comment_id) FROM comment WHERE cereal_id = :cereal_id";

    $statement = $db->prepare($query);
    $statement->bindValue(':cereal_id', $cereal_id);
    $statement->execute();
    $comment_id = $statement->fetchColumn();
    $statement->closeCursor();

    if (!$comment_id) {
        return 0;
    }

    return $comment_id;
}
function add_comment($cereal_id, $comment_text, $comment_date)
{
    global $db; //use global db from connect-db.php

    $success = True;

    try {
        $query = "INSERT INTO comment VALUE (:user_name, :cereal_id, :comment_id, :comment_text, :comment_date)";
        $comment_id = getCommentId($cereal_id);

        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $_SESSION["user_name"]);
        $statement->bindValue(':cereal_id', $cereal_id);
        $statement->bindValue(':comment_id', $comment_id);
        $statement->bindValue(':comment_text', $comment_text);
        $statement->bindValue(':comment_date', $comment_date);
        $success = $statement->execute();
    } catch (Exception $e) {
        $success = False;
    }
    finally{
        $statement->closeCursor();
    }

    // add score to relevant clubs
    if($success){
        $success = update_user_club_activity($_SESSION['user_name'], "COMMENT");
    }

    return $success;

}

?>