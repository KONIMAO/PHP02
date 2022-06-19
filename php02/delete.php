<?php
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db_2;charset=utf8;host=mysql57.konichan.sakura.ne.jp,konichan,w2W0qoH8');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT* FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<tr>";
    $view .= "<td>".$res["id"]."</td><td>".$res["title"]."</td><td><a href=".$res["url"].">".$res["url"]."</a></td><td>".$res["comment"]."</td><td>".$res["datetime"]."</td>";
    $view .= "<tr>";
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>削除しました</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="select.php">データ一覧へ</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">削除しました</div>
</div>
<!-- Main[End] -->

</body>
</html>
