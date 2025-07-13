<?php

// ファイル読み込み
require_once('funcs.php');

// POSTデータ取得
$name = $_POST['name'];
$url = $_POST['url'];
$comment = $_POST['comment'];

// DB接続
$pdo = db_conn();

// =================
// データ登録SQL作成
// =================

// SQL文
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, name, url, comment, date)
  VALUES(NUll, :name, :url, :comment, now())");

// バインド変数
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);

// 実行
$status = $stmt->execute();

// データ登録処理後
if ($status == false){
  sql_error($stmt);
} else {
  redirect('index.php');
}

?>