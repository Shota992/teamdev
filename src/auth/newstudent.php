<!-- ユーザ新規登録ページ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
    <header>
        <?php 
        // include __DIR__ . '/../includes/header3.php'; ?>
    </header>
    <main>
        <div class="container">
            <h1 class="top-heading">新規登録</h1>
            <form method="POST">
                <div>
                    <label for="email" class="form-label">ログインID（メールアドレス）</label>
                    <input type="email" name="email" class="email form-control" id="email">
                </div>
                <div>
                    <label for="password" class="form-label">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" disabled class="btn submit">新規登録</button>
            </form>
        </div>
    </main>
    <footer>
        <?php 
        // include __DIR__ . '/../includes/footer2.php'; ?>
    </footer>
</body>
</html>