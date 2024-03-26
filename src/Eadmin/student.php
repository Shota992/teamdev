<!-- 学生情報閲覧ページ -->
<?php
require __DIR__ . '/../dbconnect.php';
$students = $dbh->query("SELECT * FROM student")->fetchAll(PDO::FETCH_ASSOC);
$agents = $dbh->query("SELECT * FROM agent")->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query("SELECT * FROM choice")->fetchAll(PDO::FETCH_ASSOC);


$sql="SELECT student.*
        FROM choice
        INNER JOIN student on choice.user_id=student.user_id
        WHERE choice.agent_id='2'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$agents = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="./Eadmin.css" />
    <link rel="stylesheet" href="../assets/css/reset.css" />
    <script src="./assets/js/script.js">
    </script>
</head>

<body class="body-c">
    <header class="header">
        <a href="" class="header-logo" target="_blank" rel="noopener noreferrer">
            <img src="../assets/img/header_logo.png" alt="CRAFT">
        </a>
        <img src="../assets/img/boozer_logo-black.png" alt="boozer">
    </header>
    <main>
        <div class="student-wrapper">
            <div class="side-container">
                <nav class="index-side-contents">
                <a href="#" class="side-content side-choiced">
                    <div class="side-sent side-choiced">学生情報一覧</div>
                </a>
                <a href="./password.php" class="side-content">
                    <div class="side-sent">パスワード変更
                    </div>
                </a>
                <a href="./../top/top.php" class="side-content">
                    <div class="side-sent">ログアウト</div>
                </a>
                </nav>
            </div>
            <div class="student-main-container">
                <div class="student-main-inner">
                    <div class="student-main-head">
                        <div class="student-main-head-container">
                            <div class="student-main-head-sent">エージェント企業一覧</div>
                        </div>
                    </div>
                    <div class="student-main-name">
                        <div class="student-main-name-title">○○企業様</div>
                        <div class="student-main-name-line"></div>
                    </div>
                    <div class="student-main-table">
                        <table  class="student-main-table-container">
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
                            <?php foreach ($agents as $student) { ?>
                                <tr class="student-main-table-contents student-odd">
                                    <td class="student-main-table-content"><?=$student["name"];?></td>
                                    <td class="student-main-table-content"><?=$student["sub_name"];?></td>
                                    <td class="student-main-table-content"><?=$student["sex"];?></td>
                                    <td class="student-main-table-content"><?=$student["school"];?></td>
                                    <td class="student-main-table-content"><?=$student["tel_num"];?></td>
                                    <td class="student-main-table-content"><?=$student["mail"];?></td>
                                    <td class="student-main-table-content"><?=$student["graduation"];?></td>
                                    <td class="student-main-table-content"><?=$student["division"];?></td>
                                    <td class="student-main-table-content"><?=$student["desire"];?></td>
                                    <td class="student-main-table-content">20204/03/12 21:45</td>
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