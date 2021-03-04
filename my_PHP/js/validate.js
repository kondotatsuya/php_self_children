$(function () {
  $('#login-button').on('click', function() {
    //名前アラート
    if($('input[name="user_name"]').val() == ''){
      alert('ユーザー名を入力してください');
      return false;
    }

    //メールアドレスアラート
    if($('input[name="mail"]').val() == ''){
      alert('メールアドレスを入力してください');
      return false;
    }
    if(!$('input[name="mail"]').val().match(/.+@.+\..+/g)){
      alert('正しいメールアドレスを入力してください');
      return false;
    }
    if(!$('input[name="password"]').val().match(/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,99}$/i)){
     alert('パスワードは半角英数字含む8文字以上です');
     return false;
   }

  });
});
