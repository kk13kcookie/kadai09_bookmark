<?php
// ==============
// 共通で使う関数
// ===============

// XSS対応
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES);
}

// データベース接続
function db_conn() {
  include "env.php";
  // このコードを実行しているサーバー情報を取得して変数に保存
  $server_info = $_SERVER;

  // 変数の箱だけ先に用意
  $db_name;
  $db_host;
  $db_id;
  $db_pw;

  // env.phpからデータのオブジェクトを取得
  $sakura_db_info = sakura_db_info();

  // サーバー情報の中のサーバの名前がlocalhostだった場合と本番だった場合で処理を分ける
  if ($server_info["SERVER_NAME"] == "localhost") {
      $db_name = 'gs_bookmark';        // データベース名
      $db_host = 'localhost';         // DBホスト
      $db_id   = 'root';              // アカウント名
      $db_pw   = '';                  // パスワード：XAMPPはパスワード無しに修正してください。
  } else {
      // 連想配列の情報変数に格納
      $db_name =  $sakura_db_info["db_name"];    //データベース名
      $db_host =  $sakura_db_info["db_host"];    //DBホスト
      $db_id =    $sakura_db_info["db_id"];      //アカウント名(登録しているドメイン)
      $db_pw =    $sakura_db_info["db_pw"];      //さくらサーバのパスワード
  }

  try {
      $server_info ='mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
      $pdo = new PDO($server_info, $db_id, $db_pw);

      return $pdo;
  } catch (PDOException $e) {
      exit('DB Connection Error:' . $e->getMessage());
  }
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name) {
    header('Location: ' . $file_name );
    exit();
}

// ログインチェク処理 loginCheck()
function loginCheck() {
    if ( !isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] !== session_id() ) {
        exit('LOGIN ERROR');
    }
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
}