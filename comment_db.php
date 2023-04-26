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

function get_comments_by_user()
{
    global $db; //use global db from connect-db.php

    $query = "SELECT * FROM comment NATURAL JOIN cereal_info WHERE user_name = :user_name";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_name', $_SESSION['user_name']);
    $statement->execute();
    $cereals = $statement->fetchAll();
    $statement->closeCursor();
    return $cereals;
}

function update_comment($cereal_id, $comment_id, $text, $date)
{
    global $db; //use global db from connect-db.php

    $query = "UPDATE comment SET text = :text, date = :date WHERE user_name = :user_name AND cereal_id = :cereal_id AND comment_id = :comment_id;";
    $statement = $db->prepare($query);
    $statement->bindValue(':text', $text);
    $statement->bindValue(':date', $date);
    $statement->bindValue(':user_name', $_SESSION["user_name"]);
    $statement->bindValue(':cereal_id', $cereal_id);
    $statement->bindValue(':comment_id', $comment_id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_comment($cereal_id, $comment_id)
{
    global $db; //use global db from connect-db.php

    $query = "DELETE FROM comment WHERE user_name = :user_name AND cereal_id = :cereal_id AND comment_id = :comment_id;";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_name', $_SESSION["user_name"]);
    $statement->bindValue(':cereal_id', $cereal_id);
    $statement->bindValue(':comment_id', $comment_id);
    $statement->execute();
    $statement->closeCursor();
}

?>