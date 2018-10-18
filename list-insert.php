<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["area"]) || $_POST["area"]=="" ||
  !isset($_POST["miniarea"]) || $_POST["miniarea"]=="" ||
  !isset($_POST['url']) || $_POST['url']==""||
  !isset($_POST['userid']) || $_POST['userid']==""
){
  header('location: index.php');
  exit;
}

//1. POSTデータ取得
$shop = $_POST["area"];
$tel = $_POST["miniarea"];
$adress= $_POST["url"];
$area = $_POST['userid'];
$url = $_POST["url"];
$link = $_POST['userid'];

//2. DB接続します(エラー処理追加)
include('functions.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO '. $list_table .'(id, shop, tel, adress, area, url, link, date)VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6, sysdate()');
$stmt->bindValue(':a1', $shop, PDO::PARAM_STR);
$stmt->bindValue(':a2', $tel, PDO::PARAM_STR);
$stmt->bindValue(':a3', $adress, PDO::PARAM_STR);
$stmt->bindValue(':a4', $area, PDO::PARAM_STR);
$stmt->bindValue(':a5', $url, PDO::PARAM_STR);
$stmt->bindValue(':a6', $link, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  errorMsg($stmt);
}else{
  //５．index.phpへリダイレクト
  header('Location: index.php');
  exit;
}
?>
