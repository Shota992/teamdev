<!-- 申し込み完了ページ -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>申し込み完了</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/entry.css">
</head>

<body>
    <?php
    include_once '../includes/header2.php';
    ?>
    <main class="complete_main">
        <div class="complete_container">
            <!-- 申し込みが完了しました -->
            <section class="complete_figure">
                <div class="complete_checkmark">
                    <figure><img src="../assets/img/complete_checkmark.png" alt="" class="complete_checkmark-img"></figure>
                </div>
                <div class="complete_figureContent">
                    <p class="complete_figureText1">申し込みが完了しました</p>
                    <p class="complete_figureText2">お申込みありがとうございました。<br>
                        お申込内容は履歴ページで確認できます。</p>
                </div>
            </section>
            <!-- 今後の流れ -->
            <section class="complete_flowSection">
                <div class="complete_flowHead">
                    <figure><img src="../assets/img/complete_arrow.png" alt="" class="complete_flowHead-img"></figure>
                    <div class="complete_flowHeadText">今後の流れについて</div>
                </div>
                <div class="complete_flowContent">
                    <div class="complete_flowContentText1">WEB申し込み</div>
                    <figure><img src="../assets/img/complete_flow.png" alt="" class="complete_flowContentPolygon"></figure>
                    <div class="complete_flowContentText2">企業から電話かメールでご連絡</div>
                    <figure><img src="../assets/img/complete_flow.png" alt="" class="complete_flowContentPolygon"></figure>
                    <div class="complete_flowContentText2">あなたを担当する就活エージェントと顔合わせ</div>
                </div>
            </section>
            <!-- topページへ戻る -->
            <section class="complete_topSection">
                <a href="../top/aftertop.php">
                    <button class="complete_btn">TOPページへ戻る</button>
                </a>
            </section>
        </div>
    </main>
    <?php
    include_once '../includes/footer1.php';
    ?>
</body>

</html>