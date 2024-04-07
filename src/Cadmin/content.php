<?php
require __DIR__ . '/../dbconnect.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: /../../Cadmin/auth/login.php');
    exit;
}

$choice = $dbh->query("SELECT * FROM choice")->fetchAll(PDO::FETCH_ASSOC);
$info = $dbh->query("SELECT * FROM info")->fetchAll(PDO::FETCH_ASSOC);
$student = $dbh->query("SELECT * FROM student")->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT info.agent_id, info.site_name, student.name,choice.time
        FROM choice
        INNER JOIN info ON choice.agent_id = info.agent_id
        INNER JOIN student ON choice.user_id = student.user_id";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$choices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>申込み内容一覧</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../Cadmin/Cadmin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <script src="./assets/js/script.js" defer></script>
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
        <div class="create-wrapper">
            <aside class="side-container">
                <nav>
                    <div class="side-sent">
                        <div class="side-content"><a href="../Cadmin/index.php">エージェント企業一覧</a></div>
                        <div class="side-content"><a href="../Cadmin/egent/create.php">エージェント企業新規登録</a></div>
                        <div class="side-content"><a href="../Cadmin/auth/newadmin.php">新規管理者登録</a></div>
                        <div class="side-content choiced"><a href="/">申込内容一覧</a></div>
                        <div class="side-content"><a href="../Cadmin/auth/logout.php">ログアウト</a></div>
                    </div>
                </nav>
            </aside>
            <main class="create-main">
                <div class="content-main-head">
                    <div class="content-main-head-container">
                        <div class="content-main-head-sent">申し込み内容一覧</div>
                    </div>
                </div>
                <!-- <div class="content-main-search">
                    <div class="content-main-search-contents">
                        <div class="content-main-search-radios">
                            <div class="content-main-search-radio">
                                <input type="radio" id="radio1" name="color" value="red">
                                <label>申込み日時順</label>
                            </div>
                            <div class="content-main-search-radio">
                                <input type="radio" id="radio2" name="color" value="red">
                                <label>サイト名の五十音順</label>
                            </div>
                            <div class="content-main-search-radio">
                                <input type="radio" id="radio3" name="color" value="red">
                                <label>学生氏名の五十音順</label>
                            </div>
                        </div>
                        <div class="content-main-search-checks">
                            <div class="content-main-search-check">
                                <input type="checkbox" id="check1" name="color" value="red">
                                <label>タスク完了済み</label>
                            </div>
                            <div class="content-main-search-check">
                                <input type="checkbox" id="check2" name="color" value="red">
                                <label>タスク未完了</label>
                            </div>
                        </div>
                        <div class="content-main-search-content">
                            <div class="content-main-search-title">サイト名検索</div>
                            <input class="content-main-search-input" type="text" autocomplete="off">
                        </div>
                    </div>
                    <button class="content-main-search-button">検索</button>
                </div> -->
                <div class="content-main-table">
                    <table class="content-main-table-container">
                        <tr class="content-main-table-allhead">
                            <td class="content-main-table-head">申込み日時</td>
                            <td class="content-main-table-head">企業ID</td>
                            <td class="content-main-table-head">サイト名</td>
                            <td class="content-main-table-head">学生氏名</td>
                            <td class="content-main-table-head">タスク完了</td>
                        </tr>
                        <?php foreach ($choices as $choice) { ?>
                            <tr class="index-main-table-contents-second content-odd">
                                <td class="content-main-table-content"><?= $choice["time"]; ?></td>
                                <td class="content-main-table-content"><?= $choice["agent_id"]; ?></td>
                                <td class="content-main-table-content"><?= $choice["site_name"]; ?></td>
                                <td class="content-main-table-content"><?= $choice["name"]; ?></td>
                                <td class="content-main-table-content">
                                    <div class="content-main-search-check">
                                        <input type="checkbox" name="color" value="red">
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
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