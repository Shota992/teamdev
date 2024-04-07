<?php
// require_once('../dbconnect.php');

// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header('Location: /auth/login.php');
//     exit();
// } else {
//     $user_id = $_SESSION["user_id"];
//     $sql = "DELETE FROM choice_ing WHERE user_id=?";
//     $stmt = $dbh->prepare($sql);
//     if ($stmt->execute([$user_id])) {
//     } else {
//     }
// }
// // データベース接続を閉じる
// $dbh = null;
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>申し込み手順</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/entry.css">
    <link rel="stylesheet" href="../assets/sp/sp-proces.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="body_2">
    <?php
    include_once '../includes/header2.php';
    ?>
    <main class="process_main-body">
        <div class="processContainer">
            <section class="processTItle">
                <div class="processTitle1">
                    企業比較→申込みの
                </div>
                <div class="processTitle2">
                    4step
                </div>
            </section>
            <section class="processStepAll">
                <!-- step1 -->
                <div class="processStep1">
                    <div class="processStepImg">
                        <img src="../assets/img/process_step1.png" alt="" class="processNumber-img">
                        <img src="../assets/img/process_steppolygon.png" alt="" class="processPolygon-img">
                    </div>
                    <div class="processStepText">
                        <h2 class="processStepHead">
                            総合型/特化型企業から複数社を選択
                        </h2>
                        <div class="processStepContent">
                            総合型企業：幅広い業界の求人を扱っており、始めから終わりまでサポート<br>
                            特化型企業：ある業界、職種に特化し、より詳しい情報を提供してもらえる<br>
                            <br>
                            複数社に登録することで、それぞれの企業を比較し、<br>
                            自分に合ったアドバイザーに出会えます。<br>
                        </div>
                    </div>
                    <div class="processPersonImg">
                        <img src="../assets/img/process_person1.png" alt="" class="process_personImg">
                    </div>
                </div>
                <!-- step2 -->
                <div class="processStep2">
                    <div class="processStepImg">
                        <img src="../assets/img/process_Step２.png" alt="" class="processNumber-img">
                        <img src="../assets/img/process_steppolygon.png" alt="" class="processPolygon-img">
                    </div>
                    <div class="processStepText">
                        <h2 class="processStepHead">
                            その他にも気になる企業を検索
                        </h2>
                        <div class="processStepContent">
                            step1で選んだ企業以外にも、名前の聞いたことのある企業があった
                            <br>ら選択することができます。積極的に調べてみましょう。
                            <p style="color: red;">(実装中のため、現在この機能はご利用できません)</p>
                        </div>
                    </div>
                    <div class="processPersonImg">
                        <img src="../assets/img/process_person2.png" alt="" class="process_personImg">
                    </div>
                </div>
                <!-- step3 -->
                <div class="processStep3">
                    <div class="processStepImg">
                        <img src="../assets/img/process_Step３.png" alt="" class="processNumber-img">
                        <img src="../assets/img/process_steppolygon.png" alt="" class="processPolygon-img">
                    </div>
                    <div class="processStepText">
                        <h2 class="processStepHead">
                            選んだ企業の確認
                        </h2>
                        <div class="processStepContent">
                            step1とstep2で選んだ企業を確認しましょう。<br>
                            ここで選択企業を編集できます<br>
                        </div>
                    </div>
                    <div class="processPersonImg">
                        <img src="../assets/img/process_person3.png" alt="" class="process_personImg">
                    </div>
                </div>
                <!-- step4 -->
                <div class="processStep4">
                    <div class="processStepImg">
                        <img src="../assets/img/process_Step４.png" alt="" class="processNumber-img">
                    </div>
                    <div class="processStepText">
                        <h2 class="processStepHead">
                            個人情報の登録
                        </h2>
                        <div class="processStepContent">
                            エージェント企業に申し込むのに必要な個人情報を入力してください。<br>
                        </div>
                    </div>
                    <div class="processPersonImg">
                        <img src="../assets/img/process_person4.png" alt="" class="process_personImg">
                    </div>
                </div>
            </section>
            <!-- さっそくｔｒｙ -->
            <section class="processTry">
                <div class="processTry-img">
                    <img src="../assets/img/process_steppolygon.png" alt="" class="processTryPolygon">
                </div>
                <a href="../entry/choice.php" class="process-btn">
                    <button class="process_btn">さっそくTry！</button>
                </a>
            </section>
        </div>
    </main>
    <?php
    include_once '../includes/footer1.php';
    ?>
</body>

</html>