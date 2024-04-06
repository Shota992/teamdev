<?php
require __DIR__ . '/../dbconnect.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: /../../Cadmin/auth/login.php');
    exit;
}
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

$sql = "SELECT info.*
        FROM info";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$selects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// POSTリクエストが送信された場合の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dbh->beginTransaction();
        // 削除する企業のIDを取得
        $id = $_POST["id"];

        // infoテーブルから対象の企業を削除
        $sql = "DELETE FROM info WHERE agent_id = :agent_id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":agent_id", $id);
        $stmt->execute();

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

//データベース切断
$dbh = null;

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント企業一覧</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Cadmin/Cadmin.css" />
    <script src="./assets/js/script.js">
    </script>
</head>

<body>
    <div class="wrapper">
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
                <form method="GET" action="./index.php" class="form">
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
                            <td class="index-main-table-content job-name">企業名</td>
                            <td class="index-main-table-content">メールアドレス</td>
                            <td></td>
                        </tr>
                        <?php foreach ($infos as $info) { ?>
                            <tr class="index-main-table-contents index-odd" id="info-<?= $info["agent_id"] ?>">
                                
                                    <td class="index-main-table-content">
                                    <a href="./egent/edit.php?agent_id=<?= $info["agent_id"] ?>">
                                        <?= $info["agent_id"]; ?>
                                    </a>
                                    </td>
                                    <td class="index-main-table-content">
                                    <a href="./egent/edit.php?agent_id=<?= $info["agent_id"] ?>">
                                        <?= $info["site_name"]; ?>
                                    </a>
                                    </td>
                                    <td class="index-main-table-content">
                                    <a href="./egent/edit.php?agent_id=<?= $info["agent_id"] ?>">
                                        <?= $info["agent_name"]; ?>
                                    </a>
                                    </td>
                                    <td class="index-main-table-content">
                                    <a href="./egent/edit.php?agent_id=<?= $info["agent_id"] ?>">
                                        <?= $info["email"]; ?>
                                    </a>
                                    </td>
                                    <td class="check-item">
                                    <a href="./egent/edit.php?agent_id=<?= $info["agent_id"] ?>">
                                        <form method="POST">
                                            <input type="hidden" value="<?= $info["agent_id"] ?>" name="id">
                                            <input type="submit" value="削除" class="submit check-delete-button">
                                        </form>
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
    </div>
</body>

</html>