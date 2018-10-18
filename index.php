<?php
//1.  DB接続します ログイン確認
session_start();
include('functions.php');
// $unlogin = chk_ssid();
$loginname = $_SESSION['name'];
$pdo = db_conn();
$userid = $_SESSION['userid'];


//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM '.$area_table.' WHERE user=:userid');
$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
$view='';
if($status==false){
  errorMsg($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p><a href="select.php?id='.$result['id'].'">';  //更新ページへのaタグを作成
    $view .= $result['miniarea'].'('.$result['area'].')';
    $view .= '</a>';
    $view .= '　';
    $view .= '<a href="scraping.php?id='.$result['id'].'">［更新］</a></p>';  //削除用aタグを作成
     
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

<!-- FORM[Start] -->
<form method="post" action="area-insert.php">
  <div>
    <fieldset>
      <legend>エリア追加</legend>
        <label>中エリア名：<input type="text" name="area"></label><br>
        <label>小エリア名：<input type="text" name="miniarea"></label><br>
        <label>小エリアURL：<input type="text" name="url"></label><br>
        <input type="hidden" name="userid" value="<?=$_SESSION['userid'] ?>">
        <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- FORM[End] -->


</body>
</html>
