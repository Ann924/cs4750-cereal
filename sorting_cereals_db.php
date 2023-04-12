<?php
    function filter_by_query($query_search) {
        global $db;

        $query = "SELECT * FROM cereal_info WHERE name LIKE CONCAT( '%', :query_search, '%')";
        $statement = $db->prepare($query);
        $statement->bindValue(':query_search', $query_search);
        $statement->execute();
        $cereals = $statement->fetchAll();
        $statement->closeCursor();
        return $cereals;
    }

    function sort_by_votes($asc) {
        global $db;
        if ($asc){
            $query = "WITH total_score AS
                    (SELECT cereal_id, upvote_cnt, downvote_cnt FROM ((SELECT cereal_id, COUNT(*) AS upvote_cnt FROM vote WHERE vote_value = 1 GROUP BY cereal_id) A NATURAL LEFT JOIN (SELECT cereal_id, COUNT(*) AS downvote_cnt FROM vote WHERE vote_value = -1 GROUP BY cereal_id) B)
                    UNION
                    SELECT cereal_id, upvote_cnt, downvote_cnt FROM ((SELECT cereal_id, COUNT(*) AS upvote_cnt FROM vote WHERE vote_value = 1 GROUP BY cereal_id) A NATURAL RIGHT JOIN (SELECT cereal_id, COUNT(*) AS downvote_cnt FROM vote WHERE vote_value = -1 GROUP BY cereal_id) B)
                    )
                    SELECT cereal_id, name, type, (IFNULL(upvote_cnt, 0)-IFNULL(downvote_cnt, 0)) as full_score FROM cereal_info NATURAL LEFT JOIN total_score ORDER BY full_score ASC, name";
        } else {
            $query = "WITH total_score AS
                    (SELECT cereal_id, upvote_cnt, downvote_cnt FROM ((SELECT cereal_id, COUNT(*) AS upvote_cnt FROM vote WHERE vote_value = 1 GROUP BY cereal_id) A NATURAL LEFT JOIN (SELECT cereal_id, COUNT(*) AS downvote_cnt FROM vote WHERE vote_value = -1 GROUP BY cereal_id) B)
                    UNION
                    SELECT cereal_id, upvote_cnt, downvote_cnt FROM ((SELECT cereal_id, COUNT(*) AS upvote_cnt FROM vote WHERE vote_value = 1 GROUP BY cereal_id) A NATURAL RIGHT JOIN (SELECT cereal_id, COUNT(*) AS downvote_cnt FROM vote WHERE vote_value = -1 GROUP BY cereal_id) B)
                    )
                    SELECT cereal_id, name, type, (IFNULL(upvote_cnt, 0)-IFNULL(downvote_cnt, 0)) as full_score FROM cereal_info NATURAL LEFT JOIN total_score ORDER BY full_score DESC, name";
        }
        $statement = $db->prepare($query);
        $statement->execute();
        $cereals = $statement->fetchAll();
        $statement->closeCursor();
        return $cereals;
    }

    function sort_by_calories($asc) {
        global $db;

        if ($asc){
            $query = "SELECT cereal_id, name, type FROM cereal_info NATURAL JOIN nutritional_statement ORDER BY calories ASC;";
        } else {
            $query = "SELECT cereal_id, name, type FROM cereal_info NATURAL JOIN nutritional_statement ORDER BY calories DESC;";
        }
        $statement = $db->prepare($query);
        $statement->execute();
        $cereals = $statement->fetchAll();
        $statement->closeCursor();
        return $cereals;
    }

    function sort_by_protein($asc) {
        global $db;

        if ($asc){
            $query = "SELECT cereal_id, name, type FROM cereal_info NATURAL JOIN nutritional_statement ORDER BY protein ASC;";
        } else {
            $query = "SELECT cereal_id, name, type FROM cereal_info NATURAL JOIN nutritional_statement ORDER BY protein DESC;";
        }
        $statement = $db->prepare($query);
        $statement->execute();
        $cereals = $statement->fetchAll();
        $statement->closeCursor();
        return $cereals;
    }

    function sort_by_fat($asc) {
        global $db;

        if ($asc){
            $query = "SELECT cereal_id, name, type FROM cereal_info NATURAL JOIN nutritional_statement ORDER BY fat ASC;";
        } else {
            $query = "SELECT cereal_id, name, type FROM cereal_info NATURAL JOIN nutritional_statement ORDER BY fat DESC;";
        }
        $statement = $db->prepare($query);
        $statement->execute();
        $cereals = $statement->fetchAll();
        $statement->closeCursor();
        return $cereals;
    }

    function filter_cereal_type($type) {
        global $db;
        $query = "SELECT * FROM cereal_info WHERE type=:type;";
        $statement = $db->prepare($query);
        $statement->bindValue(':type', $type);
        $statement->execute();
        $cereals = $statement->fetchAll();
        $statement->closeCursor();
        return $cereals;
    }
?>