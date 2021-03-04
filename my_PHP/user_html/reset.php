<?php

require_once("../config/config.php");
require_once("../model/User.php");

session_start();


try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();
  if($_POST) {
    if($_POST['new_password'] == $_POST['password'] ) {
      $user->passreset($_POST);
      header('location: reset_comp.php');
    }
    if($_POST['new_password'] != $_POST['password'] ) {
      $message = '<p style="color: red;text-align:center;">'.'パスワードが一致しません'.'</p>';
    }
  }
  //該当しなかったら実行しない
  } catch (PDOException $e){
    echo $e->getMessage();
    exit;
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
  <title>子育てお悩み相談室　パスワードリセット</title>
</head>
<body>
  <div class="footerFixed">

<?php require ("header1.php"); ?>

  <div id="wrapper">
    <form action="" method="post">
      <img src="../img/reset.png?<?php echo date("YmdHis");?>" alt="新規登録">
      <div id="container">
        <div class="error">
        </div>
        <br>
        <input id="mail" type="mail" name="mail" placeholder="メールアドレス">
        <br><br>
        <input id="password" type="password" name="new_password" placeholder="新しいパスワード" required>
        <br><br>
        <input id="password" type="password" name="password" placeholder="パスワード再入力" required>
        <br><br>
        <button type="submit" id="login-button" onClick="if(!confirm('パスワードを再登録します')) return false;">登録する</button>
        <br><br>
        <?php if(isset($message)) print $message;?>
      </div>
    </form>
  </div>

  <div id="footer">
    <p>-CopyRight.2020-</p>
  </div>
</div>

</body>
</html>
