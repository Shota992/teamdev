<!-- エージェント企業ログインページ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント企業ログイン</title>
    <link rel="stylesheet" href="./Eadmin.css">
</head>
<body>
    <header class="header">
        <a href="" class="header-logo" target="_blank" rel="noopener noreferrer">
            <img src="../assets/img/header_logo.png" alt="CRAFT">
        </a>
        <img src="../assets/img/boozer_logo-black.png" alt="boozer">
    </header>
    <main class="main-body">
        <div class="container">
            <h1 class="top-heading">エージェント企業様向け</h1>
            <form method="POST">
                <div class="form-tag">
                    <label for="email" class="form-label">ログインID（メールアドレス）</label>
                    <input type="email" name="email" class="email form-control" id="email">
                </div>
                <div class="form-tag">
                    <label for="password" class="form-label">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" disabled class="btn submit">ログイン</button>
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
