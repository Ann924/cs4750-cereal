<?php
    function get_by_query($query_search) {
        global $db;

        $query = "SELECT * FROM cereal_info WHERE name LIKE CONCAT( '%', :query_search, '%')";
        $statement = $db->prepare($query);
        $statement->bindValue(':query_search', $query_search);
        $statement->execute();
        $cereals = $statement->fetchAll();
        $statement->closeCursor();
        return $cereals;
    }

    function get_most_upvotes() {
        global $db;
        $query = "WITH num_upvotes AS (SELECT cereal_id, COUNT(*) AS upvote_cnt FROM vote WHERE vote_value = 1 GROUP BY cereal_id) SELECT * FROM cereal_info NATURAL JOIN num_upvotes ORDER  BY upvote_cnt ASC";
        $statement = $db->prepare($query);
        $statement->execute();
        $cereals = $statement->fetchAll();
        $statement->closeCursor();
        return $cereals;
    }
?>