<!-- 学生ログインページ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
    <header>
        <?php 
        // include __DIR__ . '/../includes/header3.php'; ?>
    </header>
    <main>
        <div class="CRAFT-img">
            <img src="../assets/img/header_logo.png" alt="CRAFTアイコン">
        </div>
        <div class="container">
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
    <footer>
        <?php 
        // include __DIR__ . '/../includes/footer2.php'; ?>
    </footer>
</body>
</html>
