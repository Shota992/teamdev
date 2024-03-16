<!-- エージェント企業一覧ページ -->
<?php
// session_start();

require __DIR__ . '/../dbconnect.php';
$infos = $dbh->query("SELECT * FROM info")->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["search"])) {

if (isset($_POST["search_site"]) && empty($_POST["search_agent"])){
$search_site = $_POST["search_site"];
$search_agent = '';
}

if (empty($_POST["search_site"]) && isset($_POST["search_agent"])){
$search_site = '';
$search_agent = $_POST["search_agent"];
}

if (isset($_POST["search_site"]) && isset($_POST["search_agent"])){
$search_site = $_POST["search_site"];
$search_agent = $_POST["search_agent"];
}

//実行
$sql="SELECT * FROM info WHERE site_name like '%{$search_site}%' and agent_name like '%{$search_agent}%'";
$in = $dbh->prepare($sql);
$in->execute();
$infos = $in->fetchAll(PDO::FETCH_ASSOC);

}else{

// //「検索」ボタン押下してないとき
// $sql='SELECT * FROM fruit WHERE 1';
// $rec = $dbh->prepare($sql);
// $rec->execute();
// $rec_list = $rec->fetchAll(PDO::FETCH_ASSOC);
}

//データベース切断
$dbh=null;

// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="./Cadmin.css" />
    <script src="./assets/js/script.js">
    </script>
</head>
<body class="body-c">
    <div class="index-wrapper">
        <div class="side-container">
            <div class="index-side-contents">
            <a class="side-content side-choiced">
                <div class="side-sent side-choiced">エージェント企業一覧</div>
            </a>
            <a class="side-content">
                <div class="side-sent">エージェント企業新規登録
                </div>
            </a>
            <a class="side-content">
                <div class="side-sent">新規管理者登録</div>
            </a>
            <a class="side-content">
                <div class="side-sent">申込み内容一覧</div>
            </a>
            <a class="side-content">
                <div class="side-sent">ログアウト</div>
            </a>
            </div>
        </div>
        <div class="index-main-container">
            <div class="index-main-inner">
                <div class="index-main-head">
                    <div class="index-main-head-container">
                        <div class="index-main-head-sent">エージェント企業一覧</div>
                    </div>
                </div>
                <div class="index-main-search">
                    <div class="index-main-search-contents">
                        <div class="index-main-search-content">
                            <div class="index-main-search-title">サービス名</div>
                            <input class="index-main-search-input" type="text" placeholder="検索" autocomplete="off" name="search-site" value="<?php if( !empty($_POST['search_site']) ){ echo $_POST['search_site']; } ?>">
                        </div>
                        <div class="index-main-search-content">
                            <div class="index-main-search-title">企業名</div>
                            <input class="index-main-search-input" type="text" placeholder="検索" autocomplete="off" name="search-agent" value="<?php if( !empty($_POST['search_agent']) ){ echo $_POST['search_agent']; } ?>">
                        </div>
                        <button class="index-main-search-button">
                            <input type="submit" name="search" value="検索">
                        </button>
                    </div>
                </div>
                <div class="index-main-table">
                    <table  class="index-main-table-conainer">
                        <tr class="index-main-table-head">
                            <td class="index-main-table-content">企業ID</td>
                            <td class="index-main-table-content">サービス名</td>
                            <td class="index-main-table-content">企業名</td>
                            <td class="index-main-table-content">メールアドレス</td>
                        </tr>
                        <?php foreach ($infos as $info) { ?>
                            <a href="./egent/edit.php?id=<?= $info["id"] ?>">
                            <tr class="index-main-table-contents index-odd" id="infos-<?= $info["id"] ?>">
                                    <td class="index-main-table-content">
                                        <?=$info["agent_id"];?>
                                    </td>
                                    <td class="index-main-table-content">
                                        <?=$info["site_name"];?>
                                    </td>
                                    <td class="index-main-table-content">
                                        <?=$info["agent_name"];?>
                                    </td>
                                    <td class="index-main-table-content">
                                        <?=$info["email"];?>
                                    </td>
                                <!-- </a> -->
                            </tr>
                            </a>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>