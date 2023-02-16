<?php

require_once("DB.php");

class User extends DB {

// ログイン機能
public function login($arr){
  $sql = 'SELECT * FROM users WHERE mail = :mail AND password = :password';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':mail' => $arr['mail'],
    ':password' => md5($arr['password'])
  );
  $stmt->execute($params);
  $result = $stmt->fetch();
  return $result;
}

//ユーザ登録

public function add($arr) {
  $sql = "INSERT INTO users(user_name, mail, password, role, created_at) VALUES(:user_name, :mail, :password, :role, :created_at)";
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':user_name' => $arr['user_name'],
    ':mail' => $arr['mail'],
    ':password' => md5($arr['password']),
    ':role' => 0,
    ':created_at' => date('Y-m-d H:i:s')
  );
  $stmt->execute($params);
}

  //　ユーザー情報の入力チェック
  public function varidate($arr){
    $message = array();
    //ユーザーネーム
    if(empty($arr['user_name'])){
      $message['user_name'] = 'ユーザー名を入力してください。';
    }
    //メールアドレス
    if(empty($arr['mail'])){
      $message['mail'] = 'メールアドレスを入力してください。';
    }else{
      if(!filter_var($arr['mail'], FILTER_VALIDATE_EMAIL)) {
        $message['mail'] = '正しいメールアドレス形式で入力してください。';
      }
    }
    //パスワード
    if(empty($arr['password'])){
      $message['password'] = 'パスワードを入力してください。';
    }else{
      if(strlen($arr['password']) < 8) {
      $message['password'] = 'パスワードは８文字以上入力してください。';
      }
    }
    return $message;
  }

    // 条件付き参照 select
    public function findById($id) {
      $sql = 'SELECT * FROM users WHERE id = :id';
      $stmt = $this->connect->prepare($sql);
      $params = array(':id' => $id);
      $stmt->execute($params);
      $result = $stmt->fetch();
      return $result;
    }


    //登録情報編集
  public function edit($arr) {
    $sql = 'UPDATE users SET user_name = :user_name, mail = :mail, password = :password, img = :img WHERE id = :id';
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':id' => $arr['id'],
      ':user_name' => $arr['user_name'],
      ':mail' => $arr['mail'],
      ':password' => md5($arr['password']),
      ':img' => $arr['img'],
     );
    $stmt->execute($params);
  }

  // ユーザー退会処理
  public function delete($id = null){
    if(isset($id)){
      $sql = "DELETE FROM users WHERE id = :id";
      $stmt = $this->connect->prepare($sql);
      $params = array(':id' => $id);
      $stmt->execute($params);
    }
  }

   // パスワードリセット　
   public function passreset($arr) {
    $sql = "UPDATE users SET mail = :mail, password = :password WHERE mail = :mail";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':mail'=>$arr['mail'],
      ':password'=>md5($arr['password']));
    $stmt->execute($params);
   }


  public function myTroFind($id) {
    $sql = 'SELECT * FROM troubles WHERE user_id = :user_id ORDER BY created_at DESC' ;
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':user_id' => $id,
    );
    $stmt->execute($params);
    $result = $stmt->fetchALL();
    return $result;
  }

  public function userTroFind($id) {
    $sql = 'SELECT * FROM troubles WHERE user_id = :user_id ORDER BY created_at DESC' ;
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':user_id' => $id,
    );
    $stmt->execute($params);
    $result = $stmt->fetchALL();
    return $result;
  }
  //全てのユーザー
  public function userFindAll() {
    $sql = 'SELECT  * FROM users where role = 0 ORDER BY created_at';
    $stmt = $this->connect->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  //お気に入り登録
  public function favAdd($arr){
    $sql ="INSERT INTO favorites (user_id, fav_user_id, created_at) VALUES (:user_id, :fav_user_id, :created_at)";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':user_id'=>$arr['user_id'],
      ':fav_user_id'=>$arr['fav_user_id'],
      ':created_at'=>date('Y-m-d H:i:s')
    );
    $stmt->execute($params);
  }

  //お気に入り削除 delete
  public function favDel($arr){
    $sql = "DELETE FROM favorites WHERE user_id = :user_id AND fav_user_id = :fav_user_id";
    $stmt = $this->connect->prepare($sql);
    $stmt->execute(array(
      ':user_id'=>$arr['user_id'],
      ':fav_user_id'=>$arr['fav_user_id']
    ));
    $stmt->execute($params);
  }

  //お気に入りを保持
  public function favorite_ck($user_id,$fav_user_id){
    $sql = "SELECT * FROM favorites WHERE user_id = :user_id AND fav_user_id = :fav_user_id";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':user_id'=>$user_id,
      ':fav_user_id'=>$fav_user_id
    );
    $stmt->execute($params);
    $result = $stmt->rowCount();
    return $result;
  }
  //お気に入り参照
  public function fav_user($user_id) {
    $sql = 'SELECT u.user_name,u.img, f.fav_user_id FROM favorites f JOIN users u ON f.fav_user_id = u.id WHERE f.user_id = :user_id';
    $stmt = $this->connect->prepare($sql);
    $params = array(':user_id' => $user_id);
    $stmt->execute($params);
    $result = $stmt->fetchAll();
    return $result;
  }

  //お気に入り参照
  public function keep_trouble($user_id) {
    $sql = 'SELECT t.title, t.created_at, t.id FROM keeps k JOIN users u ON k.user_id = u.id join troubles t on k.trouble_id = t.id WHERE k.user_id = :user_id';
    $stmt = $this->connect->prepare($sql);
    $params = array(':user_id' => $user_id);
    $stmt->execute($params);
    $result = $stmt->fetchAll();
    return $result;
  }


}
