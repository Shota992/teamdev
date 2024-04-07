<?php
// require __DIR__ . '/../dbconnect.php';
// $choice = $dbh->query("SELECT * FROM choice")->fetchAll(PDO::FETCH_ASSOC);
// $info = $dbh->query("SELECT * FROM info")->fetchAll(PDO::FETCH_ASSOC);
// $choice_ing = $dbh->query("SELECT * FROM choice_ing")->fetchAll(PDO::FETCH_ASSOC);
// $user = $dbh->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);

// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header('Location: /auth/login.php');
//     exit();
// } else {

//     // ユーザーIDはセッションから取得
//     $user_id = $_SESSION["user_id"];

//     // 総合型企業の情報を取得
//     $sql = "SELECT * FROM info WHERE type = '総合型'";
//     $stmt = $dbh->prepare($sql);
//     $stmt->execute();
//     $generals = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     // 特化型企業の情報を取得
//     $sql1 = "SELECT * FROM info WHERE type = '特化型'";
//     $stmt = $dbh->prepare($sql1);
//     $stmt->execute();
//     $specials = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     // POSTリクエストがあるかどうかを確認
//     if ($_SERVER["REQUEST_METHOD"] == "POST") {
//         if (isset($_POST["agent_id"])) {
//             // POSTデータからagent_idを取得
//             $agent_id = $_POST["agent_id"];

//             // SQL文の作成と実行（プリペアドステートメントを使用）
//             $sql = "INSERT INTO choice_ing (agent_id, user_id) VALUES (?, ?)";
//             $stmt = $dbh->prepare($sql);
//             if ($stmt->execute([$agent_id, $user_id])) {
//                 echo "挿入できました";
//             } else {
//                 echo "エラー: 挿入に失敗しました。";
//             }
//         }
//     }


//     $searchQuery = '';

//     // 検索フォームがサブミットされたかどうかをチェック
//     if (isset($_POST['search-site'])) {
//         // POSTされた検索クエリを取得
//         $searchQuery = '%' . $_POST['search-site'] . '%';
//         // SQL文の作成と実行
//         $sql = "SELECT logo, site_name, agent_id FROM info WHERE site_name LIKE ?";
//         $stmt = $dbh->prepare($sql);
//         $stmt->execute([$searchQuery]);
//         $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     } else {
//         $searchResults = array();
//     }

//     // choice_ingテーブルのカラム数を取得
//     $sql = "SELECT COUNT(*) FROM choice_ing WHERE user_id = ?";
//     $stmt = $dbh->prepare($sql);
//     $stmt->execute([$user_id]);
//     $count = $stmt->fetchColumn();
// }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="/assets/css/choice.css">
    <link rel="stylesheet" href="../assets/sp/sp-choice.css">
    <title>エージェント企業選択</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="../assets/scripts/common.js" defer></script>
</head>


