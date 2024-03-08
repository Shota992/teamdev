<!-- パスワード変更ページ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更</title>
</head>
<body>
    <header>
        <a href="" class="header-logo" target="_blank" rel="noopener noreferrer">
            <img src="" alt="CRAFT">
        </a>
        <img src="" alt="boozer">
    </header>
    <aside>
            <nav>
                <ul>
                    <li><a href="/">ユーザー招待</a></li>
                    <li><a href="/">問題一覧</a></li>
                    <li><a href="/">問題作成</a></li>
                </ul>
            </nav>
    </aside>
    <div class="wrapper">
        <main>
            <div>
                <p>パスワード変更</p>
            </div>
            <div class="container">
                <form method="POST">
                    <div>
                        <label for="password" class="form-label">現在のパスワード</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div>
                        <label for="password" class="form-label">新しいパスワード</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" disabled class="btn submit">変更</button>
                </form>
            </div>
        </main>
    </div>
    <footer>
        <div class="footer-copyright">
            <small>&copy; POSSE,Inc</small>
        </div>
    </footer>
</body>
</html>
