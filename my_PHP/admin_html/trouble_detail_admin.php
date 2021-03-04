<?php
session_start();

require_once("../config/config.php");
require_once("../model/Board.php");

try {
    $trouble = new Board($host, $dbname, $user, $pass);
    $trouble->connectDb();

    if($_POST){
      if(empty($_POST['comment'])) {
        $message = '未入力な項目があります。';
      } else {
        $trouble->comments_add($_POST,$_SESSION['User']);
        header('location: comment_comp.php');
      }
    }
    //ログアウト処理

    if(isset($_GET['logout'])){
      //セッション情報を破棄
      $_SESSION = array();
    }

      if(!isset($_SESSION['User'])) {
        header('location: my_PHP/user_html/login.php');
        exit;
      }
    $result = $trouble->show($_GET['detail']);
    $comment = $trouble->comFindAll($_GET['detail']);
    $count = $trouble->com_count($_GET['detail']);

} catch (PDOException $e) {
    echo "接続失敗: " . $e->geMessage() . "\n";
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja" >
<link rel="stylesheet" href="../css/trouble_detail.css?=<?php echo date("YmdHis"); ?>">
<link rel="stylesheet" href="../css/base2.css?=<?php echo date("YmdHis"); ?>">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>子育て悩み相談サイト　悩み詳細</title>
<body>
<div class="footerFixed">
<?php require ("header2.php"); ?>

<div id="wrapper">
  <div id="content1">
    <?php if(!empty($result["img"])):?>
      <img class="user_img" src='../user_img/<?= $result["img"] ?>'>
    <?php else: ?>
      <img class="user_img" src='../user_img/profile_icon.png'>
    <?php endif ?>
    <div class="detail">
      <p class="title_name"><?php print(htmlspecialchars($result['title'],ENT_QUOTES)) ?></p>
      <p class="create_time"><?php print(htmlspecialchars($result['created_at'],ENT_QUOTES)) ?></p>
      <p class="comment_count">コメント数：<?php print($count); ?>件</p>
      <p class="poster">投稿者：<a href="user_detail_admin.php?user=<?= ($result['user_id']); ?>"><?php print(htmlspecialchars($result['user_name'],ENT_QUOTES)) ?>さん</a></p>
      <div class="trouble">
        <p class="trouble_conte"><?php print(htmlspecialchars($result['body'],ENT_QUOTES)) ?></p>
      </div>
      <br>
      <a href="trouble_delete_comp.php?id=<?= $_GET['detail']?>" onClick="if(!confirm('この投稿を削除しますか？')) return false;"><p style="color:red;text-align:center;">この投稿を削除する</p></a>
    </div>
  </div>

  <div id="content2">
    <img class="title_img" src="../img/all_comment.png" alt="" style="width:250px;">
    <br>
    <?php if(!$comment):?>
      <p class="not_post">まだ投稿がありません</p>
    <?php endif ?>
    <?php foreach($comment as $row) { ?>
    <div class="user_comment">
      <div class="detail">
          <?php if(!empty($row["img"])):?>
            <img class="img" src='../user_img/<?= $row["img"] ?>'>
          <?php else: ?>
            <img class="img" src='../user_img/profile_icon.png'>
          <?php endif ?>
          <li>
            <p class="create"><?php print(htmlspecialchars($row['created_at'],ENT_QUOTES)) ?></p>
            <p class="user_name">投稿者：<a href="user_detail_admin.php?user=<?= ($row['user_id']); ?>"><?php print(htmlspecialchars($row['user_name'],ENT_QUOTES)) ?>さん</a></p>
            <p class="comment"><?php print(htmlspecialchars($row['comment'],ENT_QUOTES)) ?></p>
            <br>
          </li>
      </div>
      <a href="comment_delete_comp.php?id=<?= $row['id']?>" onClick="if(!confirm('このコメントを削除しますか？')) return false;"><p style="color:red;text-align:center;">このコメントを削除する</p></a>
    </div>
  <?php } ?>
  </div>
  <br><br>
</div>
<?php require ("footer.php"); ?>
</div>
</body>
</html>
