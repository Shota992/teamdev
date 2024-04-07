<?php
require_once '../dbconnect.php';

session_start();

if (!isset($_SESSION['agent_id'])) {
    header('Location: /../../Eadmin/login.php');
    exit;
}
$agent_id = $_SESSION['agent_id'];

$students = $dbh->query("SELECT * FROM student")->fetchAll(PDO::FETCH_ASSOC);
$agents = $dbh->query("SELECT * FROM agent")->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query("SELECT * FROM choice")->fetchAll(PDO::FETCH_ASSOC);


$sql = "SELECT student.*
        FROM choice
        INNER JOIN student ON choice.user_id = student.user_id
        WHERE choice.agent_id = :agent_id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':agent_id', $agent_id);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT agent_name
        FROM info
        WHERE agent_id=:agent_id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':agent_id', $agent_id);
$stmt->execute();
$agent_info = $stmt->fetch(PDO::FETCH_ASSOC);
$agent_name = $agent_info['agent_name'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生情報閲覧</title>
    <link rel="stylesheet" href="../assets/css/reset.css" />
    <link rel="stylesheet" href="../Eadmin/Eadmin.css" />
</head>

<body class="student-body">
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
                        <div class="side-content choiced"><a href="#">学生情報一覧</a></div>
                        <div class="side-content"><a href="../Eadmin/password.php">パスワード変更</a></div>
                        <div class="side-content"><a href="../Eadmin/logout.php">ログアウト</a></div>
                    </div>
                </nav>
            </aside>
            <main class="main-body">
                <!-- <div class="student-main-container">
                <div class="student-main-inner"> -->
                <div class="student-main-head">
                <?php
                    // セッション変数からメッセージを取得して表示
                    if (isset($_SESSION['password_change_message'])) {
                        echo '<span style="color: black;">' . $_SESSION['password_change_message'] . '</span>';
                        // メッセージを表示したらセッション変数を削除
                        unset($_SESSION['password_change_message']);
                    }
                ?>
                    <div class="student-main-head-container">
                        <div class="student-main-head-sent">エージェント企業一覧</div>
                    </div>
                </div>
                <div class="student-main-name">
                    <div class="student-main-name-title"><?php echo $agent_name; ?>　様</div>
                    <div class="student-main-name-line"></div>
                </div>
                <div class="student-main-table">
                    <table class="student-main-table-container">
                        <tr class="student-main-table-head">
                            <td class="student-main-table-content">学生名</td>
                            <td class="student-main-table-content">フリガナ</td>
                            <td class="student-main-table-content">性別</td>
                            <td class="student-main-table-content">大学名</td>
                            <td class="student-main-table-content">携帯電話番号</td>
                            <td class="student-main-table-content">メールアドレス</td>
                            <td class="student-main-table-content">卒業年度</td>
                            <td class="student-main-table-content">文理区分</td>
                            <td class="student-main-table-content">志望業界</td>
                            <td class="student-main-table-content">申込み日時</td>
                        </tr>
                        <?php foreach ($students as $student) { ?>
                            <tr class="student-main-table-contents student-odd">
                                <td class="student-main-table-content"><?= $student["name"]; ?></td>
                                <td class="student-main-table-content"><?= $student["sub_name"]; ?></td>
                                <td class="student-main-table-content"><?= $student["sex"]; ?></td>
                                <td class="student-main-table-content"><?= $student["school"]; ?></td>
                                <td class="student-main-table-content"><?= $student["tel_num"]; ?></td>
                                <td class="student-main-table-content"><?= $student["mail"]; ?></td>
                                <td class="student-main-table-content"><?= $student["graduation"]; ?></td>
                                <td class="student-main-table-content"><?= $student["division"]; ?></td>
                                <td class="student-main-table-content"><?= $student["desire"]; ?></td>
                                <td class="student-main-table-content"><?= $student["time"]; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </main>
        </div>
        <footer>
            <div class="footer-copyright">
                <small>&copy; POSSE,Inc</small>
            </div>
        </footer>
    </div>
</body>

</html>