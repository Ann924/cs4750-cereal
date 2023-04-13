<?php

include("user_db.php");
include("connect_db.php");

function update_user_validation($email, $password)
{

    global $db; //use global db from connect-db.php

    try{
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE user_validation SET password = :password WHERE email = :email";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $hashed_password);

        $success = $statement->execute();
    }
    catch (Exception $e){
        $success = False;
    }
    finally{
        $statement->closeCursor();
    }

    return $success;
}

function update_current_db(){
    global $db;

    $query = "SELECT * FROM user_validation";
    $statement = $db->prepare($query);

    $success = $statement->execute();

    $users = $statement->fetchAll();

    foreach ($users as $user){
        if (strlen($user['password'])<20){
            echo $user['password'];
            echo " ";
            update_user_validation($user['email'], $user['password']);
        }
    }
}

update_current_db();

?>