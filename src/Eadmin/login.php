<?php
require __DIR__ . '/../dbconnect.php';
$agents = $dbh->query("SELECT * FROM agent")->fetchAll(PDO::FETCH_ASSOC);

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


        $stmt = $dbh->prepare('SELECT * FROM agent WHERE mail = :mail');
        $stmt->bindValue(':mail', $email);
        $stmt->execute();
        $agents = $stmt->fetch();


        if ($agents && password_verify($password, $agents["password"])) {
            session_start();
            $_SESSION['id'] = $agents["id"];
            header('Location: student.php');
            exit();
        } else {
            // 認証失敗: エラーメッセージをセット
            $message = 'メールアドレスまたはパスワードが間違っています。';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント企業ログイン</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="./Eadmin.css">
</head>

<body>
    <div class="login_wrapper">
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
        <main class="main-body" style="flex: 1; ">
            <div class="login-title" style="text-align: center;">
                <h1 class="top-heading">エージェント企業様向け</h1>
                <?php if ($message !== '') { ?>
                    <p style="color: red;"><?= $message ?></p>
                <?php }; ?>
            </div>
            <div class="login-container">
                <form method="POST">
                    <div class="form-tag">
                        <label for="email" class="form-label">ログインID（メールアドレス）</label>
                        <input type="email" name="email" class="email form-control" id="email" height="30px">
                    </div>
                    <div class="form-tag">
                        <label for="password" class="form-label">パスワード</label>
                        <input type="password" name="password" id="password" class="form-control" height="30px">
                    </div>
                    <button type="submit" disabled class="btn submit">ログイン</button>
                </form>
            </div>
        </main>
        <footer>
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
    </div>
</body>

</html>