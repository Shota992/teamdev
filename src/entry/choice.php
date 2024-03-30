<?php
require __DIR__ . '/../dbconnect.php';
$choice = $dbh->query("SELECT * FROM choice")->fetchAll(PDO::FETCH_ASSOC);
$info = $dbh->query("SELECT * FROM info")->fetchAll(PDO::FETCH_ASSOC);
$choice_ing = $dbh->query("SELECT * FROM choice_ing")->fetchAll(PDO::FETCH_ASSOC);
$user = $dbh->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: /auth/login.php');
    exit(); // リダイレクト後にスクリプトの実行を終了する
}

// ユーザーIDはセッションから取得
$user_id = $_SESSION["id"];

// 総合型企業の情報を取得
$sql ="SELECT * FROM info WHERE type = '総合'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$generals = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 特化型企業の情報を取得
$sql1 ="SELECT * FROM info WHERE type = '特化'";
$stmt = $dbh->prepare($sql1);
$stmt->execute();
$specials = $stmt->fetchAll(PDO::FETCH_ASSOC);

// // POSTリクエストがあるかどうかを確認
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["agent_id"])) {
        // POSTデータからagent_idを取得
        $agent_id = $_POST["agent_id"];

        // SQL文の作成と実行（プリペアドステートメントを使用）
        $sql = "INSERT INTO choice_ing (agent_id, user_id) VALUES (?, ?)";
        $stmt = $dbh->prepare($sql);
        if ($stmt->execute([$agent_id, $user_id])) {
            echo"挿入できました";
        } else {
            echo "エラー: 挿入に失敗しました。";
        }
    }
}else{
    echo "POSTできてません";
}





if (isset($_POST["search_site"])){
    $search_site = $_POST["search_site"];

    //実行
    $sql = "SELECT * FROM info WHERE site_name LIKE ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(["%$search_site%"]);
    $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    $infos = array();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/choice.css">
<!--     <link rel="stylesheet" href="../assets/css/entry.css"> -->
    <title>choice</title>
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <script
      script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script>
    <script src="../assets/scripts/common.js" defer></script>
</head>
<body>
        <div class="wrapper">
            <div class="inner">
                <!-- <div class="left-button">
                </div>
                <div class="left-button">
                </div> -->
                <div class="choices">
                    <div class="description">
                        <div >
                            <p class="title">step1　総合型企業と特化型企業からそれぞれ選んでみる</p>
                        </div>
                        <div class="sentence">
                            <p>総合型企業：幅広い業界の求人を扱っており、始めから終わりまでサポート</p>
                            <p>特化型企業：ある業界、職種に特化し、より詳しい情報を提供してもらえる</p>
                        </div>
                    </div>
                    <div class="general">
                        <div>
                            <h2 class="title-sub">総合型企業の一覧</h2>
                        </div>
                        <div class="container">
                            <div class="slider-container">
                                <ul class="slider " >
                                <?php foreach ($generals as $info) { ?>
                                    <li class="slide">
                                        <div class="slider-img">
                                            <img src="" alt=""/>
                                        </div>
                                        <div class="slider-titles">
                                            <p class="slider-title" id="companyName"><?=$info["site_name"];?></p>
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
                                            <p><?=$info["agent_name"];?></p>
                                            <p><?=$info["explanation"];?></p>
                                            <p><?=$info["area"];?></p>
                                            <p><?=$info["amounts"];?></p>
                                        </div>
                                        <form class="question-form" method="POST" action="./choice.php">
                                                <button type="submit" name="agent_id" value="<?=$info["agent_id"];?>">追加</button>
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
                                            <img src="" alt=""/>
                                        </div>
                                        <div class="slider-titles">
                                            <p class="slider-title" id="companyName">企業名</p>
                                        </div>
                                        <div class="slider-tags">
                                            <?php if ($info['category'] == '営業') { ?>
                                                <div class="slider-tag red eigyou">
                                                    <p class="slider-tagsent">営業</p>
                                                </div>
                                            <?php }elseif ($info['category'] == 'IT') { ?>
                                                <div class="slider-tag blue IT">
                                                    <p class="slider-tagsent">IT</p>
                                                </div>
                                            <?php }elseif ($info['category'] == 'Web') { ?>
                                                <div class="slider-tag blue Web">
                                                    <p class="slider-tagsent">Web</p>
                                                </div>
                                            <?php }elseif ($info['category'] == '税理士') { ?>
                                                <div class="slider-tag yellow zei">
                                                    <p class="slider-tagsent">税理士</p>
                                                </div>
                                            <?php }elseif ($info['category'] == '会計士') { ?>
                                                <div class="slider-tag yellow kaikei">
                                                    <p class="slider-tagsent">会計士</p>
                                                </div>
                                            <?php }elseif ($info['category'] == '介護士') { ?>
                                                <div class="slider-tag green kaigo">
                                                    <p class="slider-tagsent">介護士</p>
                                                </div>
                                            <?php }elseif ($info['category'] == 'リハビリ') { ?>
                                                <div class="slider-tag green riha">
                                                    <p class="slider-tagsent">リハビリ</p>
                                                </div>
                                            <?php }elseif ($info['category'] == '保育士') { ?>
                                                <div class="slider-tag green hoiku">
                                                    <p class="slider-tagsent">保育士</p>
                                                </div>
                                            <?php }elseif ($info['category'] == '看護師') { ?>
                                                <div class="slider-tag green kango">
                                                    <p class="slider-tagsent">看護師</p>
                                                </div>
                                            <?php }elseif ($info['category'] == '女性') { ?>
                                                <div class="slider-tag pink woman">
                                                    <p class="slider-tagsent">女性</p>
                                                </div>
                                            <?php }elseif ($info['category'] == '外資系') { ?>
                                                <div class="slider-tag purple gaisi">
                                                    <p class="slider-tagsent">外資系</p>
                                                </div>
                                            <? } ?>
                                        </div>
                                        <div class="slider-contents">
                                            <p><?=$info["agent_name"];?></p>
                                            <p><?=$info["explanation"];?></p>
                                            <p><?=$info["area"];?></p>
                                            <p><?=$info["amounts"];?></p>
                                        </div>
                                        <form class="question-form" method="POST" action="./choice.php">
                                                <button type="submit" name="agent_id" value="<?=$info["agent_id"];?>">追加</button>
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
                                    <div class="special-search1">
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
                                    <div class="special-search1">
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
                        </div>
                    </div>
                    <div class="sub-search-container">
                        <form method="POST" action="./choice.php">
                        <div class="sub-search">
                            <p>
                                企業名の検索
                            </p>
                            <div class="kyc-search-bar">
                                <input class="kyc-search-box" type="text" placeholder="検索" autocomplete="off" name="search-site" value="<?php if( !empty($_POST['search_site']) ){ echo $_POST['search_site']; } ?>">
                            </div>
                        </div>
                        <div class="submit-container">
                            <button class="submit">
                                <input type="submit" name="search" value="検索">
                            </button>
                        </div>
                        </form>
                        <?php foreach ($infos as $info){?>
                        <div class="search-result">
                            <div class="sub-search-image"><?=$info["logo"];?></div>
                            <div class="sub-search-title"><?=$info["site_name"];?></div>
                            <button class="sub-search-choice">追加</button>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="finished">
                    <button class="submit">完了</button>
                </div>
            </div>
        </div>

</body>
</html>