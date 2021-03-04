<?php

require_once("../config/config.php");
require_once("../model/User.php");

session_start();


try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

    $post = $user->findById($_SESSION['User']['id']);

    if($_SESSION['User']['role'] == 0) {
        $result['User'] = $post;
    }
    //ログアウト処理

    if(isset($_GET['logout'])){
      //セッション情報を破棄
      $_SESSION = array();
    }

  if(!isset($_SESSION['User'])) {
    header('location: login.php');
    exit;
  }else{
    $myTroFindAll = $user->myTroFind($_SESSION['User']['id']);
    $keep = $user->keep_trouble($_SESSION['User']['id']);
  }

} catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="ja" >
<link rel="stylesheet" href="../css/mypage.css?<?php echo date("YmdHis"); ?>">
<link rel="stylesheet" href="../css/base2.css?<?php echo date("YmdHis"); ?>">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>子育て悩み相談サイト　マイページ</title>
<body>
  <div class="footerFixed">
  <?php require ("header2.php"); ?>

    <div id="wrapper">
      <div id="profile">
        <?php if(!empty($result['User']["img"])):?>
          <img class="user_img" src='../user_img/<?= $result['User']["img"] ?>'>
        <?php else: ?>
          <img class="user_img" src='../user_img/profile_icon.png'>
        <?php endif ?>
         <a href="profile_edit.php?edit=<?= ($_SESSION['User']['id']);?>" class="edit">プロフィール編集</a>
        <div class="user_status">
          <p class="user_name"><?php if(isset($_SESSION['User']['user_name'])){ echo $_SESSION['User']['user_name'];}else echo $result['User']['user_name'];?>のマイページ</p>
        </div>
      </div>

      <div id="container">
        <div id="content_wrapper">
            <div class="content1">
              <img src="../img/my_trouble.png?<?php echo date("YmdHis");?>" class="title" alt="" style="width: 55%;">
            </div>
            <ul class="title_all">
              <?php if(!$myTroFindAll):?>
                <p class="not_post">まだ投稿がありません</p>
              <?php endif ?>
              <?php foreach($myTroFindAll as $myTroFind) { ?>
                <li>
                <a href="trouble_detail.php?detail=<?= ($myTroFind['id']);?>"><?php print(htmlspecialchars($myTroFind['title'],ENT_QUOTES)) ?></a>
                <p class="time"><?php print(htmlspecialchars($myTroFind['created_at'],ENT_QUOTES)) ?></p>
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
