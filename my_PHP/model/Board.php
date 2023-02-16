<?php
require_once("DB.php");

class Board extends DB {

  // 掲示板へ投稿
  public function troubles_add($trouble,$troUser) {
    $sql = 'INSERT INTO troubles(title, body, user_id, created_at) VALUES(:title, :body, :user_id, :created_at);';
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':title' => $trouble['title'],
      ':body' => $trouble['body'],
      ':user_id' => $troUser['id'],
      ':created_at' => date('Y-m-d H:i:s')
    );
    $stmt->execute($params);
  }

  // 一覧表示
  public function troFindAll() {
    $sql = 'SELECT  t.id,t.title,t.body,t.user_id,t.created_at,u.user_name FROM troubles t JOIN users u ON t.user_id = u.id ORDER BY created_at DESC';
    $stmt = $this->connect->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  public function show($id) {
    $sql = 'SELECT t.id,t.user_id, t.title,t.body,t.created_at,u.user_name ,u.id,u.img FROM troubles t JOIN users u ON t.user_id = u.id where t.id = :id';
    $stmt = $this->connect->prepare($sql);
    $params = array(':id' => $id);
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
   }
  // コメント投稿
  public function comments_add($comment,$comUser) {
    $sql = 'INSERT INTO comments(comment, user_id, trouble_id,created_at) VALUES(:comment, :user_id, :trouble_id, :created_at);';
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':comment' => $comment['comment'],
      'trouble_id' => $_GET['detail'],
      ':user_id' => $comUser['id'],
      ':created_at' => date('Y-m-d H:i:s')
    );
    $stmt->execute($params);
  }

  // コメント表示
  public function comFindAll($id) {
    $sql = 'SELECT c.id, c.comment, c.created_at,u.user_name, u.img,c.user_id FROM comments c join users u on c.user_id = u.id where c.trouble_id = :id ORDER BY created_at DESC';
    $stmt = $this->connect->prepare($sql);
    $params = array(':id' => $id);
    $stmt->execute($params);
    $result = $stmt->fetchAll();
    return $result;
  }


  // 悩み削除処理
  public function delete($id = null){
    if(isset($id)){
      $sql = "DELETE t,c FROM troubles t join comments c on t.id = c.trouble_id WHERE t.id = :id";
      $stmt = $this->connect->prepare($sql);
      $params = array(':id' => $id);
      $stmt->execute($params);
    }
  }

  // コメント削除処理
  public function delete_com($id = null){
    if(isset($id)){
      $sql = "DELETE FROM comments  WHERE id = :id";
      $stmt = $this->connect->prepare($sql);
      $params = array(':id' => $id);
      $stmt->execute($params);
    }
  }


    //チェックリスト登録
    public function keepAdd($arr){
      $sql ="INSERT INTO keeps (user_id, trouble_id, created_at) VALUES (:user_id, :trouble_id, :created_at)";
      $stmt = $this->connect->prepare($sql);
      $params = array(
        ':user_id'=>$arr['user_id'],
        ':trouble_id'=>$arr['trouble_id'],
        ':created_at'=>date('Y-m-d H:i:s')
      );
      $stmt->execute($params);
    }

    //チェックリスト削除
    public function keepDel($arr){
      $sql = "DELETE FROM keeps WHERE user_id = :user_id AND trouble_id = :trouble_id";
      $stmt = $this->connect->prepare($sql);
      $stmt->execute(array(
        ':user_id'=>$arr['user_id'],
        ':trouble_id'=>$arr['trouble_id']
      ));
      $stmt->execute($params);
    }

    //チェックリスト保持
    public function keep_ck($user_id,$trouble_id){
      $sql = "SELECT * FROM keeps WHERE user_id = :user_id AND trouble_id = :trouble_id";
      $stmt = $this->connect->prepare($sql);
      $params = array(
        ':user_id'=>$user_id,
        ':trouble_id'=>$trouble_id
      );
      $stmt->execute($params);
      $result = $stmt->rowCount();
      return $result;
    }
    //チェックリスト参照
    public function keep_trouble($user_id) {
      $sql = 'SELECT u.user_name, k.trouble_id FROM keeps k JOIN users u ON k.user_id = u.id WHERE k.user_id = :user_id';
      $stmt = $this->connect->prepare($sql);
      $params = array(':user_id' => $user_id);
      $stmt->execute($params);
      $result = $stmt->fetchAll();
      return $result;
    }
    //コメント数表示
    public function com_count($trouble_id){
      $sql = 'SELECT count(c.id) FROM troubles  t JOIN comments  c ON t.id = c.trouble_id where t.id = :trouble_id';
      $stmt = $this->connect->prepare($sql);
      $params = array(':trouble_id' => $trouble_id);
      $stmt->execute($params);
      $count = $stmt->fetchColumn();
      return $count;
    }
}
?>
