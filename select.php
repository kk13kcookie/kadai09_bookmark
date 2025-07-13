<?php
//SESSIONスタート
session_start();

require_once('funcs.php');

//ログインチェック
loginCheck();

// DB接続

$pdo = db_conn();

// データ取得SQL
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

// データ表示
if ($status == false) {
  // SQL実行時のエラー
  sql_error($stmt);
} else {
  // selectデータの数だけループ
  $view="<table>";
  $view .="<tr><th>日付</th><th>名前</th><th>コメント</th><th>URL</th><th>削除</th></tr>";
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= "<td>" . h($result['date']) . "</td>";
    $view .= "<td>" . h($result['name']) . "</td>";
    $view .= "<td>" . h($result['comment']) . "</td>";
    $view .= "<td>" . h($result['url']) . "</td>";
    $view .= '<td>
                  <a href="detail.php?id=' . h($result['id']) . '">編集</a> |
                  <a href="delete.php?id=' . h($result['id']) . '" onclick="return confirm(\'本当に削除しますか？\')">削除</a>
              </td>';
    $view .= '</tr>';
  }
  $view .= "</table>";
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📕ブックマークアプリ</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
  <header class="header">
    <div class="nav-container">
      <a href="#" class="logo">
        <i class="fas fa-chart-bar"></i>
          データ一覧
      </a>
      <a href="index.php" class="nav-link">
        <i class="fas fa-plus"></i>
          データ登録
      </a>
    </div>
  </header>

  <main class="main-container">
    <div class="content-card">
      <h1 class="page-title">📖ブックマーク一覧</h1>
      <p class="page-subtile">投稿されたブックマークの回答一覧</p>

      <div class="data-container">
        <?php if (empty($view)): ?>
          <!-- ＄Viewが空の場合 -->
          <div class="empty-state">
            <div class="empty-icon">
              <i class="fas fa-inbox"></i>
            </div>
            <p>まだデータがありません</p>
            <p style="margin-top: 0.5rem; font-size: 0.9rem; color: #999;">
              最初のおすすめ本を投稿してみましょう！
            </p>
          </div>
        <?php else: ?>
          <!-- もし$viewデータがある場合 -->
          <?= $view ?>
        <?php endif; ?>
      </div>
    </div>
  </main>
</body>
</html>