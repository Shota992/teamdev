<?php
// session_start();

require __DIR__ . '/../dbconnect.php';
$infos = $dbh->query("SELECT * FROM info")->fetchAll(PDO::FETCH_ASSOC);

$search_site = '';
$search_agent = '';

if (isset($_GET["search"])) {

    if (isset($_GET["search_site"]) && empty($_GET["search_agent"])) {
        $search_site = $_GET["search_site"];
        $search_agent = '';
    }

    if (empty($_GET["search_site"]) && isset($_GET["search_agent"])) {
        $search_site = '';
        $search_agent = $_GET["search_agent"];
    }

    if (isset($_GET["search_site"]) && isset($_GET["search_agent"])) {
        $search_site = $_GET["search_site"];
        $search_agent = $_GET["search_agent"];
    }


    //実行
    // $sql="SELECT * FROM info WHERE site_name LIKE '%{$search_site}%' and agent_name like '%{$search_agent}%'";
    // $in = $dbh->prepare($sql);
    // $in->execute();
    // $infos = $in->fetchAll(PDO::FETCH_ASSOC);

} else {

    // //「検索」ボタン押下してないとき
    // $sql='SELECT * FROM fruit WHERE 1';
    // $rec = $dbh->prepare($sql);
    // $rec->execute();
    // $rec_list = $rec->fetchAll(PDO::FETCH_ASSOC);
}

//データベース切断
$dbh = null;

// }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント企業一覧</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../Cadmin/Cadmin.css" />
    <script src="./assets/js/script.js">
    </script>
</head>

<body>
    <header class="header-all">
        <div header-top>
            <a href="#" class="header-logo" target="_blank" rel="noopener noreferrer">
                <img src="../../assets/img/header_logo.png" alt="CRAFT" width="120" style="object-fit: contain;">
            </a>
        </div>
        <div class="header-down">
            <img src="../../assets/img/boozer_logo-black.png" alt="boozer" width="150" style="object-fit: contain;">
        </div>
    </header>
    <div class="create-wrapper">
        <aside class="side-container">
            <nav>
                <div class="side-sent">
                    <div class="side-content choiced"><a href="#">エージェント企業一覧</a></div>
                    <div class="side-content"><a href="../Cadmin/egent/create.php">エージェント企業新規登録</a></div>
                    <div class="side-content"><a href="../Cadmin/auth/newadmin.php">新規管理者登録</a></div>
                    <div class="side-content"><a href="../Cadmin/content.php">申込内容一覧</a></div>
                    <div class="side-content"><a href="../Cadmin/auth/logout.php">ログアウト</a></div>
                </div>
            </nav>
        </aside>
        <main class="create-main">
            <div class="index-main-head">
                <div class="index-main-head-container">
                    <div class="index-main-head-sent">エージェント企業一覧</div>
                </div>
            </div>
            <form method="GET" action="./index.php">
                <div class="index-main-search">
                    <div class="index-main-search-contents">
                        <div class="index-main-search-content">
                            <div class="index-main-search-title">サービス名</div>
                            <input class="index-main-search-input" type="text" placeholder="検索" autocomplete="off" name="search-site" value="<?php if (!empty($_GET['search_site'])) {
                                                                                                                                                    echo $_GET['search_site'];
                                                                                                                                                } ?>">
                        </div>
                        <div class="index-main-search-content">
                            <div class="index-main-search-title">企業名</div>
                            <input class="index-main-search-input" type="text" placeholder="検索" autocomplete="off" name="search-agent" value="<?php if (!empty($_GET['search_agent'])) {
                                                                                                                                                    echo $_GET['search_agent'];
                                                                                                                                                } ?>">
                        </div>
                        <button class="index-main-search-button">
                            <input type="submit" name="search" value="検索">
                        </button>
                    </div>
                </div>
            </form>
            <div class="index-main-table">
                <table class="index-main-table-conainer">
                    <tr class="index-main-table-head">
                        <td class="index-main-table-content">企業ID</td>
                        <td class="index-main-table-content">サービス名</td>
                        <td class="index-main-table-content">企業名</td>
                        <td class="index-main-table-content">メールアドレス</td>
                    </tr>
                    <?php foreach ($infos as $info) { ?>
                        <tr class="index-main-table-contents index-odd" id="infos-<?= $info["id"] ?>">
                            <td class="index-main-table-content">
                                <a href="./egent/edit.php?id=<?= $info["id"] ?>">
                                    <?= $info["agent_id"]; ?>
                                </a>
                            </td>
                            <td class="index-main-table-content">
                                <a href="./egent/edit.php?id=<?= $info["id"] ?>">
                                    <?= $info["site_name"]; ?>
                                </a>
                            </td>
                            <td class="index-main-table-content">
                                <a href="./egent/edit.php?id=<?= $info["id"] ?>">
                                    <?= $info["agent_name"]; ?>
                                </a>
                            </td>
                            <td class="index-main-table-content">
                                <a href="./egent/edit.php?id=<?= $info["id"] ?>">
                                    <?= $info["email"]; ?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </main>
    </div>
    <footer class="footer">
        <div class="footer-copyright">
            <small class="copyright">&copy; POSSE,Inc</small>
        </div>
    </footer>
</body>

</html>