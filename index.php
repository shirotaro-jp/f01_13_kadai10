<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>営業リスト作成</title>
</head>
<body>

<header>

</header>


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
