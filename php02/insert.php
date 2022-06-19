<?php
ini_set('display_errors', 'On'); // エラーを表示させるようにしてください
error_reporting(E_ALL); // 全てのレベルのエラーを表示してください
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$title =  $_POST['title'];
$url = $_POST['url'];
$comment = $_POST['comment'];
//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=konichan_gs_db_2;charset=utf8;host=mysql57.konichan.sakura.ne.jp','konichan','w2W0qoH8');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
}
//３．データ登録SQL作成
$stmt = $pdo->prepare("insert into gs_bm_table(title, url, comment, datetime) values(:title,:url,:comment, sysdate())");
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>



