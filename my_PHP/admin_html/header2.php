<link rel="stylesheet" href="../css/header2.css?<?php echo date("YmdHis"); ?>">
<script type="text/javascript" src="../js/jquery.js"></script>
<script>


  $(function(){
    $("#humburger_menu").on("click",function(){
      $("#menu_hidden").toggle();
    });
  });

</script>

<div id="header">
  <div class="header_logo">
    <a href="admin_mypage.php">
      <img src="../img/logo.png" alt="ロゴ">
    </a>
  </div>
  <div id="humburger_menu">
    <img src="../img/humburger_menu.png" alt="ハンバーガーメニュー">
  </div>
  <ul id="menu_hidden">
    <li>
      <a href="trouble_top_admin.php">投稿一覧</a>
    </li>
    <li>
      <a href="admin_mypage.php">ユーザー一覧</a>
    </li>
    <li>
    <a href="?logout=1" onClick="if(!confirm('ログアウトしますか？')) return false;">ログアウト</a/a>
    </li>
  </ul>

  <ul class="header_navi">
    <li>
      <a href="trouble_top_admin.php">投稿一覧</a>
    </li>
    <li>
      <a href="admin_mypage.php">ユーザー一覧</a>
    </li>
    <li class="border_right">
    <a href="?logout=1" onClick="if(!confirm('ログアウトしますか？')) return false;">ログアウト</a/a>
    </li>
  </ul>
</div>
