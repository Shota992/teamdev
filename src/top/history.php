<?php 
/*require __DIR__ . '/../dbconnect.php';
$choice = $dbh->query("SELECT * FROM choice")->fetchAll(PDO::FETCH_ASSOC);
$info = $dbh->query("SELECT * FROM info")->fetchAll(PDO::FETCH_ASSOC);
$student = $dbh->query("SELECT * FROM student")->fetchAll(PDO::FETCH_ASSOC);
$user = $dbh->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);

session_start();
if (!isset($_SESSION['id'])) {
    header('Location: /auth/login.php');
} else {
$user_id = $_SESSION['id'];

$sql ="SELECT info.*
        FROM choice
        INNER JOIN info ON choice.agent_id = info.agent_id
        WHERE choice.user_id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $user_id);
$stmt->execute();
$choices = $stmt->fetchAll(PDO::FETCH_ASSOC);
}*/
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>history</title>
    <link rel="stylesheet" href="/../assets/css/history.css" />
    <script src="./assets/js/script.js" defer></script>
</head>
<body class="body">
    <?php include_once '../includes/header2.php'; ?>
    <main>
        <div class="history-wrapper">
            <div class="history-container">
                <div class="history-inner">
                    <div class="history-title-container">
                        <p class="history-title">エージェント企業申込み履歴</p>
                    </div>
                    <div class="history-table-container">
                    <table border="1" class="history-table">
                        <tr class="history-table-head">
                            <th >企業ロゴ</th>
                            <th >サービス名/企業名</th>
                            <th >企業規模</th>
                            <th >地域</th>
                            <th >求人数</th>
                        </tr>
                        <?php foreach ($choices as $choice) { ?>
                            <tr class="history-table-item">
                                <td class="history-item"><?=$choice["logo"];?></td>
                                <td class="history-item"><?=$choice["site_name"];?></td>
                                <td class="history-item"><?=$choice["size"];?></td>
                                <td class="history-item"><?=$choice["area"];?></td>
                                <td class="history-item"><?=$choice["amounts"];?></td>
                            </tr>
                        <?php } ?>
                    </table>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <?php
    include_once '../includes/footer1.php';
    ?>
</body>
</html>