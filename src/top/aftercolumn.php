<?php
require_once('../dbconnect.php');

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit();
} else {
    $user_id = $_SESSION["user_id"];
    $sql = "DELETE FROM choice_ing WHERE user_id=?";
    $stmt = $dbh->prepare($sql);
    if ($stmt->execute([$user_id])) {
    } else {
    }
}

// データベース接続を閉じる
$dbh = null;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コラム</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/top.css">
    <link rel="stylesheet" href="../assets/sp/sp-column.css">
</head>

<body class="body_2">
    <?php 
    include_once '../includes/header2.php';
    ?>
    <a href="../entry/proces.php" class="choice-btn-container">
        <div class="choice-btn">
            <p class="link">エージェント<br>企業に<br>申込み</p>
        </div>
    </a>
    <main>
        <div class="container">
            <!-- 目次 -->
            <section class="columnOutline">
                <div class="columnOutlineTitle">目次</div>
                <div class="columnOutlineContent">
                    <div class="columnOutlineList"><a href="#column1">1.エージェント企業とは</a></div>
                    <div class="columnOutlineList"><a href="#column2">2.エージェント企業の選び方</a></div>
                    <div class="columnOutlineList"><a href="#column3">3.活用のポイント</a></div>
                </div>
            </section>
            <!-- コラム１ -->
            <section class="columnContent1" id="column1">
                <div class="columnHead">
                    <h2  class="columnTitleText">
                        1.エージェント企業とは
                    </h2>
                </div>
                <div class="column1Body">
                    <figure class="about-image" data-scroll>
                        <img src="../assets/img/column_1.png" alt="" class="column-img" />
                    </figure>
                    <div class="column1Body-t">
                        <div class="column-text">
                            就活エージェントとは、就職活動を支援してくれるサービスです。
                            <br>
                            <br>
                            就活生一人ひとりに専任のアドバイザーが付き、就活のあらゆる場面でサポートします。
                            <br>
                            <br>
                            就活エージェントは、企業から紹介料をもらって成り立っているため就活生は<span class="text-bold">無料で</span>利用
                            することができます。
                            <br>
                            <br>
                            企業は、就活エージェントを介して採用することで採用コストを抑えることができるので、<br>
                            就活エージェントに紹介料を払います。
                        </div>
                    </div>
                </div>
            </section>
            <!-- コラム２ -->
            <section class="columnContent2" id="column2">
                <div class="columnHead">
                    <h2  class="columnTitleText" data-scroll>
                        2.エージェント企業の選び方
                    </h2>
                </div>
                <div class="column2Body">
                    <figure class="column-image" data-scroll>
                        <img src="../assets/img/column_2.png" alt="" class="column-img" />
                    </figure>
                    <div class="columnContent">
                        <div class="column-textTitle" data-scroll>
                            求人数が多い
                        </div>
                        <div class="columnList">
                            <div class="column-text">
                            求人数が多いほど、自分の希望する<span class="text-bold">企業や職種を見つけられる可能性が高く</span>なります。
                            <br>
                            <br>
                            就活エージェントは、企業から紹介料をもらって成り立っています。
                            <br>
                            <br>
                            そのため、企業から多くの求人を集めるために、就活エージェントは競争をしています。
                            <br>
                            <br>
                            また求人数が多い就活エージェントは、企業から多くの求人を集めることができているため、信頼性が高いと言えます。
                            <br>
                            <br>
                            求人数が多いことで、就活生は自分の希望する企業や職種を見つけられる可能性が高くなります。
                            </div>
                        </div>
                        <div class="column-textTitle" data-scroll>
                            自宅から通いやすい・もしくはオンライン面談に対応
                        </div>
                        <div class="columnList">
                            <div class="column-text">
                            就活エージェントを利用するためには、キャリアアドバイザーとの面談が必要です。
                            <br>
                            <br>
                            面談は、一般的にオフィスで行われるため、自宅から通いにくいと、面談の予約や当日の移動に手間がかかります。また、面談の予約が取りづらい場合もあります。
                            <br>
                            <br>
                            オンライン面談に対応している就活エージェントであれば、自宅から気軽に面談を受けることができます。
                            <br>
                            <br>
                            オンライン面談は、WEB会議システムを使って行うため、場所や時間を選ばずに面談を受けることができます。
                            <br>
                            <br>
                            そのため、就活エージェントを選ぶ際には、自宅から通いやすい、もしくはオンライン面談に対応しているかどうかを必ず確認しましょう。
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- コラム３ -->
            <section class="columnContent3" id="column3">
                <div class="columnHead">
                    <h2  class="columnTitleText" data-scroll>
                        3.活用のポイント
                    </h2>
                </div>
                <div class="column3Body">
                    <figure class="column-image" data-scroll>
                        <img src="../assets/img/column_3.png" alt="" class="column-img" />
                    </figure>
                    <div class="columnContent">
                        <div class="column-textTitle" data-scroll>
                            就活エージェントは複数社登録しておく
                        </div>
                        <div class="columnList">
                            <div class="column-text">
                            就活エージェントを活用するなら、1社だけでなく、<span class="text-bold">複数社に登録しておく</span>ことがおすすめです。
                            <br>
                            <br>
                            なぜなら、1社だけ利用しても、そのエージェントが自分に合っているかどうかの比較検討ができないからです。
                            <br>
                            <br>
                            また、就活エージェントが提供するサービスは、キャリアアドバイザーとの相性に大きく依存します。
                            <br>
                            <br>
                            そのため、いくら人気の就活エージェントでも、担当するアドバイザーによってサービスの感じ方は大きく変わることが多いです。
                            <br>
                            <br>
                            さらに同じ就活相談しても、キャリアアドバイザーによって返ってくる返答は異なります。キャリアアドバイザーから自分に最適なアドバイスを引き出すという意味でも、複数社登録しておくのが有効です。
                            </div>
                        </div>
                        <div class="column-textTitle" data-scroll>
                            総合型と特化型の就活エージェントを使い分ける
                        </div>
                        <div class="columnList">
                            <div class="column-text">
                            就活エージェントには、総合型と特化型の2種類があります。
                            <br>
                            <br>
                            【総合型】総合型の就活エージェントは、<span class="text-bold">幅広い業界・職種</span>の求人を扱っています。就活の始めから終わりまで、トータルでサポートしてくれるのが特徴です。
                            <br>
                            <br>
                            【特化型】特化型の就活エージェントは、<span class="text-bold">特定の業界・職種</span>に特化しています。その業界・職種に詳しいアドバイザーが、就活をサポートしてくれるのが特徴です。
                            <br>
                            <br>
                            就活生は、自分の志望業界や職種に合わせて、総合型か特化型の就活エージェントを選ぶとよいでしょう。
                            </div>
                        </div>
                        <div class="column-textTitle" data-scroll>
                            相性の合わないキャリアアドバイザーなら変更してもらう
                        </div>
                        <div class="columnList">
                        <div class="column-text">
                            就活エージェントのキャリアアドバイザーとの相性が合わないと感じたら、すぐに変更を申し出るようにしましょう。
                            <br>
                            <br>
                            どの就活エージェントもキャリアアドバイザーの育成や質の向上に力を入れていますが、それでも相性の合わない人にあたってしまうことはあります。
                            <br>
                            <br>
                            初回面談や数回のやりとりを通して、「このアドバイザーと自分は合わない…」と感じたら、キャリアアドバイザーの変更を申し出ましょう。
                            <br>
                            <br>
                            その際に、「なぜ合わないと思ったのか」「どこを改善してほしいのか」を具体的に伝えれば、就活エージェント側も希望に合ったキャリアアドバイザーを紹介しやすくなります。
                        </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <?php 
    include_once '../includes/footer1.php'; 
    ?>
</body>

</html>