<?php

require_once("../config/config.php");
require_once("../model/User.php");

session_start();


try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  if($_POST){
    $message = $user->varidate($_POST);
    if(empty($message['user_name']) && empty($message['mail']) && empty($message['password'])){
      $user->add($_POST);
      header('location: register_comp.php');
    }
  }


} catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}


?>
<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
<link rel="stylesheet" href="../css/register.css?<?php echo date("YmdHis"); ?>">
<link rel="stylesheet" href="../css/footer.css?v=3">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/validate.js"></script>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <title>子育てお悩み相談室　新規登録</title>
</head>
<body>
  <div class="footerFixed">

<?php require ("header1.php"); ?>

  <div id="wrapper">
    <form action="" method="post">
      <img src="../img/new_register.png" alt="新規登録">
      <div id="container">
        <div class="error">
          <?php if(isset($message['user_name'])) echo "<p class='error'>".$message['user_name']?>
          <?php if(isset($message['mail'])) echo "<p class='error'>".$message['mail'] ?>
          <?php if(isset($message['password'])) echo "<p class='error'>".$message['password'] ?>
        </div>
        <br>
        <input type="text" name="user_name" placeholder="ユーザー名">
        <br><br>
        <input id="mail" type="mail" name="mail" placeholder="メールアドレス">
        <br><br>
        <input id="password" type="password" name="password" placeholder="パスワード">
        <br><br>
        <button type="submit" id="login-button" onClick="if(!confirm('登録しますか？')) return false;">登録する</button>
        <br><br>
      </div>
    </form>
  </div>
  <?php require ("footer.php"); ?>
</div>

</body>
</html>
