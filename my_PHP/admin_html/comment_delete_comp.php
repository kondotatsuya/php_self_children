<?php
session_start();

require_once("../config/config.php");
require_once("../model/Board.php");

try {
    // MySQLへの接続
  $trouble = new Board($host, $dbname, $user, $pass);
  $trouble->connectDb();

  //削除処理
  if(isset($_GET['id'])){
    $trouble->delete_com($_GET['id']);
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

}catch (PDOException $e) {
  echo "接続失敗: " . $e->getMessage() . "\n";
  exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" href="../css/base2.css">
<link rel="stylesheet" href="../css/comp.css?v=3.5">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>子育てお悩み相談室　コメント削除完了</title>
</head>
<body>
  <div class="footerFixed">

<?php require ("header2.php"); ?>

  <div id="wrapper">
    <img class="comp_img" src="../img/comment_delete.png" alt="コメントを削除しました" style="width: 45%;">
    <br>
    <a href="javascript:history.back()"><img src="../img/page_back.png" class="to_img"></a>
    <br>
    <a href="admin_mypage.php"><img class="to_img" src="../img/admin_top.png" alt"管理者トップへ"></a>
  </div>
  <br>

  <?php require ("footer.php"); ?>
  </div>
</body>
</html>
