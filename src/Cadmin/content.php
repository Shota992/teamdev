<!-- 申込内容一覧ページ -->
<?php
require __DIR__ . '/../dbconnect.php';
$choice = $dbh->query("SELECT * FROM choice")->fetchAll(PDO::FETCH_ASSOC);
$info = $dbh->query("SELECT * FROM info")->fetchAll(PDO::FETCH_ASSOC);
$student = $dbh->query("SELECT * FROM student")->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT info.agent_id, info.site_name, student.name
        FROM choice
        INNER JOIN info ON choice.agent_id = info.agent_id
        INNER JOIN student ON choice.user_id = student.id";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$choices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>content</title>
    <link rel="stylesheet" href="./Cadmin.css" />
    <script src="./assets/js/script.js" defer></script>
</head>
<body class="body-c">
    <header class="header">
        <a href="" class="header-logo" target="_blank" rel="noopener noreferrer">
            <img src="../../assets/img/header_logo.png" alt="CRAFT">
        </a>
        <img src="../../assets/img/boozer_logo-black.png" alt="boozer">
    </header>
    <main>
        <div class="index-wrapper">
            <div class="side-container">
                <div class="index-side-contents">
                <div class="side-content ">
                    <div class="side-sent ">エージェント企業一覧</div>
                </div>
                <div class="side-content">
                    <div class="side-sent">エージェント企業新規登録
                    </div>
                </div>
                <div class="side-content">
                    <div class="side-sent">新規管理者登録</div>
                </div>
                <div class="side-content side-choiced">
                    <div class="side-sent side-choiced">申込み内容一覧</div>
                </div>
                <div class="side-content">
                    <div class="side-sent">ログアウト</div>
                </div>
                </div>
            </div>
            <div class="content-main-container">
                <div class="content-main-inner">
                    <div class="content-main-head">
                        <div class="content-main-head-container">
                            <div class="content-main-head-sent">申し込み内容一覧</div>
                        </div>
                    </div>
                    <div class="content-main-search">
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
                    </div>
                    <div class="content-main-table">
                        <table  class="content-main-table-container">
                            <tr class="content-main-table-head">
                                <td class="content-main-table-content">申込み日時</td>
                                <td class="content-main-table-content">企業ID</td>
                                <td class="content-main-table-content">サイト名</td>
                                <td class="content-main-table-content">学生氏名</td>
                                <td class="content-main-table-content">タスク完了</td>
                            </tr>
                            <?php foreach ($choices as $choice) { ?>
                            <tr class="index-main-table-contents content-odd">
                                <td class="content-main-table-content">24/04/01</td>
                                <td class="content-main-table-content"><?=$choice["agent_id"];?></td>
                                <td class="content-main-table-content"><?=$choice["site_name"];?></td>
                                <td class="content-main-table-content"><?=$choice["name"];?></td>
                                <td class="content-main-table-content">
                                    <div class="content-main-search-check">
                                        <input type="checkbox" name="color" value="red">
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-copyright">
            <small class="copyright">&copy; POSSE,Inc</small>
        </div>
    </footer>
</body>
</html>