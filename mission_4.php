<?php
  //データベースへの接続
  $dsn ='mysql:dbname=データベース名;host=localhost';
  $user ='ユーザー名';
  $password ='パスワード';
  $pdo = new PDO($dsn,$user,$password);

  //テーブルの作成
  $sql="CREATE TABLE user2"
  ."("
  ."id INT AUTO_INCREMENT,"
  ."name char(32),"
  ."comment TEXT,"
  ."time DATE,"
  ."password char(30),"
  ."INDEX(id)"
  .");";
  $stml = $pdo->query($sql);

  //作成できたかの確認
  /*$sql ='SHOW TABLES';
  $result = $pdo -> query($sql);
  foreach ($result as $row){
    echo $row[0];
    echo '<br>';
  }
  echo "<hr>";*/

  //テーブルの中身を確認
  /*$sql ='SHOW CREATE TABLE user2';
  $result = $pdo -> query($sql);
  foreach ($result as $row){
    print_r($row);
  }
  echo "<hr>";*/

  //データの入力
  $sakujo = $_POST['sakujo'];
  $hensyu = $_POST['hensyu'];
  $pass1 = $_POST['pass1'];
  $pass2 = $_POST['pass2'];
  $pass3 = $_POST['pass3'];
  $hensyuyou = $_POST['hensyuyou'];
  if($sakujo == "削除対象番号" && $hensyu == "編集対象番号" && $pass2 =="パスワード" && $pass3 = "パスワード" && empty($hensyuyou)){
    $sql = $pdo -> prepare("INSERT INTO user2 (name,comment,time,password) VALUES(:name,:comment,:time,:password)");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $sql -> bindParam(':time', $time, PDO::PARAM_STR);
    $sql -> bindParam(':password', $password, PDO::PARAM_STR);

    $name = $_POST['name'];;
    $comment = $_POST['comment'];;
    $time = date("Y/m/d H:i:s");;
    $password = $_POST['pass1'];;
    $sql -> execute();


  //削除機能
  }elseif($sakujo != "削除対象番号"){
    $sql = "SELECT * FROM user2 where id = $sakujo";
    $results = $pdo -> query($sql);
    if(is_array($results)){
      foreach ($results as $row){
      $moji1 = $row['name'];
      $moji2 = $row['comment'];
      $moji0 = $row['password'];
  }}
  if($pass2 == $moji0){
    $sql = "delete from user2 where id=$sakujo";
    $result = $pdo->query($sql);
  }elseif($pass2 != $moji0){
    echo "パスワードが違います。";
}


  //編集機能
  }elseif($hensyu != "編集対象番号"){
    $sql = "SELECT * FROM user2 where id = $hensyu";
    $results = $pdo -> query($sql);
    if(is_array($results)){
    foreach ($results as $row){
      $moji3 = $row['id'];
      $moji1 = $row['name'];
      $moji2 = $row['comment'];
      $moji0 = $row['password'];
  }}
  if($pass3 == $moji0){
    $data3 = $moji3;
    $data0 = $moji0;
    $data1 = $moji1;
    $data2 = $moji2;
  }elseif($pass3 != $moji0){ 
    echo "パスワードが違います。";
  }}


  //$hensyuyouが空出ないとき
  if(isset($hensyuyou)){
    $sql = "SELECT * FROM user2 where id = $hensyuyou";
    $results = $pdo -> query($sql);
    if(is_array($results)){
      foreach ($results as $row){
        $moji0 = $row['password'];
  }}
  if($pass1 == $moji0){
    $nm = $_POST['name'];
    $kome = $_POST['comment'];
    $sql = "update user2 set name='$nm' , comment='$kome' where id = $hensyuyou";
    $result = $pdo->query($sql);
  }}

?>

<form action = "" method = "POST">
  <input type = "text" value = "<?php if(isset($data1)){echo $data1;}else{echo 名前;} ?>" name = "name"><br>
  <input type = "text" value = "<?php if(isset($data2)){echo $data2;}else{echo コメント;} ?>" name = "comment"><br>
  <input type = "text" value = "<?php if(isset($data0)){echo $data0;}else{echo パスワード;} ?>" name = "pass1">
  <input type = "hidden" value = "<?php echo $data3; ?>" name = "hensyuyou">
  <input type = "submit" value = "送信"><br><br>
  <input type = "text" value = "削除対象番号" name = "sakujo"><br>
  <input type = "text" value = "パスワード" name = "pass2">
  <input type = "submit" value = "削除"><br><br>
  <input type = "text" value = "編集対象番号" name = "hensyu"><br>
  <input type = "text" value = "パスワード" name = "pass3">
  <input type = "submit" value = "編集">
</form>


<?php
  //データの表示
  $sql = 'SELECT * FROM user2 ORDER BY id';
  $results = $pdo -> query($sql);
  foreach ($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['time'].'<br>';
  }
?>
