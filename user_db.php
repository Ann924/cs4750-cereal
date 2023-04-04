<?php

function check_user_validation($user_name, $input_password){

    global $db; //use global db from connect-db.php

    // find email from user_information
    $query = "SELECT email FROM user_information WHERE user_name = :user_name";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_name', $user_name);
    $statement->execute();

    $email = $statement->fetch();
    $statement->closeCursor();

    if(!$email){
        return False;
    }

    $email = $email['email'];

    // find password from user_validation given email
    $query = "SELECT password FROM user_validation WHERE email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();

    $user_password = $statement->fetch();
    $statement->closeCursor();

    if(!$user_password){
        return False;
    }

    $user_password = $user_password['password'];

    // check passwords match
    $_SESSION["loggedIn"] = password_verify($input_password, $user_password);
    if ($_SESSION["loggedIn"]){
        $_SESSION["user_name"] = $user_name;
    }
    return $_SESSION["loggedIn"];

}

# email is a foreign key reference to user_validation
function add_user_information($user_name, $email)
{

    global $db; //use global db from connect-db.php

    try{
        $query = "INSERT INTO user_information VALUE (:user_name, :email)";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name);
        $statement->bindValue(':email', $email);

        $success = $statement->execute();
    }
    catch (Exception $e){
        $success = False;
    }
    finally{
        $statement->closeCursor();
    }

    if($success){
        $_SESSION["loggedIn"] = True;
        if ($_SESSION["loggedIn"]){
            $_SESSION["user_name"] = $user_name;
        }
    }

    return $success;

}

function add_user_validation($email, $password)
{

    global $db; //use global db from connect-db.php

    try{
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user_validation VALUE (:email, :password)";
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

?>