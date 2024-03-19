<!-- 選択企業の一覧ページ -->
<?php
require __DIR__ . '/../dbconnect.php';
$users = $dbh->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);
$infos = $dbh->query("SELECT * FROM info")->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query("SELECT * FROM choice")->fetchAll(PDO::FETCH_ASSOC);


$sql="SELECT info.*
        FROM choice
        INNER JOIN info on choice.agent_id=info.agent_id
        WHERE choice.user_id='1'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$selects = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<lang ="ja">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>check</title>
    <link rel="stylesheet" href="/../assets/css/check.css" />
    <script src="../assets/scripts/common.js" defer>
    </script>
    </head>
    
<body>
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
                            <td class="check-item"><?=$info["size"];?></td>
                            <td class="check-item"><?=$info["area"];?></td>
                            <td class="check-item"><?=$info["amounts"];?></td>
                            <td class="check-item">
                                <button class="check-delete-button">削除</button>
                            </td>
                        </tr>
                        <?}?>
                    </table>
                </div>
        <div class="check-next-box">
            <button class="check-next-button">個人情報入力画面へ</button>
        </div>
        </div>
    </div>
    </div>
</body>
</lang>
