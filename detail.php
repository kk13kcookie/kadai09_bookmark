<?php
session_start();
require_once('funcs.php');
loginCheck();

// select.phpから送られてくるidを$id変数にいれる
$id = $_GET['id'];

// DB接続
$pdo = db_conn();

//２．データ登録SQL作成
// SELECTするときに、idを指定する。
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id;');
// :idはプレースホルダといって、実際の値はbindValueで指定する。
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$result = '';
if ($status === false) {
    sql_error($stmt);
} else {
    $result = $stmt->fetch(); // データを取得
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ブックマークアプリ</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <header class="header">
    <div class="nav-container">
      <a href="#" class="logo">
        <i class="fas fa-clipboard-list"></i>
          ブックマークアプリ
      </a>
      <a href="select.php" class="nav-link">
        <i class="fas fa-list"></i>
        データ一覧
      </a>
    </div>
  </header>

  <main class="main-container form-page">
    <div class="form-card">
      <h1 class="form-title">📕ブックマークアプリ</h1>
      <p class="from-subtitle">あなたの好きな本を教えて下さい</p>

      <form method="post" action="update.php">
        <div class=""form-group>
          <label for="name" class="form-label">
            <i class="fas fa-user"></i> タイトル
          </label>
          <input type="text" id="name" name="name" class="form-input" value="<?= $result['name'] ?>" required>
        </div>
        <div class=""form-group>
          <label for="url" class="form-label">
            <i class="fas fa-user"></i> URL
          </label>
          <input type="text" id="url" name="url" class="form-input" value="<?= $result['url'] ?>" required>
        </div>
        <div class=""form-group>
          <label for="comment" class="form-label">
            <i class="fas fa-user"></i> コメント
          </label>
          <input type="text" id="comment" name="comment" class="form-input" value="<?= $result['comment'] ?>" required>
        </div>
        <input type="hidden" name="id" value="<?= $result['id'] ?>">
        <button type="submit" class="submit-btn">
          <i class="fas fa-paper-plane"></i>
          更新する
        </button>
      </form>
    </div>
  </main>
</body>
</html>