<body class="body">
    <?php
    include_once '../includes/header2.php';
    ?>
    <div class="wrapper">
        <div class="inner">
            <div class="choices">
                <div class="description">
                    <div>
                        <p class="title">step1　総合型企業と特化型企業からそれぞれ選んでみる</p>
                    </div>
                    <div class="sentence">
                        <p>総合型企業：幅広い業界の求人を扱っており、始めから終わりまでサポート</p>
                        <br>
                        <p>特化型企業：ある業界、職種に特化し、より詳しい情報を提供してもらえる</p>
                    </div>
                </div>
                <div class="general">
                    <div>
                        <h2 class="title-sub">総合型企業の一覧</h2>
                    </div>
                    <div class="container">
                        <div class="slider-container">
                            <ul class="slider ">
                                <?php foreach ($generals as $info) { ?>
                                    <li class="slide">
                                        <div class="slider-img">
                                            <img src="../assets/img/<?= $info["logo"]; ?>" alt="" / class="choice_logo">
                                        </div>
                                        <div class="slider-titles">
                                            <div class="slider-title" id="companyName"><?= $info["site_name"]; ?></div>
                                            <div class="slider-subtitle"><?= $info["agent_name"]; ?></div>
                                        </div>
                                        <div class="slider-tags">
                                            <?php if ($info['size'] == '大手') { ?>
                                                <div class="slider-tag big">
                                                    <p class="slider-tagsent">大手</p>
                                                </div>
                                            <?php } elseif ($info['size'] == '中小') { ?>
                                                <div class="slider-tag small ">
                                                    <p class="slider-tagsent">中小</p>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="slider-contents">
                                            <div class="choice-explanation-container">
                                                <p class="choice_explanation"><?= $info["explanation"]; ?></p>
                                            </div>
                                            <p style="margin: 15px 0;">地域　：<?= $info["area"]; ?></p>
                                            <p>求人数：約<?= $info["amounts"]; ?>件</p>
                                        </div>
                                        <form class="add-form" method="POST" action="./choice.php">
                                            <input type="hidden" name="agent_id" value="<?= $info["agent_id"]; ?>">
                                            <button type="button" class="add-button add<?= $info["agent_id"]; ?>">選択</button>
                                            <div class="delete-button delete<?= $info["agent_id"]; ?>">選択済み</div>
                                        </form>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="general-searches">
                            <p class="general-search-sentence">絞り込み</p>
                            <div class="general-search">
                                <div class="checklist">
                                    <div class="checkbox">
                                        <input type="checkbox" name="general" value="big" checked>
                                    </div>
                                    <div class="slider-tag big">
                                        <p class="slider-tagsent">大手</p>
                                    </div>
                                </div>
                                <div class="checklist">
                                    <div class="checkbox">
                                        <input type="checkbox" name="general" value="small" checked>
                                    </div>
                                    <div class="slider-tag small">
                                        <p class="slider-tagsent">中小</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="general">
                    <div class="title-sub">
                        <h2>特化型企業の一覧</h2>
                    </div>
                    <div class="special-container container">
                        <div class="slider-container">
                            <ul class="slider">
                                <?php foreach ($specials as $info) { ?>
                                    <li class="slide">
                                        <div class="slider-img">
                                            <img src="../assets/img/<?= $info["logo"]; ?>" alt="" / class="choice_logo">
                                        </div>
                                        <div class="slider-titles">
                                            <div class="slider-title" id="companyName"><?= $info["site_name"]; ?></div>
                                            <div class="slider-subtitle"><?= $info["agent_name"]; ?></div>
                                        </div>
                                        <div class="slider-tags">
                                            <?php if ($info['category'] == '営業') { ?>
                                                <div class="slider-tag red eigyou">
                                                    <p class="slider-tagsent">営業</p>
                                                </div>
                                            <?php } elseif ($info['category'] == 'IT') { ?>
                                                <div class="slider-tag blue IT">
                                                    <p class="slider-tagsent">IT</p>
                                                </div>
                                            <?php } elseif ($info['category'] == 'Web') { ?>
                                                <div class="slider-tag blue Web">
                                                    <p class="slider-tagsent">Web</p>
                                                </div>
                                            <?php } elseif ($info['category'] == '税理士') { ?>
                                                <div class="slider-tag yellow zei">
                                                    <p class="slider-tagsent">税理士</p>
                                                </div>
                                            <?php } elseif ($info['category'] == '会計士') { ?>
                                                <div class="slider-tag yellow kaikei">
                                                    <p class="slider-tagsent">会計士</p>
                                                </div>
                                            <?php } elseif ($info['category'] == '介護士') { ?>
                                                <div class="slider-tag green kaigo">
                                                    <p class="slider-tagsent">介護士</p>
                                                </div>
                                            <?php } elseif ($info['category'] == 'リハビリ') { ?>
                                                <div class="slider-tag green riha">
                                                    <p class="slider-tagsent">リハビリ</p>
                                                </div>
                                            <?php } elseif ($info['category'] == '保育士') { ?>
                                                <div class="slider-tag green hoiku">
                                                    <p class="slider-tagsent">保育士</p>
                                                </div>
                                            <?php } elseif ($info['category'] == '看護師') { ?>
                                                <div class="slider-tag green kango">
                                                    <p class="slider-tagsent">看護師</p>
                                                </div>
                                            <?php } elseif ($info['category'] == '女性') { ?>
                                                <div class="slider-tag pink woman">
                                                    <p class="slider-tagsent">女性</p>
                                                </div>
                                            <?php } elseif ($info['category'] == '外資系') { ?>
                                                <div class="slider-tag purple gaisi">
                                                    <p class="slider-tagsent">外資系</p>
                                                </div>
                                            <? } ?>
                                        </div>
                                        <div class="slider-contents">
                                            <div class="choice-explanation-container">
                                                <p class="choice_explanation"><?= $info["explanation"]; ?></p>
                                            </div>
                                            <p style="margin: 10px 0;">地域　：<?= $info["area"]; ?></p>
                                            <p>求人数：<?= $info["amounts"]; ?></p>
                                        </div>
                                        <form class="add-form" method="POST" action="./choice.php">
                                            <input type="hidden" name="agent_id" value="<?= $info["agent_id"]; ?>">
                                            <button type="button" class="add-button add<?= $info["agent_id"]; ?>">選択</button>
                                            <div class="delete-button delete<?= $info["agent_id"]; ?>">選択済み</div>
                                        </form>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="general-searches">
                            <p class="general-search-sentence">絞り込み</p>
                            <div class="special-search">
                                <div class="special-search1">
                                    <div class="checklist">
                                        <div class="checkbox">
                                            <input type="checkbox" name="special" value="eigyou" checked>
                                        </div>
                                        <div class="slider-tag red">
                                            <p class="slider-tagsent">営業</p>
                                        </div>
                                    </div>
                                    <div class="checklist">
                                        <div class="checkbox">
                                            <input type="checkbox" name="special" value="IT" checked>
                                        </div>
                                        <div class="slider-tag blue">
                                            <p class="slider-tagsent">IT</p>
                                        </div>
                                    </div>
                                    <div class="checklist">
                                        <div class="checkbox">
                                            <input type="checkbox" name="special" value="Web" checked>
                                        </div>
                                        <div class="slider-tag blue">
                                            <p class="slider-tagsent">Web</p>
                                        </div>
                                    </div>
                                    <div class="checklist">
                                        <div class="checkbox">
                                            <input type="checkbox" name="special" value="zei" checked>
                                        </div>
                                        <div class="slider-tag yellow">
                                            <p class="slider-tagsent">税理士</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="special-search2">
                                    <div class="checklist">
                                        <div class="checkbox">
                                            <input type="checkbox" name="special" value="kaikei" checked>
                                        </div>
                                        <div class="slider-tag yellow">
                                            <p class="slider-tagsent">会計士</p>
                                        </div>
                                    </div>
                                    <div class="checklist">
                                        <div class="checkbox">
                                            <input type="checkbox" name="special" value="kaigo" checked>
                                        </div>
                                        <div class="slider-tag green">
                                            <p class="slider-tagsent">介護士</p>
                                        </div>
                                    </div>
                                    <div class="checklist">
                                        <div class="checkbox">
                                            <input type="checkbox" name="special" value="riha" checked>
                                        </div>
                                        <div class="slider-tag green">
                                            <p class="slider-tagsent">リハビリ</p>
                                        </div>
                                    </div>
                                    <div class="checklist">
                                        <div class="checkbox">
                                            <input type="checkbox" name="special" value="hoiku" checked>
                                        </div>
                                        <div class="slider-tag green">
                                            <p class="slider-tagsent">保育士</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="special-search3">
                                    <div class="checklist">
                                        <div class="checkbox">
                                            <input type="checkbox" name="special" value="kango" checked>
                                        </div>
                                        <div class="slider-tag green">
                                            <p class="slider-tagsent">看護師</p>
                                        </div>
                                    </div>
                                    <div class="checklist">
                                        <div class="checkbox">
                                            <input type="checkbox" name="special" value="woman" checked>
                                        </div>
                                        <div class="slider-tag pink">
                                            <p class="slider-tagsent">女性</p>
                                        </div>
                                    </div>
                                    <div class="checklist">
                                        <div class="checkbox">
                                            <input type="checkbox" name="special" value="gaisi" checked>
                                        </div>
                                        <div class="slider-tag purple">
                                            <p class="slider-tagsent">外資系</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="search">
                <div class="description">
                    <div class="title">
                        <p>step2　その他の企業も調べて追加する(任意)</p>
                    </div>
                    <div class="sentence">
                        <p>step1で選んだ企業以外にも、絞り込みや検索をして企業を追加できます。</p>
                        <p style="color: red;">(実装中のため、現在この機能はご利用できません)</p>
                    </div>
                </div>
                <!-- <div class="sub-search-container">
                    <form method="POST" action="./choice.php">
                        <div class="sub-search">
                            <p class="search-title">企業名の検索</p>
                            <div class="kyc-search-bar">
                                <input class="kyc-search-box" type="text" placeholder="検索" autocomplete="off" name="search-site" value="
                                <?php 
                                // if (!empty($_POST['search-site'])) {
                                //     echo $_POST['search-site'];
                                // } 
                                ?>">
                            </div>
                        </div>
                        <div class="submit-container">
                            <button name="search" class="search_button">
                                <input type="submit" name="search" value="検索">
                            </button>
                        </div>
                    </form>
                </div> -->
            </div>
            <div class="search-result-container">
                <div class="search-result">
                    <ul>
                        <!-- <?php foreach ($searchResults as $info) { ?>
                                <li>
                                    <img src="<?= $info["logo"]; ?>" alt="Logo">
                                    <p><?= $info["site_name"]; ?></p>
                                </li>
                            <?php } ?> -->

                    </ul>
                </div>
            </div>
            <div class="complete-button">
                <button id="complete-btn">次にすすむ</button>
                <p id="message" style="color: red; text-align: center;"></p>
            </div>
        </div>
    </div>
    <?php include_once '../includes/footer1.php' ?>


    <script>
        $(document).ready(function() {
            $('.add-button').click(function() {
                var form = $(this).closest('form');
                var formData = form.serialize();
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: formData,
                    success: function(response) {
                        // 成功時の処理
                        console.log(response);
                        alert('挿入が完了しました');
                    },
                    error: function(xhr, status, error) {
                        // console.error(xhr.responseText);
                        alert('エラーが発生しました。挿入に失敗しました。');
                    }
                });
            });
        });


        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault();

                var searchQuery = $(this).find('input[name="search-site"]').val();
                $.ajax({
                    type: 'POST',
                    url: 'choice.php',
                    data: {
                        'search-site': searchQuery
                    },
                    beforeSend: function() {
                        $('.search-result').empty();
                    },
                    success: function(response) {
                        console.log(response);
                        $('.search-result').html(response);
                        alert('検索しました');
                    },
                    error: function(xhr, status, error) {
                        alert('エラーが発生しました。検索に失敗しました。');
                    }
                });
            });
        });

        $(document).ready(function() {
            // choice_ingテーブルのレコード数をJavaScriptに埋め込む
            var recordCount = <?php echo count($choice_ing); ?>;

            $(document).ready(function() {
                // 完了ボタンがクリックされたときの処理
                $('#complete-btn').click(function() {
                    // カラム数が3個以上の場合
                    if (recordCount >= 3) {
                        // edit.phpに遷移
                        window.location.href = 'http://localhost:8080/entry/check.php';
                    } else {
                        // メッセージを表示
                        $('#message').text('3個以上追加しましょう');
                    }
                });

                // 追加ボタンがクリックされたときの処理
                $('.add-button').click(function() {
                    // カラム数を1増やす
                    recordCount++;

                    // カラム数が3個以上になった場合
                    if (recordCount >= 3) {
                        // メッセージをクリア
                        $('#message').text('');
                    }
                });
            });

        });


        $(document).ready(function() {
            // 各フォームの処理
            $('.add-form').each(function() {
                // フォーム内のagent_idを取得
                var agentId = $(this).find('input[name="agent_id"]').val();

                // choice_ingテーブルにagent_idが存在するかを確認
                var isInChoiceIng = <?php echo json_encode(in_array($info["agent_id"], array_column($choice_ing, 'agent_id'))); ?>;

                // 初期表示の設定
                if (isInChoiceIng) {
                    $('.add' + agentId).hide(); // 追加ボタンを非表示
                    $('.delete' + agentId).show(); // 取り消しボタンを表示
                } else {
                    $('.delete' + agentId).hide(); // 取り消しボタンを非表示
                    $('.add' + agentId).show(); // 追加ボタンを表示
                }

                // 追加ボタンがクリックされたときの処理
                $('.add' + agentId).click(function() {
                    $('.add' + agentId).hide(); // 追加ボタンを非表示
                    $('.delete' + agentId).show(); // 取り消しボタンを表示
                });
            });
        });
    </script>

</body>

</html>