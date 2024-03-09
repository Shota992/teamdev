<!-- パスワード変更ページ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更</title>
    <link rel="stylesheet" href="./Eadmin.css">
</head>
<body>
    <header class="header">
        <a href="" class="header-logo" target="_blank" rel="noopener noreferrer">
            <img src="../assets/img/header_logo.png" alt="CRAFT">
        </a>
        <img src="../assets/img/boozer_logo-black.png" alt="boozer">
    </header>
    <main class="all-main">
        <aside class="side-bar">
            <nav>
                <ul class="side-nav-list">
                    <li class="side-nav"><a href="/">ユーザー招待</a></li>
                    <li class="side-nav"><a href="/">問題一覧</a></li>
                    <li class="side-nav"><a href="/">問題作成</a></li>
                </ul>
            </nav>
        </aside>
        <div class="main-body">
            <div class="head-title">
                <h1 class="title-text">パスワード変更</h1>
            </div>
            <div class="container content">
                <form method="POST">
                    <div class="form-tag">
                        <label for="password" class="form-label">現在のパスワード</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-tag">
                        <label for="password" class="form-label">新しいパスワード</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" disabled class="btn submit">変更</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-copyright">
            <small class="copyright">&copy; POSSE,Inc</small>
        </div>
    </footer>
</body>
</html>
