<?php
//入力チェック(受信確認処理追加)
if(
    !isset($_GET["id"]) || $_GET["id"]==""
  ){
    header('location: index.php');
    exit;
  }
$areaid = $_GET["id"];

//1.  DB接続します ログイン確認
session_start();
include('functions.php');
// $unlogin = chk_ssid();
$loginname = $_SESSION['name'];
$pdo = db_conn();
$userid = $_SESSION['userid'];


//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM '.$list_table.' WHERE area=:areaid ');
$stmt->bindValue(':areaid', $areaid, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
$view='';
if($status==false){
  errorMsg($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>店名：'.$result['shop'].' 電話番号：'.$result['tel'].' 住所：'.$result['adress'].' 多店舗：'.$result['link'].'"</p>';  //更新ページへのaタグを作成     
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>営業リスト作成</title>
</head>
<body>

<header>

</header>
<div>
    <?=$view?>
</div>


</body>
</html>
