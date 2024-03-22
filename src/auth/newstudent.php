<!-- 新規登録画面ページ -->
<?php
require_once '../dbconnect.php';
//フォームからの値をそれぞれ変数に代入
$mail = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
//フォームに入力されたmailがすでに登録されていないかチェック
$sql = "SELECT * FROM user WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $mail);
$stmt->execute();
$member = $stmt->fetch();
if ($member['email'] === $mail) {
    $msg = '同じメールアドレスが存在します。';
} else {
    //登録されていなければinsert 
    $sql = "INSERT INTO user(email, password) VALUES (:email, :password)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    $msg = '会員登録が完了しました';
}
?>

<h1><?php echo $msg; ?></h1><!--メッセージの出力-->

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
            </form>
        </div>
    </main>
    <?php
    include_once '../includes/footer2.php'; ?>
</body>

</html>