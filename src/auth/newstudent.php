<!-- 新規登録画面ページ -->
<?php
if (isset($_POST['user'])) {
    $dsn = 'mysql:dbname=EC;charset=utf8';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $dbh = new PDO($dsn, $user, $password);
    $stmt = $dbh->prepare("INSERT INTO USER VALUES(:user,:password,:name,:address,:tel)");
    $stmt->bindParam(':user', $_POST['user']);
    $stmt->bindParam(':password', $_POST['password']);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':address', $_POST['address']);
    $stmt->bindParam(':tel', $_POST['tel']);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>
    <?php include_once '../includes/header3.php'; ?>
    <main>
        <div class="container">
            <h1 class="top-heading">新規登録</h1>
            <form action="../auth/newstudent.php" method="POST">
                <div class="form-tag">
                    <label for="email" class="form-label">ログインID（メールアドレス）</label>
                    <input type="email" name="email" class="email form-control" id="email">
                </div>
                <div class="form-tag">
                    <label for="password" class="form-label">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" disabled class="btn submit">新規登録</button>
                <p style="text-align:center;margin-top: 1.5em;">※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
            </form>
        </div>
    </main>
    <?php
    include_once '../includes/footer2.php'; ?>
</body>

</html>