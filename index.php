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
      <ul class="nav-auth">
        <li><a href="login.php" class="button-login">ログイン</a></li>
        <li><a href="logout.php" class="button-logout">ログアウト</a></li>
      </ul>
    </div>
  </header>

  <main class="main-container form-page">
    <div class="form-card">
      <h1 class="form-title">📕ブックマークアプリ</h1>
      <p class="from-subtitle">あなたの好きな本を教えて下さい</p>

      <form method="post" action="insert.php">
        <div class=""form-group>
          <label for="name" class="form-label">
            <i class="fas fa-user"></i> タイトル
          </label>
          <input type="text" id="name" name="name" class="form-input" placeholder="例：ハリーポッターと賢者の石" required>
        </div>
        <div class=""form-group>
          <label for="url" class="form-label">
            <i class="fas fa-user"></i> URL
          </label>
          <input type="text" id="url" name="url" class="form-input" placeholder="例：https://www.google.com/" required>
        </div>
        <div class=""form-group>
          <label for="comment" class="form-label">
            <i class="fas fa-user"></i> コメント
          </label>
          <input type="text" id="comment" name="comment" class="form-input" placeholder="例：感動的なストーリーで泣ける" required>
        </div>
        <button type="submit" class="submit-btn">
          <i class="fas fa-paper-plane"></i>
          送信する
        </button>
      </form>
    </div>
  </main>
</body>
</html>