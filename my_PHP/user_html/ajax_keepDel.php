<?php

session_start();

require_once("../config/config.php");
require_once("../model/Board.php");


try{
  $trouble = new Board($host, $dbname, $user, $pass);
  $trouble->connectDb();

  if($_POST) {
    $trouble->keepDel($_POST);
  }

} catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}
