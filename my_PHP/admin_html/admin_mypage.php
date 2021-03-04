<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

//ログアウト処理
if(isset($_GET['logout'])){
  //セッション情報を破棄
  $_SESSION = array();
}

// ログイン画面を経由しているか
if(!isset($_SESSION['User'])) {
  header('Location: /my_PHP/user_html/login.php');
  exit;
}

try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  $userFindAll = $user->userFindAll();


} catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="ja" >
<link rel="stylesheet" href="../css/favorite.css?<?php echo date("YmdHis"); ?>">
<link rel="stylesheet" href="../css/base2.css?<?php echo date("YmdHis"); ?>">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>子育て悩み相談サイト　お気に入り一覧</title>
<body>
<div class="footerFixed">
<?php require ("header2.php"); ?>

<div id="wrapper">
  <div id="favorite">
    <img src="../img/user_all.png"  class="title_img_admin" alt="">
    <div id="contents_wrapper">
      <?php foreach($userFindAll as $row) { ?>
      <div class="content">
        <a href="user_detail_admin.php?user=<?= ($row['id']);?>">
          <p class="time"><?php print(htmlspecialchars($row['user_name'],ENT_QUOTES)) ?></p>
          <?php if(!empty($row["img"])):?>
            <img class="user_img" src='../user_img/<?= $row["img"] ?>'>
          <?php else: ?>
            <img class="user_img" src='../user_img/profile_icon.png'>
          <?php endif ?>
        </a>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

<?php require ("footer.php"); ?>
</div>
</body>
</html>
