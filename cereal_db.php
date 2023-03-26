<?php
    function get_all_cereals(){
        global $db; //use global db from connect-db.php

        // find email from user_information
        $query = "SELECT * FROM cereal_info";
        $statement = $db->prepare($query);
        $statement->execute();
    
        $cereals = $statement->fetchAll();
        $statement->closeCursor();
        return $cereals;
    }
    function get_cereal_info($cereal_id){
        global $db; //use global db from connect-db.php

        // find cereal from cereal_id
        $query = "SELECT * FROM cereal_info WHERE cereal_id=:cereal_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':cereal_id', $cereal_id);
        $statement->execute();
    
        $cereal_info = $statement->fetch();

        if($cereal_info['type']==='C'){
            $cereal_info['type']='Cold';
        }
        else if($cereal_info['type']==='H'){
            $cereal_info['type']='Hot';
        }

        $statement->closeCursor();
        return $cereal_info;
    }

    function get_cereal_manufacturer($cereal_name){
        global $db; //use global db from connect-db.php

        // find cereal manufacturer from cereal name
        $query = "SELECT * FROM cereal_manufacturer WHERE name=:cereal_name";
        $statement = $db->prepare($query);
        $statement->bindValue(':cereal_name', $cereal_name);
        $statement->execute();
    
        $cereal_manu = $statement->fetch();

        $statement->closeCursor();
        return $cereal_manu;
    }

    function get_cereal_nutrition($cereal_id){
        global $db; //use global db from connect-db.php

        // find cereal nutrition from cereal_id
        $query = "SELECT * FROM nutritional_statement WHERE cereal_id=:cereal_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':cereal_id', $cereal_id);
        $statement->execute();
    
        $cereal_nutrition = $statement->fetch();
        $statement->closeCursor();
        return $cereal_nutrition;
    }
?>