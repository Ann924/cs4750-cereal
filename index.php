<?php
session_start();

if(!isset($_SESSION["loggedIn"])){
  $_SESSION['loggedIn']=False;
  header("Location: login.php");
  die;
}
else if ($_SESSION["loggedIn"]) {
  header("Location: create_new_cereal.php");
  die;
} else {
  header("Location: login.php");
  die;
}

?>