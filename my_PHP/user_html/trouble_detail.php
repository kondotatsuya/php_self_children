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
      header('location: login.php');
      exit;
    }
    $result = $trouble->show($_GET['detail']);
    $comment = $trouble->comFindAll($_GET['detail']);
    $ck = $trouble->keep_ck($_SESSION['User']['id'],$_GET['detail']);

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
<script type="text/javascript" src="../js/jquery.js"></script>
<script>

  $(function(){
   $('.keep').click(function() {
     var user_id = <?php echo $_SESSION["User"]["id"]; ?>;
     var trouble_id = <?php echo $_GET['detail']; ?>;

     if($(this).hasClass("on")){
       $(this).removeClass("on");
       $(this).addClass("off");
       $(this).text("チェックする");

       $.ajax({
         url:'ajax_keepDel.php',
         type:'POST',
         data:{
           "user_id" : user_id,
           "trouble_id" : trouble_id
         }
       })
        .done(function(data){
        alert("チェックを解除しました");
       })
        .fail(function(data){
        alert("失敗");
       });
     }else{
   $(this).removeClass("off");
   $(this).addClass("on");
   $(this).text("チェック済み");
   $.ajax({
     url:'ajax_keepAdd.php',
     type:'POST',
     data:{
       "user_id" : user_id,
       "trouble_id" : trouble_id
     }
   })
    .done(function(data){
    alert("チェックしました");

   })
    .fail(function(data){
    alert("登録できなかった");
   });

 }
});
});

</script>
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
      <?php if(($result['user_id']) === ($_SESSION['User']['id'])):?>
        <p class="poster">投稿者：あなた</p>
      <?php else: ?>
        <p class="poster">投稿者：<a href="user_detail.php?user=<?= ($result['user_id']); ?>"><?php print(htmlspecialchars($result['user_name'],ENT_QUOTES)) ?>さん</a></p>
      <?php endif ?>
      <div class="trouble">
        <p class="trouble_conte"><?php print(htmlspecialchars($result['body'],ENT_QUOTES)) ?></p>
      </div>
    </div>

    <?php if(($result['user_id']) == ($_SESSION['User']['id'])):?>

    <?php else: ?>
    <form class="favorite_b" action="" method="post">
      <?php if($ck == 0):?>
      <button type="button" class="keep off" name="favorite">
        チェックする
      </button>
      <?php else:?>
      <button type="button" class="keep on" name="favorite">
        チェック済み
      </button>
      <?php endif;?>
    </form>
    <?php endif ?>

  </div>
  <div id="content2">
    <img class="title_img" src="../img/all_comment.png" alt="">
    <br>
    <?php if(!$comment):?>
      <p class="not_post">まだ投稿がありません</p>
    <?php endif ?>
    <?php foreach($comment as $row): ?>
    <div class="user_comment">
      <div class="detail">
          <?php if(!empty($row["img"])):?>
            <img class="img" src='../user_img/<?= $row["img"] ?>'>
          <?php else: ?>
            <img class="img" src='../user_img/profile_icon.png'>
          <?php endif ?>
          <li>
              <p class="create"><?php print(htmlspecialchars($row['created_at'],ENT_QUOTES)) ?></p>
              <?php if(($row['user_id']) === ($_SESSION['User']['id'])):?>
                <p class="user_name">投稿者：あなた</p>
              <?php else: ?>
                <p class="user_name">投稿者：<a href="user_detail.php?user=<?= ($row['user_id']); ?>"><?php print(htmlspecialchars($row['user_name'],ENT_QUOTES)) ?>さん</a></p>
              <?php endif ?>            <br>
            <p class="comment"><?php print(htmlspecialchars($row['comment'],ENT_QUOTES)) ?></p>
            <br>
          </li>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
  <div id=content3>
    <form class="form" action="" method="post" >
      <img src="../img/comment_post.png" class="title_img2"　alt="コメントを投稿する">
      <br>
      <textarea class="textarea" name="comment" rows="8" cols="40" placeholder="コメント"></textarea>
      <br>
      <?php if(isset($message)) echo "<p class='error'>".$message ?></p>
      <br>
      <input type="submit" name="btn1" class="form_button" value="この内容で投稿する" onClick="if(!confirm('コメントしますか？')) return false;">
    </form>
  </div>
  <br><br>

</div>
<?php require ("footer.php"); ?>
</div>
</body>
</html>
