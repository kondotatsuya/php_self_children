<?php

require_once("../config/config.php");
require_once("../model/User.php");

session_start();


try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

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

  $result = $user->findById($_GET['user']);

  $userTroFindAll = $user->userTroFind($_GET['user']);
  $keep = $user->keep_trouble($_GET['user']);

} catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="ja" >
<link rel="stylesheet" href="../css/user_detail.css?<?php echo date("YmdHis"); ?>">
<link rel="stylesheet" href="../css/base2.css?<?php echo date("YmdHis"); ?>">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>子育て悩み相談サイト　マイページ</title>
<body>
  <div class="footerFixed">
  <?php require ("header2.php"); ?>

    <div id="wrapper">
      <div id="profile">
        <?php if(!empty($result["img"])):?>
          <img class="user_img" src='../user_img/<?= $result["img"] ?>'>
        <?php else: ?>
          <img class="user_img" src='../user_img/profile_icon.png'>
        <?php endif ?>


        <div class="user_status">
          <p class="user_name"><?php print(htmlspecialchars($result['user_name'],ENT_QUOTES)) ?>のマイページ</p>
          <a href="user_delete_comp.php?id=<?= $result['id']?>" onClick="if(!confirm('このアカウントを完全に削除しますか？')) return false;"><p class="delete">アカウントを削除する</p></a>

        </div>
      </div>

      <div id="container">
        <div id="content_wrapper">
            <div class="content1">
              <img src="../img/user_trouble.png" class="title" alt="">
            </div>
            <ul class="title_all">
              <?php if(!$userTroFindAll):?>
                <p class="not_post">まだ投稿がありません</p>
              <?php endif ?>
              <?php foreach($userTroFindAll as $row) { ?>
                <li>
                <a href="trouble_detail_admin.php?detail=<?= ($row['id']);?>"><?php print(htmlspecialchars($row['title'],ENT_QUOTES)) ?></a>
                <p class="time"><?php print(htmlspecialchars($row['created_at'],ENT_QUOTES)) ?></p>
              </li>
            <?php } ?>
            </ul>
        </div>
        <div id="content_wrapper">
            <div class="content1">
              <img src="../img/keepTro.png?<?php echo date("YmdHis");?>" class="title" alt="" style="width: 65%;">
            </div>
            <ul class="title_all">
              <?php if(!$keep):?>
                <p class="not_post">チェックした投稿がありません</p>
              <?php endif ?>
              <?php foreach($keep as $row) { ?>
                <li>
                <a href="trouble_detail.php?detail=<?= ($row['id']);?>"><?php print(htmlspecialchars($row['title'],ENT_QUOTES)) ?></a>
                <p class="time"><?php print(htmlspecialchars($row['created_at'],ENT_QUOTES)) ?></p>
              </li>
            <?php } ?>
            </ul>
        </div>

      </div>
    </div>
  <?php require ("footer.php"); ?>
</div>

</body>
</html>
