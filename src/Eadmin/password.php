<!-- パスワード変更ページ -->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="./Eadmin.css">
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
        <aside class="side-container">
            <nav>
                <div class="side-sent">
                    <div class="side-content"><a href="../Eadmin/student.php">学生情報一覧</a></div>
                    <div class="side-choiced"><a href="/">パスワード変更</a></div>
                    <div class="side-content"><a href="../Eadmin/logout.php">ログアウト</a></div>
                </div>
            </nav>
        </aside>
        <main class="main-body password">
            <div class="student-main-head">
                <div class="student-main-head-container">
                    <div class="student-main-head-sent">パスワード変更</div>
                </div>
            </div>
            <div class="container">
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
        </main>
    </div>
    <footer class="footer">
        <div class="footer-copyright">
            <small class="copyright">&copy; POSSE,Inc</small>
        </div>
    </footer>
</body>

</html>