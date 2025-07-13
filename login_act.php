<?php

//最初にSESSIONを開始
session_start();

//POST値を受け取る
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

//1.  DB接続します
require_once('funcs.php');
$pdo = db_conn();

//2. データ登録SQL作成
// gs_user_tableに、IDとWPがあるか確認する。
$stmt = $pdo->prepare('SELECT * FROM gs_user_table
                        WHERE lid = :lid AND lpw=:lpw'
                    );
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合
if($status === false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();

//5. 該当レコードがあればSESSIONに値を代入
if($val['id'] != ''){ 
    //Login成功時 該当レコードがあればSESSIONに値を代入
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();

    redirect('select.php');
}else{
    //Login失敗時(Logout経由)
    redirect('login.php');
}