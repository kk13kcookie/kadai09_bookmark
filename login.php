<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="style.css" rel="stylesheet">
    <title>ログイン</title>
</head>
<body>

    <header class="header">
        <div class="nav-container">
            <div class="navbar-header">
                <a class="logo" href="index.php">
                    <i class="fa-book-medical"></i>
                        データ登録
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <form name="form1" action="login_act.php" method="post">
                <fieldset>
                    <legend>ログイン</legend>
                    <label>
                        <span>ID:</span>
                        <input type="text" name="lid" />
                    </label>
                    <label>
                        <span>PW:</span>
                        <input type="password" name="lpw" />
                    </label>
                    <input type="submit" value="LOGIN" />
                </fieldset>
            </form>
        </div>
    </main>

</body>
</html>
