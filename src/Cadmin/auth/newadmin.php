<!-- 新規CRAFT管理者登録ページ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRAFT管理者新規登録</title>
    <link rel="stylesheet" href="../Cadmin.css">
</head>
<body>
    <header class="header">
        <a href="" class="header-logo" target="_blank" rel="noopener noreferrer">
            <img src="../../assets/img/header_logo.png" alt="CRAFT">
        </a>
        <img src="../../assets/img/boozer_logo-black.png" alt="boozer">
    </header>
    <main>
        <div class="container">
            <h1 class="top-heading">CRAFT管理者新規登録</h1>
            <form method="POST">
                <div class="form-tag">
                    <label for="email" class="form-label">ログインID（メールアドレス）</label>
                    <input type="email" name="email" class="email form-control" id="email">
                </div>
                <div class="form-tag">
                    <label for="password" class="form-label">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" disabled class="btn submit">新規登録</button>
            </form>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-copyright">
            <small class="copyright">&copy; POSSE,Inc</small>
        </div>
    </footer>
</body>
</html>
