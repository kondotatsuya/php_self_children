<?php

require_once("../config/config.php");
require_once("../model/User.php");

session_start();

try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();



} catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
<link rel="stylesheet" href="../css/register_comp.css?<?php echo date("YmdHis"); ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>子育てお悩み相談室　新規登録完了</title>
</head>
<body>
  <div class="footerFixed">

  <?php require ("header1.php"); ?>

    <div id="wrapper">
      <img class="comp_img" src="../img/register_comp.png" alt="登録完了">
      <br>
      <a href="login.php"><img class="to_img" src="../img/to_login.png" alt="ログインページへ"></a>
    </div>

  <?php require ("footer.php"); ?>
  </div>
</body>
</html>
