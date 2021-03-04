<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");


try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  if($_POST) {
    $user->favAdd($_POST);
  }

} catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}
