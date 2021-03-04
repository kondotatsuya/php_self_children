<link rel="stylesheet" href="../css/header2.css?<?php echo date("YmdHis"); ?>">
<script type="text/javascript" src="../js/jquery.js"></script>
<script>


  $(function(){
    $("#humburger_menu").on("click",function(){
      $("#menu_hidden").slideToggle();
    });
  });

</script>

<div id="header">
  <div class="header_logo">
    <a href="mypage.php">
      <img src="../img/logo.png" alt="ロゴ">
    </a>
  </div>
  <div id="humburger_menu">
    <img src="../img/humburger_menu.png" alt="ハンバーガーメニュー">
  </div>
  <ul id="menu_hidden">
    <li>
      <a href="trouble_top.php">悩み相談</a>
    </li>
    <li>
      <a href="favorites.php">お気に入りユーザー</a>
    </li>
    <li>
    <a href="?logout=1" onClick="if(!confirm('ログアウトしますか？')) return false;">ログアウト</a/a>
    </li>
  </ul>

  <ul class="header_navi">
    <li>
      <a href="trouble_top.php">悩み相談</a>
    </li>
    <li>
      <a href="favorites.php">お気に入りユーザー</a>
    </li>
    <li class="border_right">
    <a href="?logout=1" onClick="if(!confirm('ログアウトしますか？')) return false;">ログアウト</a/a>
    </li>
  </ul>
</div>
