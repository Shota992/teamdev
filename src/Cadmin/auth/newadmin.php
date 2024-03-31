<?php
require("../../dbconnect.php");
session_start();

// フォームが送信された場合の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 入力されたメールアドレスとパスワードを取得
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 入力チェック
    $errors = [];
    if (empty($email)) {
        $errors['email'] = 'メールアドレスを入力してください';
    }
    if (empty($password)) {
        $errors['password'] = 'パスワードを入力してください';
    }

    // メールアドレスの重複チェック
    $stmt = $dbh->prepare('SELECT COUNT(*) AS cnt FROM craft WHERE mail = ?');
    $stmt->execute([$email]);
    $result = $stmt->fetch();
    if ($result['cnt'] > 0) {
        $errors['mail'] = 'このメールアドレスはすでに登録されています';
    }

    // エラーがなければ新規登録処理を行う
    if (empty($errors)) {
        // パスワードをハッシュ化
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // ユーザー情報をデータベースに挿入
        $stmt = $dbh->prepare('INSERT INTO craft (mail, password) VALUES (?, ?)');
        $stmt->execute([$email, $hashed_password]);

        // 登録完了後の処理を記述（例：登録完了画面へのリダイレクトなど）
        header('Location: ../../../../Cadmin/index.php');
        exit;
    }
}
?>
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
                    <button type="submit" class="btn submit">新規登録</button>
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