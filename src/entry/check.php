<?php
require __DIR__ . '/../dbconnect.php';
$users = $dbh->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);
$infos = $dbh->query("SELECT * FROM info")->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query("SELECT * FROM choice_ing")->fetchAll(PDO::FETCH_ASSOC);


session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit();
}else{

// ユーザーIDはセッションから取得
$user_id = $_SESSION["user_id"];


$sql = "SELECT DISTINCT info.*
        FROM choice_ing
        INNER JOIN info ON choice_ing.agent_id = info.agent_id";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$selects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// POSTリクエストが送信された場合の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dbh->beginTransaction();
        
        // 削除する企業のIDを取得
        $id = $_POST["id"];

        // choiceテーブルから対象の企業を削除
        $sql = "DELETE FROM choice_ing WHERE agent_id = :agent_id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":agent_id", $id);
        $stmt->execute();

        // infoテーブルから対象の企業を削除
        // $sql = "DELETE FROM info WHERE id = :id";
        // $stmt = $dbh->prepare($sql);
        // $stmt->bindParam(":id", $id);
        // $stmt->execute();

        $dbh->commit();
        // メッセージをセットしてリダイレクト
        $_SESSION['message'] = "企業の削除に成功しました。";
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } catch (PDOException $e) {
        $dbh->rollBack();
        // エラーメッセージをセットしてリダイレクト
        $_SESSION['message'] = "企業の削除に失敗しました。";
        error_log($e->getMessage());
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

}

?>


<!DOCTYPE html>
<lang html="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>選択企業一覧確認</title>
    <link rel="stylesheet" href="/../assets/css/reset.css">
    <link rel="stylesheet" href="/../assets/css/check.css" />
    <script src="../assets/scripts/common.js" defer>
    </script>
</head>
    
<body>
    <?php
    include_once '../includes/header2.php';
    ?>
    <div class="check-wrapper">
        <div class="check-container">
            <div class="check-inner">
                <div class="check-title">
                    <p class="check-title-sent">step3　選択した企業の確認</p>
                </div>
                <div class="check-table-container">
                    <table border="1" class="check-table">
                        <tr class="check-table-head">
                            <th >企業ロゴ</th>
                            <th >サービス名/企業名</th>
                            <th>総合/特化</th>
                            <th >企業規模</th>
                            <th >地域</th>
                            <th >求人数</th>
                            <th ></th>
                        </tr>
                        <?php foreach ($selects as $info) { ?>
                        <tr class="check-table-item">
                            <td class="check-item">logo</td>
                            <td class="check-item">
                                <div class="check-item-service"><?=$info["site_name"];?></div>
                                <div class="check-company-item-name"><?=$info["agent_name"];?></div>
                            </td>
                            <td class="check-item"><?=$info["type"];?></td>
                            <td class="check-item"><?=$info["size"];?></td>
                            <td class="check-item"><?=$info["area"];?></td>
                            <td class="check-item"><?=$info["amounts"];?></td>
                            <td class="check-item">
                                <form method="POST">
                                    <input type="hidden" value="<?= $info["agent_id"] ?>" name="id">
                                    <input type="submit" value="削除" class="submit check-delete-button">
                                </form>
                            </td>
                        </tr>
                        <?}?>
                    </table>
                </div>
                <a href="../entry/person.php" class="check-next-box">
                    <button class="check-next-button">個人情報入力画面へ</button>
                </a>
            </div>
        </div>
    </div>
    <?php
    include_once '../includes/footer1.php';
    ?>
</body>
</lang>
