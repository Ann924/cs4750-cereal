<?php 
    function get_all_clubs(){
        global $db; //use global db from connect-db.php

        $query = "SELECT * FROM club";
        $statement = $db->prepare($query);
        $statement->execute();

        $clubs = $statement->fetchAll();
        $statement->closeCursor();
        return $clubs;
    }

    function get_club_info($club_id){
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

    function check_if_user_in_club($user_name, $club_id) {
        global $db; //use global db from connect-db.php

        $query = "SELECT * FROM joins_club WHERE user_name=:user_name AND club_id=:club_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name);
        $statement->bindValue(':club_id', $club_id);
        
        $success = $statement->execute();

        if($statement->fetch()) {
            echo "user is in club";
            return TRUE;
        }
        echo "user is not in club";
        return FALSE;
    }

    function join_club($user_name, $club_id) {
        global $db; //use global db from connect-db.php

        try {
            $query = "INSERT INTO joins_club VALUES(:user_name, :club_id);";
            $statement = $db->prepare($query);
            $statement->bindValue(':user_name', $user_name);
            $statement->bindValue(':club_id', $club_id);
            
            $success = $statement->execute();
        }
        catch (Exception $e){
            $success = False;
        }
        finally {
            $statement->closeCursor();
        }
        
        return $success;
    }

    function leave_club($user_name, $club_id) {
        global $db; //use global db from connect-db.php

        try {
            $query = "DELETE FROM joins_club WHERE user_name = :user_name AND club_id = :club_id;";
            $statement = $db->prepare($query);
            $statement->bindValue(':user_name', $user_name);
            $statement->bindValue(':club_id', $club_id);
            
            $success = $statement->execute();
        }
        catch (Exception $e){
            $success = False;
        }
        finally {
            $statement->closeCursor();
        }
        
        return $success;
    }

    function get_clubs_by_user($user_name) {
        global $db; //use global db from connect-db.php

        // echo $user_name;

        $query = "SELECT * FROM joins_club NATURAL JOIN club WHERE user_name=:user_name";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name);
        $statement->execute();

        $clubs = $statement->fetchAll();

        // echo "here";
        foreach($clubs as $c) {
            // echo "club";
            // echo $c["club_title"];
        }

        $statement->closeCursor();
        return $clubs;
    }

?>