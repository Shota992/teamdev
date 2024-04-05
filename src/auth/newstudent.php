<?php
require("../dbconnect.php");
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
    $stmt = $dbh->prepare('SELECT COUNT(*) AS cnt FROM user WHERE email = ?');
    $stmt->execute([$email]);
    $result = $stmt->fetch();
    if ($result['cnt'] > 0) {
        $errors['email'] = 'このメールアドレスはすでに登録されています';
    }

    // エラーがなければ新規登録処理を行う
    if (empty($errors)) {
        // パスワードをハッシュ化
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // ユーザー情報をデータベースに挿入
        $stmt = $dbh->prepare('INSERT INTO user (email, passwords) VALUES (?, ?)');
        $stmt->execute([$email, $hashed_password]);

        // 登録完了後の処理を記述（例：登録完了画面へのリダイレクトなど）
        header('Location: ../top/aftertop.php');
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="body_2">
    <div class="wrap">
        <?php include_once '../includes/header3.php'; ?>
        <main>
            <div class="container">
                <h1 class="top-heading">新規登録</h1>
                <form action="../auth/newstudent.php" method="POST">
                    <div class="form-tag">
                        <label for="email" class="form-label">ログインID（メールアドレス）</label>
                        <input type="email" name="email" class="email form-control" id="email">
                        <?php if (!empty($errors['email'])) : ?>
                            <p class="error"><?php echo $errors['email']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-tag">
                        <label for="password" class="form-label">パスワード</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <?php if (!empty($errors['password'])) : ?>
                            <p class="error"><?php echo $errors['password']; ?></p>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn submit">新規登録</button>
                </form>
            </div>
        </main>
        <?php
        include_once '../includes/footer2.php'; ?>
    </div>
</body>

</html>