<?php
require_once '../dbconnect.php';
$choice = $dbh->query("SELECT * FROM choice")->fetchAll(PDO::FETCH_ASSOC);
$info = $dbh->query("SELECT * FROM info")->fetchAll(PDO::FETCH_ASSOC);
$choice_ing = $dbh->query("SELECT * FROM choice_ing")->fetchAll(PDO::FETCH_ASSOC);
$user = $dbh->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);
$students = $dbh->query("SELECT * FROM student")->fetchAll(PDO::FETCH_ASSOC);

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit();
}else{

// ユーザーIDはセッションから取得
$user_id = $_SESSION["user_id"];

// 選択企業情報の取得
$sql ="SELECT info.*
        FROM choice_ing
        INNER JOIN info ON choice_ing.agent_id = info.agent_id
        WHERE choice_ing.user_id = :user_id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();
$choices = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// 個人情報の取得
$sql ="SELECT *
        FROM student
        WHERE student.user_id = :user_id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();
$persons = $stmt->fetchAll(PDO::FETCH_ASSOC);





?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>企業一覧、個人情報の確認</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/final.css" />
    <!-- <script src="./assets/js/script.js" defer></script> -->
</head>
<body>
<?php include_once '../includes/header2.php'; ?>
    <div class="final-body">
        <div class="final-wrapper">
            <div class="final-container">
                <div class="final-inner">
                    <div class="final-company">
                        <div class="final-company-title-container">
                            <p class="final-company-title">
                                申込み企業：<?php echo count($choices); ?>社
                            </p>
                        </div>
                        <div class="final-company-table-container">
    <?php foreach ($choices as $info) { ?>
        <div class="final-company-table">
            <div class="final-company-items">
                <div class="final-company-item-logo">
                    <img src="../assets/img/<?=$info["logo"];?>" alt="" class="choice_logo">
                </div>
                <div class="final-company-item-sent">
                    <div class="final-company-item-service"><?=$info["site_name"];?></div>
                    <div class="final-company-item-name"><?=$info["agent_name"];?></div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

                    </div>
                    <div class="final-person">
                        <div class="final-person-title-container">
                            <div class="final-person-title">
                                入力された個人情報
                            </div>
                        </div>
                        <?php foreach ($persons as $student) { ?>
                        <div class="final-person-table-container">
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">お名前</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?=$student["name"];?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">フリガナ</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?=$student["sub_name"];?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">性別</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?=$student["sex"];?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">携帯電話番号</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?=$student["tel_num"];?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">大学名</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?=$student["school"];?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">メールアドレス</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?=$student["mail"];?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">卒業年度</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?=$student["graduation"];?>年卒</div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">文理区分</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?=$student["division"];?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">志望業界</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?=$student["desire"];?></div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="final-submit">
                        <a href="./complete.php" class="final-submit-container">
                                <button class="final-submit-button">申し込む</button>
                        </a>
                        <div class="final-edit-container">
                            <button class="final-edit-button">入力内容を変更する</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once '../includes/footer1.php';
    ?>
</body>
</html>