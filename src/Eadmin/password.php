<?php

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: /../../Eadmin/login.php');
    exit;
}

// パスワード変更処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // データベースへの接続
    require_once '../dbconnect.php';

    // フォームから送信された現在のパスワードと新しいパスワードを取得
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // 現在のパスワードと新しいパスワードが空でないことを確認
    if (!empty($current_password) && !empty($new_password)) {

        // ユーザーのエージェントIDを取得
        $agent_id = $_SESSION['id'];

        // データベースから現在のパスワードを取得
        $query = "SELECT password FROM agent WHERE agent_id = :agent_id";
        $statement = $dbh->prepare($query);
        $statement->bindParam(':agent_id', $agent_id, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // データベース内のハッシュ化されたパスワードを取得
        $hashed_current_password = $row['password'];

        // 入力された現在のパスワードが正しいか確認
        if (password_verify($current_password, $hashed_current_password)) {
            // 新しいパスワードをハッシュ化
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // パスワードの変更処理
            $update_query = "UPDATE agent SET password = :new_password WHERE agent_id = :agent_id";
            $update_statement = $dbh->prepare($update_query);
            $update_statement->bindValue(':new_password', $hashed_new_password, PDO::PARAM_STR);
            $update_statement->bindValue(':agent_id', $agent_id, PDO::PARAM_STR);

            try {
                $update_statement->execute();
                // パスワードが正常に変更された場合の処理
                echo "<script>alert('パスワードが変更されました。');</script>";
                echo "<script>window.location.href = '../Eadmin/student.php';</script>";
                exit;
            } catch (PDOException $e) {
                // エラーが発生した場合の処理
                echo "<script>alert('パスワード変更ができませんでした。');</script>";
                echo "<script>window.location.href = '../Eadmin/student.php';</script>";
                exit;
            }
        } else {
            // 入力された現在のパスワードが正しくない場合の処理
            echo "<script>alert('現在のパスワードが正しくありません。');</script>";
            echo "<script>window.location.href = '../Eadmin/password.php';</script>";
            exit;
        }
    } else {
        // フォームが不完全な場合の処理
        echo "<script>alert('現在のパスワードと新しいパスワードを入力してください。');</script>";
        echo "<script>window.location.href = '../Eadmin/password.php';</script>";
        exit;
    }
}
?>


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
    <div class="out-wrapper">
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
        <div class="wrapper">
            <aside class="side-container">
                <nav>
                    <div class="side-sent">
                        <div class="side-content"><a href="../Eadmin/student.php">学生情報一覧</a></div>
                        <div class="side-content choiced"><a href="#">パスワード変更</a></div>
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
                <div class="password-container">
                    <form method="POST" id="passwordForm">
                        <div class="form-tag">
                            <label for="current_password" class="form-label">現在のパスワード</label>
                            <input type="password" name="current_password" class="form-control" id="current_password">
                        </div>
                        <div class="form-tag">
                            <label for="new_password" class="form-label">新しいパスワード</label>
                            <input type="password" name="new_password" id="new_password" class="form-control">
                        </div>
                        <button type="submit" class="btn submit">変更</button>
                    </form>
                </div>
            </main>
        </div>
        <footer class="footer">
            <div class="footer-copyright">
                <small class="copyright">&copy; POSSE,Inc</small>
            </div>
        </footer>
    </div>
</body>

</html>