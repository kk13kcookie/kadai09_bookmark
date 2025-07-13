<?php
session_start();
require_once('funcs.php');
loginCheck();

//1. POSTデータ取得
$id = $_GET['id'];

//2. DB接続します
$pdo = db_conn();

//３. 削除SQL作成
$stmt = $pdo->prepare(
    'DELETE FROM gs_bm_table WHERE id = :id;'
);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    sql_error($stmt);
} else {
    //*** function化する！*****************
    redirect('select.php');
}
