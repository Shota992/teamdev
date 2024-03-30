<!-- 新規CRAFT管理者登録ページ -->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRAFT管理者新規登録</title>
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="../Cadmin.css">
</head>

<body>
    <div class="wrapper">
        <header class="header-all">
            <div header-top>
                <a href="" class="header-logo" target="_blank" rel="noopener noreferrer">
                    <img src="../../assets/img/header_logo.png" alt="CRAFT" width="120" style="object-fit: contain;">
                </a>
            </div>
            <div class="header-down">
                <img src="../../assets/img/boozer_logo-black.png" alt="boozer" width="150" style="object-fit: contain;">
            </div>
        </header>
        <main style="flex: 1; ">
            <div class="container">
                <h1 class="top-heading">CRAFT管理者新規登録</h1>
                <form method="POST">
                    <div class="form-tag">
                        <label for="email" class="form-label">ログインID（メールアドレス）</label>
                        <input type="email" name="email" class="email form-control" id="email">
                    </div>
                    <div class="form-tag">
                        <label for="password" class="form-label">パスワード</label>
                        <input type="password" name="password" id="password" class="form-control1">
                    </div>
                    <button type="submit" disabled class="btn submit">新規登録</button>
                </form>
            </div>
        </main>
        <footer>
            <div class="footer-copyright">
                <small>&copy; POSSE,Inc</small>
            </div>
        </footer>
    </div>
</body>

</html>