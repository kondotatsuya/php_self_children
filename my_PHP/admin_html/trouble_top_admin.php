<?php
session_start();

require_once("../config/config.php");
require_once("../model/Board.php");

try {
    $trouble = new Board($host, $dbname, $user, $pass);
    $trouble->connectDb();

      if($_POST){
        if(empty($_POST['title'] && $_POST['body'])) {
          $message = '未入力な項目があります。';
        } else {
          $trouble->troubles_add($_POST,$_SESSION['User']);
          header('location: trouble_comp.php');
        }
      }

    //ログアウト処理
    if(isset($_GET['logout'])){
      //セッション情報を破棄
      $_SESSION = array();
    }

    if(!isset($_SESSION['User'])) {
      header('location: /my_PHP/user_html/login.php');
      exit;
    } else {
      $troFindAll = $trouble->troFindAll();
    }
    $db = null;
    $sth = null;
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja" >
<link rel="stylesheet" href="../css/trouble_top.css?<?php echo date("YmdHis"); ?>">
<link rel="stylesheet" href="../css/base2.css?<?php echo date("YmdHis"); ?>">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>子育て悩み相談サイト　悩み投稿トップ</title>
<body>
<div class="footerFixed">
<?php require ("header2.php"); ?>

<div id="wrapper">

  <div class="content">
    <div class="trouble_all">
      <img src="../img/trouble_all.png?<?php echo date("YmdHis"); ?>" class="title_img" alt="みんなの投稿一覧">
      <?php if(!$troFindAll):?>
        <p class="not_post">まだ投稿がありません</p>
      <?php endif ?>
      <?php foreach($troFindAll as $row) { ?>
        <li>
          <a href="trouble_detail_admin.php?detail=<?= ($row['id']);?>"><span><?php print(htmlspecialchars($row['title'],ENT_QUOTES)) ?></span></a>
          <p class="time"><?php print(htmlspecialchars($row['user_name'],ENT_QUOTES)) ?></p>
          <p class="time"><?php print(htmlspecialchars($row['created_at'],ENT_QUOTES)) ?></p>
        </li>
      <?php } ?>
  </div>
</div>

<?php require ("footer.php"); ?>
</div>
</body>
</html>
