<?php
//入力チェック(受信確認処理追加)
if(
    !isset($_GET["id"]) || $_GET["id"]==""
  ){
    header('location: index.php');
    exit;
  }
  $areaid = $_GET["id"];


//1.  DB接続します
include('functions.php');
$pdo = db_conn();

//２．データ取得
$stmt = $pdo->prepare('SELECT * FROM '.$area_table.' WHERE id=:areaid');
$stmt->bindValue(':areaid', $areaid, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データリスト //Selectデータの数だけ自動でループしてくれる
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){


// スクレイピング

// phpQueryの読み込み
require_once("phpQuery-onefile.php");

// 取得したいwebサイトを読み込む
$options['ssl']['verify_peer']=false;
$options['ssl']['verify_peer_name']=false;
$areahtml = file_get_contents($result['url'], false, stream_context_create($options));

// shopurlを取得
$list = [];
for($i = 0; $i <= 22; $i++){
    $shophtml = phpQuery::newDocument($areahtml)->find(".slcHeadContentsInner:eq(".$i.")")->find("h3")->find("a")->attr("href");
    $shophtml = substr($shophtml, 0, 41);
    
    $html = file_get_contents($shophtml, false, stream_context_create($options));
    // 情報取得　(id, shop, tel, adress, area, url, link, date)(NULL, $shop, $tel, $adress, $result['id'], $html, ＠＠＠, sysdate())
// 店名

$shop = phpQuery::newDocument($html)->find(".detailTitle")->find("a")->text();

// Tel
$telhtml = file_get_contents($shophtml.'/tel', false, stream_context_create($options));
$tel = phpQuery::newDocument($telhtml)->find(".fs16")->text();
// 住所
$adress = phpQuery::newDocument($html)->find(".fs10")->find("li:eq(0)")->text();
// エリアid　$result['id']

// リンク数カウント
$link = NULL;
$link = phpQuery::newDocument($html)->find(".mT10:eq(1)")->find("li:eq(4)")->find("a")->text();
if($link != NULL){
    $link = 2; // 6店舗以上
}else{
    $link = phpQuery::newDocument($html)->find(".mT10:eq(1)")->find("li:eq(0)")->find("a")->text();
    if($link != NULL){
        $link = 1; // 2店舗以上
    }else{
        $link = 0; // 1店舗
    }
}

// 新規か上書きか
$stmt_l = '';
// 更新
$stmt_l = $pdo->prepare('UPDATE '.$list_table.' SET shop=:a1, tel=:a2, adress=:a3, area=:a4, link=:a6, date=sysdate() WHERE url=:url');
$stmt_l->bindValue(':url', $shophtml, PDO::PARAM_STR);
$stmt->bindValue(':a1', $shop, PDO::PARAM_STR);
$stmt->bindValue(':a2', $tel, PDO::PARAM_STR);
$stmt->bindValue(':a3', $adress, PDO::PARAM_STR);
$stmt->bindValue(':a4', $result['id'], PDO::PARAM_STR);
$stmt->bindValue(':a6', $link, PDO::PARAM_STR);
$status_l = $stmt_l->execute();
if($status_l==false){
    // 新規
    $stmt_l = $pdo->prepare('INSERT INTO '. $list_table .'(id, shop, tel, adress, area, url, link, date)VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6, sysdate())');
        $stmt->bindValue(':a1', $shop, PDO::PARAM_STR);
        $stmt->bindValue(':a2', $tel, PDO::PARAM_STR);
        $stmt->bindValue(':a3', $adress, PDO::PARAM_STR);
        $stmt->bindValue(':a4', $result['id'], PDO::PARAM_STR);
        $stmt->bindValue(':a5', $shophtml, PDO::PARAM_STR);
        $stmt->bindValue(':a6', $link, PDO::PARAM_STR);
        $status = $stmt->execute();
  }

}

header('location: index.php'); //locationの後に必ず半角スペース
exit;
}
?>