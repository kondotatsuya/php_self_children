<?php
session_start();

require_once("../config/config.php");
require_once("../model/User.php");


try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  if($_POST) {

    $result = $user->login($_POST);

    if(!empty($result)) {
      $_SESSION['User'] = $result;
      if ($_SESSION['User']['role'] == 0) {
        header('Location: /my_PHP/user_html/mypage.php');
        exit;
      } elseif ($_SESSION['User']['role'] == 1) {
        header('Location: /my_PHP/admin_html/admin_mypage.php');
        exit;
      } else {
        $message = "ログインできませんでした";
      }
    }
  }


} catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}

 ?>

<!DOCTYPE html>
<html lang="ja" >
<link rel="stylesheet" href="../css/login.css?<?php echo date("YmdHis"); ?>">
<link rel="stylesheet" href="../css/base.css?<?php echo date("YmdHis"); ?>">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/validate.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>子育て悩み相談サイト　ログインページ</title>
<body>
<div class="footerFixed">

<?php require ("header1.php"); ?>

  <div id="wrapper">
    <img class="main_img" src="../img/main_img.png" alt="">
    <div id="container">
        <form name="form" class="login_form" method="post">
          <input type="mail" name="mail" placeholder="メールアドレス">
          <br><br>
          <input type="password" name="password" placeholder="パスワード">
          <br><br><br>
          <button type="submit" name="login" id="login-button">ログイン</button>
        </form>
        <?php if(isset($message)){ print $message;}?>
    </div>
      <p class="forget"><a href="reset.php">パスワードを忘れた方はこちら</a></p>
    <div class="newregister">
      <a href="register.php">
        <img src="../img/register.png"  class="register" alt="">
      </a>
    </div>
  </div>

  <?php require ("footer.php"); ?>
</div>
</body>
</html>
