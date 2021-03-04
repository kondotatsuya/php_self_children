<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");

try {
    // MySQLへの接続
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  //ログアウト処理

  if(isset($_GET['logout'])){
    //セッション情報を破棄
    $_SESSION = array();
  }

  if(!isset($_SESSION['User'])) {
    header('location: login.php');
    exit;
  }
  $post = $user->findById($_SESSION['User']['id']);

  if($_SESSION['User']['role'] == 0) {
    $result['User'] = $post;
  }

  if($_SESSION['User']){
      if(isset($_GET['edit'])) {
        if($_POST) {
          $result = $user->edit($_POST);
          header('Location: profile_update.php');
          exit;
        }
      }
    }
} catch (PDOException $e) {
  echo "接続失敗: " . $e->getMessage() . "\n";
}
?>
<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" href="../css/base2.css">
<link rel="stylesheet" href="../css/profile_edit.css?<?php echo date("YmdHis"); ?>">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/validate2.js"></script>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>子育てお悩み相談室　アカウント情報</title>
</head>
<body>
<div class="footerFixed">
<?php require ("header2.php"); ?>

<div id="wrapper">
  <div id="edit_wrapper">
    <img src="../img/profile_edit.png" class="title" alt="">
    <br>
    <form action="" method="post">
      <div id="contact_form">
        <?php if(!empty($result['User']["img"])):?>
          <img class="img2" src='../user_img/<?= $result['User']["img"] ?>'>
        <?php else: ?>
          <img class="img2" src='../user_img/profile_icon.png'>
        <?php endif ?>
        <br>
        <p style="text-align:center;">画像をアップロードする</p>
          <input type="file" name="img" id="filename" accept="image/*" class="img_ref">
        <br>
        <input type="hidden" name="id" value="<?php if(isset($result['User'])) echo $result['User']['id'];?>">
        <br>
        <input type="text"  class="input" name="user_name" placeholder="ユーザー名" value="<?php if(isset($result['User'])) echo $result['User']['user_name']?>">
        <br><br>
        <input type="mail" class="input" name="mail" placeholder="メールアドレス" value="<?php if(isset($result['User'])) echo $result['User']['mail']?>">
        <br><br>
        <button type="submit" id="update-button">更新する</button>
        <br>
      </div>
    </form>
    <br>
    <a href="user_delete_comp.php?id=<?=$_SESSION['User']['id']?>" onClick="if(!confirm('<?=$_SESSION['User']['user_name']?>を完全に削除しますか？')) return false;" style="color:red;">アカウントを削除する</a>
    <br>
  </div>
</div>
<?php require ("footer.php"); ?>
</div>
</body>
</html>
