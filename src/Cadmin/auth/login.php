<?php
require __DIR__ . '/../../dbconnect.php';
$craft = $dbh->query("SELECT * FROM craft")->fetchAll(PDO::FETCH_ASSOC);

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['email'])) {
    $message = 'メールアドレスは必須項目です。';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $message = '正しいEメールアドレスを指定してください。';
    } elseif (empty($_POST['password'])) {
    $message = 'パスワードは必須項目です。';
    } else {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $stmt = $dbh->prepare('SELECT * FROM craft WHERE mail = :mail');
    $stmt->bindValue(':mail', $email);
    $stmt->execute();
    $craft = $stmt->fetch();


    if ($craft && password_verify($password, $craft["password"])) {
        session_start();
        $_SESSION['id'] = $craft["id"];
        header('Location: ../index.php');
        exit();
    } else {
      // 認証失敗: エラーメッセージをセット
        $message = 'メールアドレスまたはパスワードが間違っています。';
    }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRAFT管理者ログイン</title>
    <link rel="stylesheet" href="../Cadmin.css">
</head>
<body>
    <header class="header">
        <a href="" class="header-logo" target="_blank" rel="noopener noreferrer">
            <img src="../../assets/img/header_logo.png" alt="CRAFT">
        </a>
        <img src="../../assets/img/boozer_logo-black.png" alt="boozer">
    </header>
    <main>
        <div class="container">
            <h1 class="top-heading">CRAFT管理者向け</h1>
            <?php if ($message !== '') { ?>
                <p style="color: red;"><?= $message ?></p>
            <?php }; ?>
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
    <footer class="footer">
        <div class="footer-copyright">
            <small class="copyright">&copy; POSSE,Inc</small>
        </div>
    </footer>
    <script>
    const EMAIL_REGEX = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    const submitButton = document.querySelector('.btn.submit')
    const emailInput = document.querySelector('.email')
    inputDoms = Array.from(document.querySelectorAll('.form-control'))
    inputDoms.forEach(inpuDom => {
        inpuDom.addEventListener('input', event => {
            const isFilled = inputDoms.filter(d => d.value).length === inputDoms.length
            submitButton.disabled = !(isFilled && EMAIL_REGEX.test(emailInput.value))
        })
    })
    </script>
</body>
</html>
